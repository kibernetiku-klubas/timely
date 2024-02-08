<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMeetingRequest;
use App\Models\Meeting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class MeetingController extends Controller
{
    public function confirmDelete($id)
    {
        $meeting = Meeting::where('user_id', Auth::user()->id)->findOrFail($id);

        return view('meetings.confirm-delete', compact('meeting'));
    }

    public function destroy($id): RedirectResponse
    {
        $meeting = Meeting::where('user_id', Auth::user()->id)->findOrFail($id);
        $meeting->delete();

        return redirect('/dashboard')->with('error', __('MeetingController.delete'));
    }

    public function displayEdit($id)
    {
        $meeting = Meeting::where('user_id', Auth::user()->id)->findOrFail($id);

        return view('meetings.edit', compact('meeting'));
    }

    public function store(StoreMeetingRequest $request): RedirectResponse
    {
        $user = Auth::user();

        $userMeetingsCount = Meeting::where('user_id', $user->id)->count();

        if ($userMeetingsCount >= 50) {
            return redirect('/dashboard')->with('error', __('MeetingController.meetings_limit_reached'));
        }

        $validated = $request->validated();

        //        $validated['delete_after'] = 90;
        //
        //        if ($validated['delete_after'] < $validated['voting_deadline']) {
        //            $validated['voting_deadline'] = 0;
        //        }

        $meeting = new Meeting;
        $meeting->user_id = $user->id;

        return $this->assignMeetingData($meeting, $validated, '/dashboard', __('MeetingController.success'));
    }

    public function show($id)
    {
        $meeting = $this->getMeetingWithDates($id);

        return view('meetings.meeting', $this->getViewData($meeting));
    }

    public function showCustom($creator, $customUrl)
    {
        // When passing data to route spaces are replaced with "-"
        // So this is to replace them back to spaces
        $creator = str_replace('-', ' ', $creator);

        $user = User::where('name', $creator)->firstOrFail();

        $meeting = Meeting::where('custom_url', $customUrl)
            ->where('user_id', $user->id)
            ->firstOrFail();

        return view('meetings.meeting', $this->getViewData($meeting));
    }

    private function getViewData($meeting)
    {
        return [
            'user' => $this->getUser(),
            'creator' => $meeting->creator,
            'meeting' => $meeting,
            'datesGroupedByYear' => $this->getDatesGroupedByYear($meeting),
            'meetingLink' => $this->getMeetingLink($meeting->id),
            'is1v1' => $meeting->is1v1 === 1,
            'isUserCreator' => $this->isUserCreator($meeting),
            'highestVoteCount' => $this->getHighestVoteCount($meeting),
            'selectedDate' => $this->getSelectedDate($meeting),
            'hasVoted' => $this->hasUserVoted($meeting->id),
            'highestVotedDates' => $this->getHighestVotedDates($meeting),
            'hasDeadlinePassed' => $this->hasDeadlinePassed($meeting),
            'votingDeadline' => $meeting->created_at->copy()->addDays($meeting->delete_after - $meeting->voting_deadline),
            'custom_url' => $meeting->custom_url,
        ];
    }

    private function hasDeadlinePassed($meeting)
    {
        if ($meeting->voting_deadline > 0) {
            $now = Carbon::now();
            $disallowVotes = $meeting->created_at->copy()->addDays($meeting->delete_after - $meeting->voting_deadline);

            return $now->greaterThanOrEqualTo($disallowVotes);
        } else {
            return false;
        }
    }

    private function getSelectedDate($meeting)
    {
        return $meeting->dates->where('selected', 1)->first();
    }

    private function hasUserVoted($meetingId)
    {
        return session()->has('voted_'.$meetingId);
    }

    private function getHighestVotedDates($meeting)
    {
        $highestVoteCount = $this->getHighestVoteCount($meeting);

        return $meeting->dates->filter(function ($date) use ($highestVoteCount) {
            return $date->votes->count() > 0 && $date->votes->count() === $highestVoteCount;
        })->pluck('id');
    }

    private function getUser()
    {
        return Auth::check() ? auth()->user() : null;
    }

    private function isUserCreator($meeting): bool
    {
        return Auth::check() && $meeting->user_id === Auth::user()->id;
    }

    private function getMeetingWithDates($id): Meeting
    {
        return Meeting::with([
            'dates' => function ($query) {
                $query->orderBy('date_and_time', 'asc');
            },
            'dates.votes',
        ])->findOrFail($id);
    }

    private function getMeetingLink($id): string
    {
        return "https://timely.lt/meetings/$id";
    }

    private function getDatesGroupedByYear($meeting)
    {
        return $meeting->dates->map(function ($date) {
            $carbonDate = Carbon::parse($date->date_and_time);
            $date->date_and_time = $carbonDate;

            return $date;
        })->groupBy(function ($date) {
            return $date->date_and_time->format('Y');
        });
    }

    private function getHighestVoteCount($meeting)
    {
        $highestVoteCount = 0;

        foreach ($meeting->dates as $date) {
            $voteCount = $date->votes->count();
            if ($voteCount > $highestVoteCount) {
                $highestVoteCount = $voteCount;
            }
        }

        return $highestVoteCount;
    }

    public function update(StoreMeetingRequest $request, $id): RedirectResponse
    {
        $validated = $request->validated();
        $meeting = Meeting::where('user_id', Auth::user()->id)->findOrFail($id);

        //        if ($validated['delete_after'] < $validated['voting_deadline']) {
        //            $validated['voting_deadline'] = 0;
        //        }

        $validated['custom_url'] = $meeting->custom_url;

        return $this->assignMeetingData($meeting, $validated, "meetings/$meeting->id");
    }

    private function assignMeetingData(Meeting $meeting, array $validated, string $redirectUrl, string $message = null): RedirectResponse
    {
        $meeting->title = $validated['title'];
        $meeting->description = $validated['description'];
        $meeting->location = $validated['location'];
        $meeting->timezone = $validated['timezone'];
        $meeting->duration = $validated['duration'];
        //        $meeting->delete_after = $validated['delete_after'];
        $meeting->is1v1 = $validated['is1v1'];
        $meeting->voter_invisible = 0;
        //        $meeting->voting_deadline = $validated['voting_deadline'];
        $meeting->custom_url = $validated['custom_url'];

        if (isset($validated['voter_invisible'])) {
            $meeting->voter_invisible = $validated['voter_invisible'];
        }

        $meeting->save();

        return redirect($redirectUrl)->with('success', $message ?? __('MeetingController.saved'));
    }
}

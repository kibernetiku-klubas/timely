<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDate;
use App\Http\Requests\StoreMeeting;
use App\Models\Date;
use App\Models\Meeting;
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

    public function store(StoreMeeting $request): RedirectResponse
    {
        $validated = $request->validated();

        $meeting = new Meeting;
        $meeting->user_id = Auth::user()->id;

        return $this->assignMeetingData($meeting, $validated, '/dashboard', __('MeetingController.success'));
    }

    public function show($id)
    {
        $meeting = Meeting::with(['dates' => function ($query) {
            $query->orderBy('date_and_time', 'asc');
        }, 'dates.votes'])->findOrFail($id);

        $datesGroupedByYear = $this->getDatesGroupedByYear($meeting);

        $meetingLink = "https://timely.lt/meetings/{$meeting->id}";

        return view('meetings.meeting', [
            'user' => Auth::user(),
            'creator' => $meeting->creator,
            'meeting' => $meeting,
            'datesGroupedByYear' => $datesGroupedByYear,
            'meetingLink' => $meetingLink,
        ]);
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

    public function showDashboard()
    {
        return view('dashboard', [
            'meetings' => Meeting::where('user_id', Auth::user()->id)->simplePaginate(12),
        ]);
    }

    public function update(StoreMeeting $request, $id): RedirectResponse
    {
        $validated = $request->validated();
        $meeting = Meeting::where('user_id', Auth::user()->id)->findOrFail($id);

        return $this->assignMeetingData($meeting, $validated, "meetings/$meeting->id");
    }

    private function assignMeetingData(Meeting $meeting, array $validated, string $redirectUrl, string $message = null): RedirectResponse
    {
        $meeting->title = $validated['title'];
        $meeting->description = $validated['description'];
        $meeting->location = $validated['location'];
        $meeting->timezone = $validated['timezone'];
        $meeting->duration = $validated['duration'];
        $meeting->delete_after = $validated['delete_after'];
        $meeting->is1v1 = $validated['is1v1'];
        $meeting->save();

        return redirect($redirectUrl)->with('success', $message ?? __('MeetingController.saved'));
    }

    public function showFinalizeDate($id)
    {
        $meeting = Meeting::findOrFail($id);

        return view('meetings.finalize-date', compact('meeting'));
    }

    public function finalizeDate(StoreDate $request, $id)
    {
        $meeting = Meeting::findOrFail($id);

        if ($meeting->user_id !== Auth::user()->id) {
            return redirect()->back()->with('error', __('MeetingController.noauth'));
        }

        if ($meeting->dates->isEmpty()) {
        return redirect()->route('meeting.show', $meeting->id)->with('error', 'Cannot finalize date. The meeting has no dates.');
    }

        $selectedDateId = $request->input('selected_date');
        $meeting->dates()->update(['selected' => 0]);


        $selectedDate = Date::where('id', $selectedDateId)
            ->where('meeting_id', $meeting->id)
            ->firstOrFail();

        $selectedDate->selected = 1;
        $selectedDate->save();

        return redirect()->route('meeting.show', $meeting->id)->with('success', __('MeetingController.finalized'));
    }


}

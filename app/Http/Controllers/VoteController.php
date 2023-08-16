<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\Vote;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VoteController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'voted_by' => 'max:50',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', __('VoteController.max'));
        }
      
        $votedBy = $request->input('voted_by');
        $dateIds = $request->input('date_ids', []);
        $votes = $request->input('votes', []);
        $meeting = $this->getMeeting($request->input('meeting_id'));

        if (!$this->hasVotes($votes)) {
            return $this->redirectWithErrorMessage(__('VoteController.select'));
        }

        if ($this->hasAlreadyVotedForThis($meeting->id)) {
            return $this->redirectWithErrorMessage(__('VoteController.voted'));
        }

        if ($this->hasMoreVotesThanAllowed($meeting, $votes)) {
            return $this->redirectWithErrorMessage(__('VoteController.one'));
        }

        $this->registerVotes($meeting, $dateIds, $votes, $votedBy);

        return $this->redirectWithSuccessMessage($meeting->id);
    }

    private function getMeeting($meetingId)
    {
        return Meeting::findOrFail($meetingId);
    }

    private function hasVotes($votes)
    {
        return !empty($votes);
    }

    private function hasAlreadyVotedForThis($meetingId)
    {
        return session()->has('voted_' . $meetingId);
    }

    private function hasMoreVotesThanAllowed($meeting, $votes)
    {
        return $meeting->is1v1 == 1 && count($votes) > 1;
    }

    private function registerVotes($meeting, $dateIds, $votes, $votedBy): void
    {
        foreach ($dateIds as $dateId) {
            if (in_array($dateId, $votes)) {
                if ($meeting->is1v1 == 1 && Vote::where('date_id', $dateId)->count() > 0) {
                    $this->redirectWithErrorMessage(__('VoteController.else'));
                    return;
                }

                $this->createVote($dateId, $votedBy);
            }
        }

        $this->markMeetingAsVoted($meeting->id);
    }

    private function createVote($dateId, $votedBy)
    {
        Vote::create([
            'date_id' => $dateId,
            'voted_by' => $votedBy,
        ]);
    }

    private function markMeetingAsVoted($meetingId)
    {
        session(['voted_' . $meetingId => true]);
    }

    private function redirectWithErrorMessage($message)
    {
        return redirect()->back()->with('error', $message);
    }

    private function redirectWithSuccessMessage($meetingId)
    {
        return redirect()->route('meeting.show', ['id' => $meetingId])->with('success', __('VoteController.success'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $vote = Vote::findOrFail($id);
        $vote->voted_by = $request->input('voted_by');
        $vote->save();

        return redirect()->route('meeting.show', ['id' => $vote->date->meeting->id])
            ->with('success', __('VoteController.update'));
    }

    public function destroy($id): RedirectResponse
    {
        $vote = Vote::findOrFail($id);
        $meetingId = $vote->date->meeting->id;
        $vote->delete();

        return redirect()->route('meeting.show', ['id' => $meetingId])
            ->with('error', __('VoteController.delete'));
    }
}

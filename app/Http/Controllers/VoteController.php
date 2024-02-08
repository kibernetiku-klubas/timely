<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVoteRequest;
use App\Models\Meeting;
use App\Models\Vote;
use App\Traits\MeetingAuthorizationTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    use MeetingAuthorizationTrait;

    /**
     * Store votes for dates
     */
    public function store(StoreVoteRequest $request): RedirectResponse
    {
        // Get input data from the request
        $votedBy = $request->input('voted_by');
        $dateIds = $request->input('date_ids', []);
        $votes = $request->input('votes', []);
        $meeting = Meeting::findOrFail($request->input('meeting_id'));

        // Checks for various conditions
        if (! $this->hasVotes($votes)) {
            return $this->redirectWithErrorMessage(__('VoteController.select'));
        }
        if ($this->hasAlreadyVotedForThis($meeting->id)) {
            return $this->redirectWithErrorMessage(__('VoteController.voted'));
        }
        if ($this->hasMoreVotesThanAllowed($meeting, $votes)) {
            return $this->redirectWithErrorMessage(__('VoteController.one'));
        }

        // Register the votes and redirect with success message
        $this->registerVotes($meeting, $dateIds, $votes, $votedBy);

        return $this->redirectWithSuccessMessage($meeting->id);
    }

    /**
     * Update vote
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $vote = Vote::findOrFail($id);
        $meetingId = $vote->date->meeting->id;

        // Check if the authenticated user is the meeting creator
        if (! $this->isUserMeetingCreator($meetingId)) {
            return redirect()->back()->with('error', __('VoteController.noauthupdate'));
        }

        // Update and save the vote
        $vote->voted_by = $request->input('voted_by');
        $vote->save();

        return redirect()->route('meeting.show', ['id' => $vote->date->meeting->id])
            ->with('success', __('VoteController.update'));
    }

    /**
     * Delete vote
     */
    public function destroy($id): RedirectResponse
    {
        $vote = Vote::findOrFail($id);
        $meetingId = $vote->date->meeting->id;

        // Check if the authenticated user is the meeting creator
        if (! $this->isUserMeetingCreator($meetingId)) {
            return redirect()->back()->with('error', __('VoteController.noauthdelete'));
        }

        $vote->delete();

        return redirect()->route('meeting.show', ['id' => $meetingId])
            ->with('error', __('VoteController.delete')); // Used with error for message to be red
    }

    /**
     * Register the votes
     */
    private function registerVotes($meeting, $dateIds, $votes, $votedBy): void
    {
        // Iterate through each date ID
        foreach ($dateIds as $dateId) {
            // Check if the date ID is in the list of votes
            if (in_array($dateId, $votes)) {
                // Check if the meeting is 1v1 and if there are already votes for this date
                if ($meeting->is1v1 == 1 && Vote::where('date_id', $dateId)->count() > 0) {
                    // Redirect with error message if the meeting is 1v1 and a vote already exists
                    $this->redirectWithErrorMessage(__('VoteController.else'));
                    // Exit the function to prevent further processing
                    return;
                }
                // Create a vote for the current date ID and user
                $this->createVote($dateId, $votedBy);
            }
        }
        // Mark the meeting as voted once all votes are registered
        $this->markMeetingAsVoted($meeting->id);
    }

    /**
     * Creates a vote
     */
    private function createVote($dateId, $votedBy)
    {
        Vote::create([
            'date_id' => $dateId,
            'voted_by' => $votedBy,
        ]);
    }

    /**
     * Check if there are any votes provided.
     */
    private function hasVotes($votes)
    {
        return ! empty($votes);
    }

    /**
     * Check if the current session indicates that the user has already voted for a specific meeting.
     */
    private function hasAlreadyVotedForThis($meetingId)
    {
        return session()->has('voted_'.$meetingId);
    }

    /**
     * Check if the user has submitted more votes than allowed for a meeting.
     */
    private function hasMoreVotesThanAllowed($meeting, $votes)
    {
        return $meeting->is1v1 == 1 && count($votes) > 1;
    }

    /**
     * Mark a meeting as voted for in the current session.
     */
    private function markMeetingAsVoted($meetingId)
    {
        session(['voted_'.$meetingId => true]);
    }

    /**
     * Redirect back with an error message
     */
    private function redirectWithErrorMessage($message)
    {
        return redirect()->back()->with('error', $message);
    }

    /**
     * Redirect back with a success message
     */
    private function redirectWithSuccessMessage($meetingId)
    {
        return redirect()->route('meeting.show', ['id' => $meetingId])->with('success', __('VoteController.success'));
    }
}

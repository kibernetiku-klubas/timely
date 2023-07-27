<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function store(Request $request)
    {
        $meetingId = $request->input('meeting_id');
        $votedBy = $request->input('voted_by');
        $dateIds = $request->input('date_ids', []);
        $votes = $request->input('votes', []);

        if (empty($votes)) {
            return redirect()->back()->with('error', 'Please select at least one option.');
        }

        if (session()->has('voted_' . $meetingId)) {
            return redirect()->back()->with('error', 'You have already voted for this meeting.');
        }

        foreach ($dateIds as $dateId) {
            if (in_array($dateId, $votes)) {
                Vote::create([
                    'date_id' => $dateId,
                    'voted_by' => $votedBy,
                ]);
            }
        }

        session(['voted_' . $meetingId => true]);

        return redirect()->route('meeting.show', ['id' => $meetingId])->with('success', 'Votes saved successfully!');
    }


    public function update(Request $request, $id): RedirectResponse
    {
        $vote = Vote::findOrFail($id);
        $vote->voted_by = $request->input('voted_by');
        $vote->save();

        return redirect()->route('meeting.show', ['id' => $vote->date->meeting->id])
            ->with('success', 'Vote updated successfully!');
    }

    public function destroy($id): RedirectResponse
    {
        $vote = Vote::findOrFail($id);
        $meetingId = $vote->date->meeting->id;
        $vote->delete();

        return redirect()->route('meeting.show', ['id' => $meetingId])
            ->with('success', 'Vote deleted successfully!');
    }
}

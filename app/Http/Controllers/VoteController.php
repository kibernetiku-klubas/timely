<?php

namespace App\Http\Controllers;

use App\Models\Vote;
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
            return redirect()->back()->with('error', 'Please select at least one option.');        }

        foreach ($dateIds as $dateId) {
            if (in_array($dateId, $votes)) {
                Vote::create([
                    'date_id' => $dateId,
                    'voted_by' => $votedBy,
                ]);
            }
        }

        return redirect()->route('meeting.show', ['id' => $meetingId])->with('success', 'Votes saved successfully!');
    }
}

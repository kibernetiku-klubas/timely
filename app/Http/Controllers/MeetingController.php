<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMeeting;
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

        return redirect('/dashboard')->with('error', $message ?? 'Meeting deleted.');
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

        return $this->assignMeetingData($meeting, $validated, '/dashboard', 'Meeting created successfully.');
    }

    public function show($id)
    {
        $meeting = Meeting::with('dates.votes')->findOrFail($id);

        $datesGroupedByYear = $meeting->dates->map(function ($date) {
            $carbonDate = Carbon::parse($date->date_and_time);
            $date->date_and_time = $carbonDate; // Replace the original string with a Carbon instance
            return $date;
        })->groupBy(function ($date) {
            return $date->date_and_time->format('Y');
        });

        return view('meetings.meeting', [
            'user' => Auth::user(),
            'creator' => $meeting->creator,
            'meeting' => $meeting,
            'datesGroupedByYear' => $datesGroupedByYear,
        ]);
    }

    public function showDashboard()
    {
        $meetings = Meeting::where('user_id', Auth::user()->id)->simplePaginate(12);

        return view('dashboard', [
            'meetings' => $meetings,
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

        return redirect($redirectUrl)->with('success', $message ?? 'Meeting saved successfully.');
    }
}

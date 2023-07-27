<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMeeting;
use App\Models\Meeting;
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

        return redirect('/dashboard');
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

        return $this->assignMeetingData($meeting, $validated, '/dashboard', 'Meeting created successfully');
    }

    public function show($id)
    {
        $meeting = Meeting::with('dates.votes')->findOrFail($id);

        return view('meetings.meeting', [
            'user' => Auth::user(),
            'meeting' => $meeting,
        ]);
    }

    public function showDashboard()
    {
        return view('dashboard', [
            'meetings' => Meeting::where('user_id', Auth::user()->id)->get(),
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
        $meeting->save();

        return redirect($redirectUrl)->with('success', $message ?? 'Meeting saved successfully');
    }
}

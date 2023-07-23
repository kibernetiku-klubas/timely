<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMeeting;
use App\Models\Date;
use App\Models\Meeting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class MeetingController extends Controller
{
    public function store(StoreMeeting $request): RedirectResponse
    {
        $validated = $request->validated();

        $meeting = new Meeting;
        $meeting->user_id = Auth::user()->id;
        $meeting->title = $validated['title'];
        $meeting->description = $validated['description'];
        $meeting->location = $validated['location'];
        $meeting->timezone_offset = $validated['timezone_offset'];
        $meeting->duration = $validated['duration'];
        $meeting->delete_after = $validated['delete_after'];
        $meeting->save();

        return redirect('/dashboard');
    }

    public function show($id)
    {
        return view('meetings.meeting', [
            'user' => Auth::user(),
            'meeting' => Meeting::findOrFail($id),
            'dates' => Date::where('meeting_id', $id)->get()
        ]);
    }

    public function showDashboard()
    {
        return view('dashboard', [
            'meetings' => Meeting::where('user_id', Auth::user()->id)->latest()->get(),
        ]);
    }
}

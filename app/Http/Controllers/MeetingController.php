<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:64',
            'description' => 'max:255',
            'location' => 'max:64',
            'timezone_offset' => 'required|integer|max:13|gt:0',
            'duration' => 'integer|max:32000|gt:0',
            'delete_after' => 'integer|max:32000|gt:0'

        ]);

        // Additional validation for timezone_offset, duration, and delete_after current values are example values
        $validated['timezone_offset'] = max(min($validated['timezone_offset'], 13), -13);
        $validated['duration'] = max(min($validated['duration'], 32000), 1);
        $validated['delete_after'] = max(min($validated['delete_after'], 32000), 1);

        $meeting = new Meeting;
        $meeting->user_id = Auth::user()->id;
        $meeting->title = $validated['title'];
        $meeting->description = $validated['description'];
        $meeting->location = $validated['location'];
        $meeting->timezone_offset = $validated['timezone_offset'];
        $meeting->duration = $validated['duration'];
        $meeting->meet_times = '{}';
        $meeting->delete_after = $validated['delete_after'];
        $meeting->save();
        return redirect('/dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $meeting = Meeting::findOrFail($id);
        return view('meetings.meeting', compact('meeting'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Meeting $meeting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Meeting $meeting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Meeting $meeting)
    {
        //
    }
}

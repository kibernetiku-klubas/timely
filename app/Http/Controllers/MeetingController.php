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
            'timezone_offset' => 'integer|max:13',
            'duration' => 'integer|max:32000',
            'delete_after' => 'integer|max:32000'
        ]);

        $meeting = new Meeting;
        $meeting->user_id = Auth::user()->id;
        $meeting->title = $request->input('title');
        $meeting->description = $request->input('description');
        $meeting->location = $request->input('location');
        $meeting->timezone_offset = $request->input('timezone_offset');
        $meeting->duration = $request->input('duration');
        $meeting->meet_times = '{}';
        $meeting->delete_after = $request->input('delete_after');
        $meeting->save();
        return redirect('/dashboard',);
    }

    /**
     * Display the specified resource.
     */
    public function show(Meeting $meeting)
    {
        //
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

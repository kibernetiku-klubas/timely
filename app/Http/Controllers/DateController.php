<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDate;
use App\Models\Date;
use Illuminate\Http\RedirectResponse;

class DateController extends Controller
{
    public function index(): RedirectResponse
    {
        return redirect("dashboard");
    }

    public function store(StoreDate $request): RedirectResponse
    {
        $validatedData = $request->validated();
        $meetingId = $request->input('meeting_id');

        $existingDatesCount = Date::where('meeting_id', $meetingId)->count();
        if ($existingDatesCount < 20) {
            $date = new Date;
            $date->meeting_id = $meetingId;
            $date->date_and_time = $validatedData['new_time'];
            $date->save();
        }

        return redirect("/meetings/$meetingId");
    }

    public function update(StoreDate $request, $id): RedirectResponse
    {
        $validatedData = $request->validated();
        $date = Date::findOrFail($id);
        if (Auth::check() && Meeting::where('user_id', Auth::user()->id)->exists($date->meeting_id)) {
            $date->date_and_time = $validatedData['new_time'];
            $date->save();

            $meetingId = $date->meeting_id;
        }

        return redirect("/meetings/$meetingId");
    }

    public function destroy($id): RedirectResponse
    {
        $date = Date::findOrFail($id);
        if (Auth::check() && Meeting::where('user_id', Auth::user()->id)->exists($date->meeting_id)) {
        $meetingId = $date->meeting_id;
        
        $date->delete();
        }
        return redirect("/meetings/$meetingId");
    }
}
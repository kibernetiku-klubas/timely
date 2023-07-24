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
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\DateController;
use App\Models\Date;
use App\Models\Meeting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DateController extends Controller
{
    public function index(): RedirectResponse
    {
        return redirect("dashboard");
    }

    public function store (Request $request): RedirectResponse
    {
        $meeting = Meeting::where('id', $request->meeting_id)->where('user_id', Auth::user()->id)->firstOrFail();
        $dates = Date::where('meeting_id', $request->meeting_id)->get();
        
        $date = new Date;
        $date->meeting_id = $meeting->id;
        $date->date_and_time = $request->new_time;

        $isUnique = true;
        foreach ($dates as $x) {
            if ($x->date_and_time == $date->date_and_time)
            {
                $isUnique = false;
                break;
            }
        }
        if ($isUnique && count($dates) < 25)
            $date->save();

        return redirect("/meetings/$meeting->id");
    }
}

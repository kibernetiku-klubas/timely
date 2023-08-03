<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDate;
use App\Models\Date;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\Meeting;


class DateController extends Controller
{

    public function store(StoreDate $request): RedirectResponse
    {
        $validatedData = $request->validated();
        $meetingId = $request->input('meeting_id');

        $date = new Date;
        $date->meeting_id = $meetingId;
        $date->date_and_time = $validatedData['new_time'];
        $date->save();

        return redirect("/meetings/$meetingId")->with('success', 'Date saved.');
    }

    private function isUserMeetingCreator(string $meetingId): bool
    {
        return Meeting::where('id', $meetingId)
            ->where('user_id', Auth::user()->id)
            ->exists();
    }

    public function destroy($id): RedirectResponse
    {
        $date = Date::findOrFail($id);
        if ($this->isUserMeetingCreator($date->meeting_id)) {
            $date->delete();
            return redirect()->back()->with('success', 'Date deleted successfully.');
        }
        return redirect()->back()->with('error', 'Not authorized to delete this date.');
    }
}

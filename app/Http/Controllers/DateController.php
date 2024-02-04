<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDate;
use App\Models\Date;
use App\Models\Meeting;
use DateInterval;
use DateTime;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

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

        return redirect("/meetings/$meetingId")->with('success', __('DateController.saved'));
    }

    public function destroy($id): RedirectResponse
    {
        $date = Date::findOrFail($id);
        if ($this->isUserMeetingCreator($date->meeting_id)) {
            $date->delete();

            return redirect()->back()->with('success', __('DateController.success'));
        }

        return redirect()->back()->with('error', __('DateController.noauth'));
    }

    private function isUserMeetingCreator(string $meetingId): bool
    {
        return Meeting::where('id', $meetingId)
            ->where('user_id', Auth::user()->id)
            ->exists();
    }

    public function showFinalizeDateView($id)
    {
        $meeting = Meeting::findOrFail($id);

        $sortedDates = $meeting->dates->sortByDesc(function ($date) {
            return $date->votes->count();
        });

        return view('meetings.finalize-date', compact('meeting', 'sortedDates'));
    }

    public function finalizeDate(StoreDate $request, $id)
    {
        $meeting = Meeting::findOrFail($id);

        if (! $this->isUserMeetingCreator($meeting->id)) {
            return redirect()->back()->with('error', __('MeetingController.noauth'));
        }

        if ($meeting->dates->isEmpty()) {
            return redirect()->route('meeting.show', $meeting->id)->with('error', 'Cannot finalize date. The meeting has no dates.');
        }

        $selectedDateId = $request->input('selected_date');
        $meeting->dates()->update(['selected' => 0]);

        $selectedDate = Date::where('id', $selectedDateId)
            ->where('meeting_id', $meeting->id)
            ->firstOrFail();

        $selectedDate->selected = 1;
        $selectedDate->save();

        return redirect()->route('meeting.show', $meeting->id)->with('success', __('MeetingController.finalized'));
    }

    /**
     * @throws Exception
     */
    public function exportToICalendar($meetingId, $dateId)
    {
        $date = Date::findOrFail($dateId);
        $meeting = Meeting::findOrFail($meetingId);

        $icsContent = "BEGIN:VCALENDAR\r\nVERSION:2.0\r\n";

        $startDate = new DateTime($date->date_and_time);
        $endDate = clone $startDate;
        $endDate->add(new DateInterval('PT'.$meeting->duration.'M'));

        $icsContent .= "BEGIN:VEVENT\r\n";
        $icsContent .= 'DTSTART:'.$startDate->format('Ymd\THis')."\r\n";
        $icsContent .= 'DTEND:'.$endDate->format('Ymd\THis')."\r\n";
        $icsContent .= 'SUMMARY:'.$meeting->title."\r\n";
        $icsContent .= 'DESCRIPTION:'.$meeting->description."\r\n";
        $icsContent .= 'LOCATION:'.$meeting->location."\r\n";
        $icsContent .= "END:VEVENT\r\n";

        $icsContent .= 'END:VCALENDAR';

        return response($icsContent)->header('Content-Type', 'text/calendar');
    }
}

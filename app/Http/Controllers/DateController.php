<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDateRequest;
use App\Models\Date;
use App\Models\Meeting;
use App\Traits\MeetingAuthorizationTrait;
use DateInterval;
use DateTime;
use Exception;
use Illuminate\Http\RedirectResponse;

class DateController extends Controller
{
    use MeetingAuthorizationTrait;

    /**
     * Store dates for the meeting
     */
    public function store(StoreDateRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        $meetingId = $request->input('meeting_id');

        if (! $this->isUserMeetingCreator($meetingId)) {
            return redirect()->back()->with('error', __('DateController.noauthsave'));
        }

        $this->createDate($meetingId, $validatedData);

        return redirect("/meetings/$meetingId")->with('success', __('DateController.saved'));
    }

    /**
     * Delete dates for the meeting
     */
    public function destroy($id): RedirectResponse
    {
        $date = Date::findOrFail($id);

        if (! $this->isUserMeetingCreator($date->meeting_id)) {
            return redirect()->back()->with('error', __('DateController.noauthdelete'));
        }

        $date->delete();

        return redirect()->back()->with('success', __('DateController.success'));
    }

    /**
     * Creates a new date for a meeting.
     */
    public function createDate($meetingId, $validatedData)
    {
        $date = new Date;
        $date->meeting_id = $meetingId;
        $date->date_and_time = $validatedData['new_time'];
        $date->save();
    }

    /**
     * Show the view for finalizing a date
     */
    public function showFinalizeDateView($id)
    {
        $meeting = Meeting::findOrFail($id);

        // Sort the dates of the meeting in descending order based on the vote count
        $sortedDates = $meeting->dates->sortByDesc(function ($date) {
            return $date->votes->count();
        });

        return view('meetings.finalize-date', compact('meeting', 'sortedDates'));
    }

    /**
     * Save the date finalized
     */
    public function finalizeDate(StoreDateRequest $request, $id)
    {
        $meeting = Meeting::findOrFail($id);

        if (! $this->isUserMeetingCreator($meeting->id)) {
            return redirect()->back()->with('error', __('DateController.noauthfinalize'));
        }

        // Return error if the meeting has no dates
        if ($meeting->dates->isEmpty()) {
            return redirect()->route('meeting.show', $meeting->id)->with('error', __('DateController.nodates'));
        }

        // Get the id of selected date
        $selectedDateId = $request->input('selected_date');

        // Mark all dates as not selected
        $meeting->dates()->update(['selected' => 0]);

        // Find the selected date and update it's selected status
        $selectedDate = Date::where('id', $selectedDateId)
            ->where('meeting_id', $meeting->id)
            ->firstOrFail();

        $selectedDate->selected = 1;
        $selectedDate->save();

        return redirect()->route('meeting.show', $meeting->id)->with('success', __('DateController.finalized'));
    }

    /**
     * @throws Exception
     * Creates an .ics file for exporting selected date to calendar
     */
    public function exportToICalendar($meetingId, $dateId)
    {
        $date = Date::findOrFail($dateId);
        $meeting = Meeting::findOrFail($meetingId);

        // Initialize iCalendar content
        $icsContent = "BEGIN:VCALENDAR\r\nVERSION:2.0\r\n";

        // Create start and end dates for the meeting
        $startDate = new DateTime($date->date_and_time);
        $endDate = clone $startDate;
        $endDate->add(new DateInterval('PT'.$meeting->duration.'M'));

        // Add event details to iCalendar content
        $icsContent .= "BEGIN:VEVENT\r\n";
        $icsContent .= 'DTSTART:'.$startDate->format('Ymd\THis')."\r\n";
        $icsContent .= 'DTEND:'.$endDate->format('Ymd\THis')."\r\n";
        $icsContent .= 'SUMMARY:'.$meeting->title."\r\n";
        $icsContent .= 'DESCRIPTION:'.$meeting->description."\r\n";
        $icsContent .= 'LOCATION:'.$meeting->location."\r\n";
        $icsContent .= "END:VEVENT\r\n";

        // Close iCalendar
        $icsContent .= 'END:VCALENDAR';

        // Return iCalendar response
        return response($icsContent)->header('Content-Type', 'text/calendar');
    }
}

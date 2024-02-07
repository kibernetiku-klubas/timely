<?php

namespace App\Traits;

use App\Models\Meeting;
use Illuminate\Support\Facades\Auth;

trait MeetingAuthorizationTrait
{
    /*
     * Checks if Authorized user is meeting's creator by passing meeting's ID
     */
    private function isUserMeetingCreator(string $meetingId): bool
    {
        return Meeting::where('id', $meetingId)
            ->where('user_id', Auth::user()->id)
            ->exists();
    }
}

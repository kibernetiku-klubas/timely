<?php

namespace App\Traits;

use App\Models\Meeting;
use Illuminate\Support\Facades\Auth;

trait MeetingAuthorizationTrait
{
    private function isUserMeetingCreator(string $meetingId): bool
    {
        return Meeting::where('id', $meetingId)
            ->where('user_id', Auth::user()->id)
            ->exists();
    }
}

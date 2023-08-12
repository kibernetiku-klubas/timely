<?php

namespace Tests\Feature;

use App\Models\Meeting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Date;
use Tests\TestCase;

class DeleteExpiredMeetingsTest extends TestCase
{
    public function testExpiredMeetingsAreDeleted()
    {
        // Sets the current time to a specific date and time
        Date::setTestNow(now()->subDays(1)->startOfDay()->addHours(12));

        // Creates a meeting that SHOULD be deleted (delete_after = 5 days)
        Meeting::factory()->create([
            'created_at' => now()->subDays(7), // Created 7 days ago
            'delete_after' => 5,
        ]);

        // Creates a meeting that SHOULDN'T be deleted (delete_after = 10 days)
        Meeting::factory()->create([
            'created_at' => now()->subDays(3), // Created 3 days ago
            'delete_after' => 10,
        ]);

        // Runs the scheduled task
        Artisan::call('meetings:delete-expired');

        // Check that the expired meeting is deleted
        $this->assertDatabaseMissing('meetings', [
            'delete_after' => 5,
        ]);

        // Check that the non-expired meeting still exists
        $this->assertDatabaseHas('meetings', [
            'delete_after' => 10,
        ]);
    }
}

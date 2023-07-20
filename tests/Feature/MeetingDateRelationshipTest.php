<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Meeting;
use App\Models\Date;

class MeetingDateRelationshipTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_retrieve_dates_for_a_meeting()
    {
        // Create a meeting and associate dates with it
        $meeting = Meeting::factory()->create();
        $meeting->dates()->createMany([
            ['date_and_time' => '2023-07-20 14:00:00'],
            ['date_and_time' => '2023-07-21 10:30:00'],
            ['date_and_time' => '2023-07-22 16:15:00'],
        ]);

        // Retrieve the dates for the meeting
        $dates = $meeting->dates;

        // Assert that the relationship is working correctly
        $this->assertCount(3, $dates);
    }

    /** @test */
    public function it_can_cascade_delete_associated_dates_on_meeting_deletion()
    {
        // Create a meeting and associate dates with it
        $meeting = Meeting::factory()->create();
        $meeting->dates()->createMany([
            ['date_and_time' => '2023-07-20 14:00:00'],
            ['date_and_time' => '2023-07-21 10:30:00'],
            ['date_and_time' => '2023-07-22 16:15:00'],
        ]);

        // Delete the meeting
        $meeting->delete();

        // Check if the associated dates are also deleted
        $dates = Date::where('meeting_id', $meeting->id)->get();
        $this->assertCount(0, $dates);
    }
}

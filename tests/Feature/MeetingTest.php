<?php

namespace Tests\Feature;

use App\Models\Meeting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MeetingTest extends TestCase
{
    use RefreshDatabase;

    public function test_all_fields_submitted_and_saved(): void
    {
        $user = User::factory()->create();

        $formData = [
            'title' => 'Test Meeting',
            'description' => 'This is a test meeting',
            'location' => 'Test Location',
            'timezone' => 'Europe/Vilnius',
            'duration' => 60,
            'delete_after' => 30,
            'is1v1' => 0,
        ];

        $response = $this->actingAs($user)->post(route('meetings.store'), $formData);

        $response->assertStatus(302);

        $this->assertDatabaseHas('meetings', [
            'title' => $formData['title'],
            'description' => $formData['description'],
            'location' => $formData['location'],
            'timezone' => $formData['timezone'],
            'duration' => $formData['duration'],
            'delete_after' => $formData['delete_after'],
        ]);
    }

    public function test_required_fields()
    {
        $user = User::factory()->create();

        $formData = [
            // Missing 'title' field, which is required
            'description' => 'This is a test meeting',
            'location' => 'Test Location',
            'timezone' => 'Europe/Vilnius',
            'duration' => 60,
            'delete_after' => 30,
        ];

        $this->actingAs($user)->post(route('meetings.store'), $formData)->assertStatus(302)->assertSessionHasErrors('title');
    }
}

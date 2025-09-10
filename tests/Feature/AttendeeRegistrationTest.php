<?php
namespace Tests\Feature;

use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AttendeeRegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_prevents_duplicate_and_overbooking()
    {
        $event = Event::create([
            'name'         => 'T1',
            'location'     => 'L',
            'start_time'   => now()->addDay(),
            'end_time'     => now()->addDay()->addHours(2),
            'max_capacity' => 2,
        ]);

        $this->postJson("/api/events/{$event->id}/register", ['name' => 'A', 'email' => 'a@x.com'])->assertStatus(201);
        $this->postJson("/api/events/{$event->id}/register", ['name' => 'B', 'email' => 'b@x.com'])->assertStatus(201);
        // 3rd: over capacity
        $this->postJson("/api/events/{$event->id}/register", ['name' => 'C', 'email' => 'c@x.com'])->assertStatus(400);
        // duplicate
        $this->postJson("/api/events/{$event->id}/register", ['name' => 'A dup', 'email' => 'a@x.com'])->assertStatus(400);
    }
}

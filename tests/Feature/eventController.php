<?php

namespace Tests\Feature;

use App\Event;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Auth;
class eventController extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function testEventCreatePage()
    {
        $user = factory(User::class)->make();
        $this->be($user);
        $response = $this->get('events/create');
        $event = Event::whereHas('UserBand', function ($query) use($user){
            return $query->where('user_id','=',Auth::user()->id);
        })->first();
        $response->assertSee($event->eventDate);
        $response->assertSee($event->location);
        $response->assertSee($event->event_description);
        $response->assertSee($event->UserBand['band_name']);
        $response->assertSuccessful();

    }

    public function testEventStore()
    {
        $user = factory(User::class)->make();
        $this->be($user);
        $expectedEventDate = '2022-04-17';
        $expectedlocation = 'SOFIA(BG)';
        $expectedDescription = 'Iron Maiden!!! LIVE';
        $expectUserBandID = '1';

        $this->post(route('events.store'), [
            'eventDate' => $expectedEventDate,
            'location' => $expectedlocation,
            'event_description' => $expectedDescription,
            'user_band_id' => $expectUserBandID,
        ]);

        $events = Event::whereHas('UserBand', function ($query) use($user){
            return $query->where('user_id','=',Auth::user()->id);
        })->first();
        $this->assertNotNull($events);
        $this->assertEquals($events->eventDate, $expectedEventDate);
        $this->assertEquals($events->location, $expectedlocation);
        $this->assertEquals($events->event_description, $expectedDescription);
        $this->assertEquals($events->user_band_id, $expectUserBandID);
    }
}

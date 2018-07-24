<?php

use App\Event;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ViewEventListingTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function user_can_view_a_published_event_listing()
    {
        $event = factory(Event::class)->states(['published'])->create([
            'title' => 'The Red Chord',
            'subtitle' => 'with Animosity',
            'date' => Carbon::parse('December 13, 2016 8:00pm'),
            'ticket_price' => 3250,
            'venue' => 'The Pit',
            'venue_address' => '123 Example Street',
            'city' => 'Laraville',
            'state' => 'ON',
            'zip' => '17906',
            'additional_information' => 'For tickets, call 0555-223-4232',
        ]);

        $this->visit('/events/'.$event->id);

        $this->see('The Red Chord');
        $this->see('with Animosity');
        $this->see('December 13, 2016');
        $this->see('8:00pm');
        $this->see('32.50');
        $this->see('The Pit');
        $this->see('123 Example Street');
        $this->see('Laraville, ON 17906');
        $this->see('For tickets, call 0555-223-4232');
    }

    /** @test */
    function user_cannot_view_unpublished_event_listings()
    {
        $event = factory(Event::class)->states(['unpublished'])->create();

        $this->get('/events/'.$event->id);

        $this->assertResponseStatus(404);
    }
}

<?php

use App\Event;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EventTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function can_get_formatted_date()
    {
        $event = factory(Event::class)->make([
            'date' => Carbon::parse('2016-12-01 8:00pm')
        ]);

        $this->assertEquals('December 1, 2016', $event->formatted_date);
    }

    /** @test */
    function can_get_formatted_start_time()
    {
        $event = factory(Event::class)->make([
            'date' => Carbon::parse('2016-12-01 17:00:00')
        ]);

        $this->assertEquals('5:00pm', $event->formatted_start_time);
    }

    /** @test */
    function can_get_ticket_price_in_dollars()
    {
        $event = factory(Event::class)->make([
            'ticket_price' => 6750
        ]);

        $this->assertEquals('67.50', $event->ticket_price_in_dollars);
    }

    /** @test */
    function events_with_a_published_at_date_are_published()
    {
        $publishedEventA = factory(Event::class)->create(['published_at' => Carbon::parse('-1 week')]);
        $publishedEventB = factory(Event::class)->create(['published_at' => Carbon::parse('-1 week')]);
        $unpublishedEvent = factory(Event::class)->create(['published_at' => null]);

        $publishedEvents = Event::published()->get();

        $this->assertTrue($publishedEvents->contains($publishedEventA));
        $this->assertTrue($publishedEvents->contains($publishedEventB));
        $this->assertFalse($publishedEvents->contains($unpublishedEvent));
    }
}

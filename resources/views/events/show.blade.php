<h1>{{ $event->title }}</h1>
<h2>{{ $event->subtitle }}</h2>
<p>{{ $event->formatted_date }}</p>
<p>Doors at {{ $event->formatted_start_time }} </p>
<p>{{ $event->ticket_price_in_dollars }}</p>
<p>{{ $event->venue }}</p>
<p>{{ $event->venue_address }}</p>
<p>{{ $event->city }}, {{ $event->state }} {{ $event->zip }}</p>
<p>{{ $event->additional_information }}</p>
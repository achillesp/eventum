<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function show($id)
    {
        $event = Event::published()->findOrFail($id);

        return view('events.show', ['event' => $event]);
    }
}

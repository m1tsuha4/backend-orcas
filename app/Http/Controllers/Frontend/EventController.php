<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $page = 'Event';
        $events = Event::latest()->get();
        return view('frontend.pages.Event.index', compact('page', 'events'));
    }

    public function show($id)
    {
        $page = 'Event';
        $events = Event::inRandomOrder()->limit(6)->get();
        $event = Event::find($id);
        return view('frontend.pages.Event.detail', compact('page', 'events', 'event'));
    }
}

<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Event;
use Illuminate\Http\Request;

class ShowEventController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Event $event)
    {
        $isSubscribed = $request->user()->isSubscribedToEvent($event->id);

        $idCategory = $event->categories()->first()->id;

        $city = $event->location;

        $reviews = $event->reviews()->with('user')->get();


        return Inertia::render('Event', [
            'event' => $event,
            'isSubscribed' => $isSubscribed,
            'categories' => $event->getEventsByCategory($idCategory),
            'cities' => $event->getEventsByCity($city),
            'reviews' => $reviews,
        ]);
    }
}

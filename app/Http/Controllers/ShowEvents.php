<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;

class ShowEvents extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {        
        $articlePerPage = 2;
        if($request->has('category_id') && $request->category_id != 0) {
            $events = Event::getEventsOfCategory($request->category_id)->paginate(2);
        } else {
            $events = Event::with('categories')->paginate(2);
        }
        //dd($events);
        return Inertia::render('Events',
            [
                'events' => $events,
                'categories' => Category::all()
            ]);
    }
}

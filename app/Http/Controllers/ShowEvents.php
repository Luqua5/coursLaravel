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
        $articlePerPage = 12;
        if($request->has('category') && $request->has('city')) {
            $events = Event::getEventsByCategoryAndCity($request->category, $request->city)->paginate($articlePerPage);            
        } else {
            $events = Event::with('categories')->paginate($articlePerPage);
        }
        return Inertia::render('Events',
            [
                'events' => $events,
                'categories' => Category::all(),
                'cities' => Event::getCities(),
                'articlePerPage' => $articlePerPage,
            ]);
    }
}

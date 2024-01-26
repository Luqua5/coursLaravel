<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Event;
use Illuminate\Http\Request;

class ShowEvents extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        //dd(Event::with('categories')->paginate(10));

        return Inertia::render('Events',['events' => Event::with('categories')->paginate(2)]);
    }
}

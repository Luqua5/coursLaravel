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
        return Inertia::render('Events',
            [
                'events' => Event::with('categories')->paginate(2),
                'categories' => Category::all()
            ]);
    }
}

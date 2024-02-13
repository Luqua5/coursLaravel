<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $upcomingEvents = Event::upcomingEvents();

        $bestCategories = Category::CategoriesMostEvents();

        return Inertia::render('Dashboard', [
            'upcomingEvents' => $upcomingEvents,
            'bestCategories' => $bestCategories,
        ]);
    }
}

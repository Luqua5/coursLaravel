<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostReviewController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {   

        $request->validate([
            'content' => 'required',
            'rating' => 'required|integer|between:0,5',
            'event_id' => 'required|exists:events,id',
        ]);

        $request->merge(['user_id' => $request->user()->id]);


        $request->user()->reviews()->create($request->all());
    }
}

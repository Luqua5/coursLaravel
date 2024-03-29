<?php

use Inertia\Inertia;
use App\Models\Event;
use App\Http\Controllers\ShowEvents;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\ShowEventController;
use App\Http\Controllers\SubscribeController;
use App\Http\Controllers\PostReviewController;
use App\Http\Controllers\UnsubscribeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});
Route::any('/events', ShowEvents::class)->name('events');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', HomepageController::class)->name('dashboard');
    Route::post('/subscribe', SubscribeController::class)->name('subscribe');
    Route::post('/unsubscribe', UnsubscribeController::class)->name('unsubscribe');
    Route::get('/events/{event}', ShowEventController::class)->name('event');
    Route::post('/review', PostReviewController::class)->name('review');
});

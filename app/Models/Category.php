<?php

namespace App\Models;

use App\Models\Event;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description'
    ];

    /**
     * Get the events for the category.
     */
    public function events()
    {
        return $this->belongsToMany(Event::class, 'events_categories', 'id_category', 'id_evenement');
    }

    public static function CategoriesMostEvents()
    {
        return Category::withCount('events')->orderBy('events_count', 'desc')->limit(5)->get();
    }
}
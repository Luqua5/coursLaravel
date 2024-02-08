<?php

namespace App\Models;

use App\Models\User;
use App\Models\Review;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'location',
        'capacity',
        'price',
        'photo'
    ];

    protected $dates = ['start_date', 'end_date'];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = $value * 100;
    }

    public function getPriceAttribute($value)
    {
        return $value / 100;
    }

    

    /**
     * Get the categories for the event.
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'events_categories', 'id_evenement', 'id_category');
    }
    
    /**
     * Get the users for the event.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'users_events', 'id_event', 'id_user');
    }

    /**
     * Get number of users subscribed to the event
     */
    public function getNbUsersAttribute()
    {
        return $this->users()->count();
    }

    /**
     * Get all the city of the events
     */
    static function getCities()
    {
        return Event::select('location')->distinct()->get();
    }


    static function getEventsByCategoryAndCity($category, $city)
    {
        $query = self::query()
            ->when((string)$city, function ($query, string $city) {
                $query->where('location',$city);
            })
            ->when((string)$category, function ($query, string $category) {
                $query->whereHas('categories', function (Builder $query) use ($category) {
                    $query->where('id', $category);
                });
            });

        return $query;
    }

    public function getEventsByCategory($idCategory)
    {
        return $this->whereHas('categories', function($query) use ($idCategory) {
            $query->where('id', $idCategory)
            ->where('events.id', '!=', $this->id);
        })->get();
    }

    public function getEventsByCity($city)
    {
        return $this
            ->where('location', $city)
            ->where('events.id', '!=', $this->id)
            ->get();
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}

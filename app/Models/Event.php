<?php

namespace App\Models;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
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
}

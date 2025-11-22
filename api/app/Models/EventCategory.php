<?php

namespace App\Models;

use App\Models\Event;
use Illuminate\Database\Eloquent\Model;

class EventCategory extends Model
{
    protected $fillable = [
        'name',
        'description'
    ];

    // Relations
    public function events()
    {
        return $this->hasMany(Event::class);
    }
}

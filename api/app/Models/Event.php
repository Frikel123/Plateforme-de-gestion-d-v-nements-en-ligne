<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Payment;
use App\Models\EventCategory;

class Event extends Model
{
    protected $fillable = [
        'title',
        'prix',
        'description',
        'date_start',
        'date_end',
        'location',
        'organisateur_id',
        'category_id'
    ];

    // ✅ علاقة المشاركين (Participants)
    public function participants()
    {
        return $this->belongsToMany(User::class, 'inscriptions', 'event_id', 'user_id')->withTimestamps();
    }

    // ✅ علاقة الفئة (Catégorie)
    public function category()
    {
        return $this->belongsTo(EventCategory::class, 'category_id');
    }

    // ✅ علاقة المنظم (Organisateur)
    public function organizer()
    {
        return $this->belongsTo(User::class, 'organisateur_id');
    }

    // ✅ علاقة المدفوعات (Payments)
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}

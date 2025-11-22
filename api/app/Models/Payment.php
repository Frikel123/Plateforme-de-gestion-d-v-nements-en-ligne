<?php

namespace App\Models;

use App\Models\Event;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'amount',
        'payment_date',
        'payment_method',
        'participant_id',
        'event_id'
    ];

    // Relations
    public function participant()
    {
        return $this->belongsTo(User::class, 'participant_id');
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
    public function effectuerPaiement($data)
    {
        $this->amount = $data['amount'];
        $this->payment_date = now();
        $this->payment_method = $data['payment_method'];
        $this->participant_id = $data['participant_id'];
        $this->event_id = $data['event_id'];

        $this->save();

        return $this;
    }
}

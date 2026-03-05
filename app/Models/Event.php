<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'start_at',
        'end_at',
        'location',
        'max_participants',
        'status',
        'created_by',
    ];

    public function registrations()
    {
        return $this->hasMany(\App\Models\Registration::class, 'event_id');
    }

    public function creator()
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }
}
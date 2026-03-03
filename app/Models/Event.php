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
        return $this->hasMany(Registration::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
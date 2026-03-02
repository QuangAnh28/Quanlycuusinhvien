<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Registration;

class Event extends Model
{
    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }
}
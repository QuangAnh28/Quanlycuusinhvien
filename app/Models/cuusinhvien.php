<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cuusinhvien extends Model
{
    protected $table = 'cuusinhvien';

    protected $fillable = [
        'name',
        'email',
    ];
}
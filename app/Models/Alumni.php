<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    /**
     * Tên bảng trong database
     */
    protected $table = 'alumni';

    /**
     * Các cột cho phép dùng create() / update()
     */
    protected $fillable = [
        'student_code',
        'full_name',
        'email',
        'phone',
        'faculty',
        'major',
        'graduation_year',
        'job',
        'company',
        'address',
    ];

    /**
     * Ép kiểu dữ liệu
     */
    protected $casts = [
        'graduation_year' => 'integer',
    ];
}
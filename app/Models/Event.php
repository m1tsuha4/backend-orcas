<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        // 'sub_title',
        'desc',
        'img',
        'category',
        'date_open',
        'date_close',
        'open',
        'close',
        'address',
        'phone',
    ];
}

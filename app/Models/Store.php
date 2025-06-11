<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        // 'desc',
        'img',
        'category_id',
        'open',
        'close',
        'address',
        'phone',
    ];

    public function rCategory()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}

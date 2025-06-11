<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
    ];

    // public function rStore()
    // {
    //     return $this->hasMany(Store::class);
    // }

    public function Product()
    {
        return $this->hasMany(Product::class);
    }
}

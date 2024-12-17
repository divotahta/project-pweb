<?php

namespace App\Models;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $fillable = [
        'name',
        'slug',
    ];

    // Tambahkan relasi dengan Product
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
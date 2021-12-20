<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'name',
        'description',
        'price',
        'image',
        'category_id',
        'new',
        'hit',
        'recommended'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    public function labels()
    {
        return $this->belongsToMany(Label::class);
    }

    public function getTotalSum()
    {
        return $this->price * $this->pivot->count;
    }
}

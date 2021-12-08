<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'phone', 'status'];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('count')->withTimestamps();
    }

    public function getTotalSum()
    {
        $total = 0;
        foreach ($this->products as $product) {
            $total += $product->getTotalSum();
        }

        return $total;
    }
}

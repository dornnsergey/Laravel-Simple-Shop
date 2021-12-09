<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

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

    public function store(Request $request)
    {
        session()->forget('orderId');

        return $this->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'status' => 1,
        ]);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

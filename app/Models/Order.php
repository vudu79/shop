<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('count')->withTimestamps();
    }

    public function getTotalPrice()
    {
        $summ = 0;
        foreach ($this->products as $product) {
            $summ += $product->getPriceForCount();
        }
        return $summ;
    }


    public function saveOrder($data)
    {
        if ($this->status == 0) {
            $this->status = 1;
            $this->update($data);
            session()->forget('orderId');
            return true;

        } else {
            return false;
        }
    }
}

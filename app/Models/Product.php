<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orders()
    {
        $this->belongsToMany(Order::class);
    }

    public function getPriceForCount()
    {
        if (!is_null($this->pivot->count)){
            $priceForCount = $this->pivot->count * $this->price;
            return$priceForCount;
        }else{
            return $this->price;
        }
    }

}

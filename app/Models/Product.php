<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

//    Мутаторы на поля таблиц
    protected function setNewAttribute($value)
    {
        $this->attributes['new'] = $value === "on" ? 1 : 0;
    }


    protected function setHitAttribute($value)
    {
        $this->attributes['hit'] = $value === "on" ? 1 : 0;
    }


    protected function setRecommendAttribute($value)
    {
        $this->attributes['recommend'] = $value === "on" ? 1 : 0;
    }

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

    public function isNew()
    {
        return $this->new === 1;
    }

    public function isHit()
    {
        return $this->hit === 1;
    }

    public function isRecommend()
    {
        return $this->recommend === 1;
    }

    public function isAvailable()
    {
        return $this->count > 0 && !$this->trashed();
    }
}


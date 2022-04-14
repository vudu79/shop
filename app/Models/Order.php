<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = ['user_id'];


    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('count')->withTimestamps();
    }

    public function calculateFullSumm()
    {
        $summ = 0;
        foreach ($this->products()->withTrashed()->get() as $product) {
            $summ += $product->getPriceForCount();
        }
        return $summ;
    }


    public static function changeFullSumm($chengeSumm)
    {
        $summ = self::getFullSumm() + $chengeSumm;
        session(['full_order_summ'=>$summ]);
        return $summ;
    }

    public static function getFullSumm()
    {
        $summ = session('full_order_summ', 0);
        return $summ;
    }

    public static function eraseOrderSumm()
    {
        session()->forget('full_order_summ');
    }

    public function saveOrder($name, $phone)
    {
        if ($this->status == 0) {
            $this->status = 1;
            $this->name = $name;
            $this->phone = $phone;
//            $this->email = $email;
            $this->save();
            session()->forget('orderId');
            return true;
        } else {
            return false;
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

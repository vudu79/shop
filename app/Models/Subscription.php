<?php

namespace App\Models;

use App\Mail\ProductAddNitificationMail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Subscription extends Model
{
    use HasFactory;
    protected $fillable = ['email', 'product_id', 'status'];


    public function scopeActiveByProductId($query, $productId)
    {
        return $query->where('status', 0)->where('product_id', $productId);
    }

    public static function sendEmailBySubscription(Product $product)
    {
        $subscriptions = self::ActiveByProductId($product->id)->get();
        foreach ($subscriptions as $subscription) {
            Mail::to($subscription->email)->send(new ProductAddNitificationMail($product));
            $subscription->status = 1;
            $subscription->save();
            session()->flash('success', 'Сообщение клиентам отрпавлено!');
        }
    }

    public function product()
    {
        $this->belongsTo(Product::class);
    }
}

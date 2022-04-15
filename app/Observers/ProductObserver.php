<?php

namespace App\Observers;

use App\Mail\OrderCreateMail;
use App\Mail\ProductAddNitificationMail;
use App\Models\Product;
use App\Models\Subscription;
use Illuminate\Support\Facades\Mail;

class ProductObserver
{

    public function updating(Product $product)
    {
        $oldCount = $product->getOriginal('count');
        if ($oldCount == 0 && $product->count > 0) {
            Subscription::sendEmailBySubscription($product);
        }
    }

}

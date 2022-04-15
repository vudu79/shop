<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProductAddNitificationMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $product;

    /**
     * @param $product
     */
    public function __construct($product)
    {
        $this->product = $product;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.product_add_template', ['product'=>$this->product]);
    }
}

<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderCreateMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $name;
    protected $order;

    /**
     * @param $name
     * @param $order
     */
    public function __construct($name, Order $order)
    {
        $this->name = $name;
        $this->order = $order;
    }


    public function build()
    {
        $name = $this->name;
        $order = $this->order;
        return $this->view('mail.order_create_template',
            compact('name', 'order'));
    }
}

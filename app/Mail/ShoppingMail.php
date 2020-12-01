<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Order;
class ShoppingMail extends Mailable
{
    use Queueable, SerializesModels;
    public $orders;
    public $orderdetail = [];
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $orders, $orderdetail)
    {
        $this->orders = $orders;
        $this->orderdetail = $orderdetail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.shopping');
    }
}

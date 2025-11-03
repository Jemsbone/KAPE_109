<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\orders;

class OrderSummary extends Mailable
{
    use Queueable, SerializesModels;

    public $cartData;
    public $orderSummary;
    public $user;
    public $order;

    public function __construct($cartData, $orderSummary, $user, $order)
    {
        $this->cartData = $cartData;
        $this->orderSummary = $orderSummary;
        $this->user = $user;
        $this->order = $order;
    }

    public function build()
    {
        return $this->subject('Kape Na! - Order Confirmation #' . $this->order->order_number)
                    ->view('emails.order-summary')
                    ->with([
                        'cartData' => $this->cartData,
                        'orderSummary' => $this->orderSummary,
                        'user' => $this->user,
                        'order' => $this->order,
                    ]);
    }
}
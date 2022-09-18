<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderStateMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var App\Models\Order $order
     */
    private $order;

    /**
     * Create a new message instance.
     *
     * @param App\Models\Order $order
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = "Order #" . $this->order->id . " " . $this->order->state;
        $mail = $this->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
        $mail->to($this->order->email)
            ->subject($subject)
            ->markdown('website.mails.orders.' . $this->order->state, ['order' => $this->order]);
    }
}
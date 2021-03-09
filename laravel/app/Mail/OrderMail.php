<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $cart;
    public $user;

    public function __construct($cart, $user)
    // public function __construct($order)
      {
        $this -> cart = $cart;
        $this -> user = $user;
      }

    public function build()
    {
        return $this->from('conferma-ordine@deliveboo.it')
                    ->subject("Conferma ordine presso Deliveboo")
                    ->view('mails.order');
    }
}

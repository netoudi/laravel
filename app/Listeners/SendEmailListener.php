<?php

namespace CodeCommerce\Listeners;

use CodeCommerce\Events\CheckoutEvent;
use Illuminate\Mail\Mailer;

class SendEmailListener
{
    /**
     * @var Mailer
     */
    private $mailer;

    /**
     * Create the event listener.
     *
     * @param Mailer $mailer
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Handle the event.
     *
     * @param  CheckoutEvent $event
     * @return void
     */
    public function handle(CheckoutEvent $event)
    {
        $user = $event->getUser();
        $order = $event->getOrder();

        return $this->mailer->send('emails.checkout', [
            'user' => $user,
            'order' => $order,
        ], function ($message) use ($user) {
            $message->to($user->email, $user->name)
                ->subject("{$user->name}, seu pedido foi realizado com sucesso!");
        });
    }
}

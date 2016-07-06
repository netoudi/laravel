<?php

namespace CodeCommerce\Events;

use Illuminate\Queue\SerializesModels;

class CheckoutEvent extends Event
{
    use SerializesModels;
    /**
     * @var
     */
    private $user;
    /**
     * @var
     */
    private $order;

    public function __construct($user, $order)
    {
        $this->user = $user;
        $this->order = $order;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     * @return CheckoutEvent
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param mixed $order
     * @return CheckoutEvent
     */
    public function setOrder($order)
    {
        $this->order = $order;
        return $this;
    }
}

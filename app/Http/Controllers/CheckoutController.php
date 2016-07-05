<?php

namespace CodeCommerce\Http\Controllers;

use CodeCommerce\Http\Requests;
use CodeCommerce\Order;
use CodeCommerce\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    /**
     * @var Order
     */
    private $order;
    /**
     * @var OrderItem
     */
    private $orderItem;
    /**
     * @var User
     */
    private $user;

    /**
     * CheckoutController constructor.
     * @param Order $order
     * @param OrderItem $orderItem
     */
    public function __construct(Order $order, OrderItem $orderItem)
    {
        $this->user = Auth::user();
        $this->order = $order;
        $this->orderItem = $orderItem;
    }

    public function place()
    {
        if (!Session::has('cart')) {
            return redirect()->route('cart');
        }

        $cart = Session::get('cart');

        if ($cart->all() > 0) {
            $order = $this->order->create(['user_id' => $this->user->id, 'total' => $cart->getTotal()]);

            foreach ($cart->all() as $k => $item) {
                $order->items()->create([
                    'product_id' => $k,
                    'price' => $item['price'],
                    'qtd' => $item['qtd'],
                ]);
            }

            Session::forget('cart');
        }

        return view('store.checkout', compact('order'));
    }
}

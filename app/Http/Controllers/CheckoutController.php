<?php

namespace CodeCommerce\Http\Controllers;

use CodeCommerce\Events\CheckoutEvent;
use CodeCommerce\Order;
use CodeCommerce\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PHPSC\PagSeguro\Items\Item;
use PHPSC\PagSeguro\Requests\Checkout\CheckoutService;

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
     * @var CheckoutService
     */
    private $checkoutService;

    /**
     * CheckoutController constructor.
     * @param Order $order
     * @param OrderItem $orderItem
     * @param CheckoutService $checkoutService
     */
    public function __construct(Order $order, OrderItem $orderItem, CheckoutService $checkoutService)
    {
        $this->user = Auth::user();
        $this->order = $order;
        $this->orderItem = $orderItem;
        $this->checkoutService = $checkoutService;
    }

    public function place()
    {
        if (!Session::has('cart')) {
            return redirect()->route('cart');
        }

        $cart = Session::get('cart');

        if ($cart->all() > 0) {
            $order = $this->order->create(['user_id' => $this->user->id, 'total' => $cart->getTotal()]);
            $checkout = $this->checkoutService->createCheckoutBuilder();
            $checkout->setReference($order->id);

            foreach ($cart->all() as $k => $item) {
                $checkout->addItem(new Item($k, $item['name'], number_format($item['price'], 2, '.', ''), $item['qtd']));
                $order->items()->create([
                    'product_id' => $k,
                    'price' => $item['price'],
                    'qtd' => $item['qtd'],
                ]);
            }

            Session::forget('cart');

            $response = $this->checkoutService->checkout($checkout->getCheckout());

            return redirect($response->getRedirectionUrl());
        }

        return redirect()->route('cart');
    }

    public function payment(Request $request)
    {
        $transaction = $request->get('id');
        $order = $this->user->orders->last();
        $order->transaction = $transaction;
        $order->save();

        Session::set('checkout', $order);

        event(new CheckoutEvent(Auth::user(), $order));

        return redirect()->route('checkout');
    }

    public function checkout()
    {
        if (Session::has('checkout')) {
            $order = Session::get('checkout');
            Session::forget('checkout');

            return view('store.checkout', compact('order'));
        }

        return redirect()->route('cart');
    }
}

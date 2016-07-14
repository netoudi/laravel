<?php

namespace CodeCommerce\Http\Controllers;

use CodeCommerce\Events\CheckoutEvent;
use CodeCommerce\Order;
use CodeCommerce\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PHPSC\PagSeguro\Items\Item;
use PHPSC\PagSeguro\Purchases\Transactions\Locator;
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
     * @var Locator
     */
    private $locator;

    /**
     * CheckoutController constructor.
     * @param Order $order
     * @param OrderItem $orderItem
     * @param CheckoutService $checkoutService
     * @param Locator $locator
     */
    public function __construct(Order $order, OrderItem $orderItem, CheckoutService $checkoutService, Locator $locator)
    {
        $this->user = Auth::user();
        $this->order = $order;
        $this->orderItem = $orderItem;
        $this->checkoutService = $checkoutService;
        $this->locator = $locator;
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
        try {
            $idTransaction = $request->get('id');

            // Consultar detalhes da transação
            $transaction = $this->locator->getByCode($idTransaction);

            if ($transaction) {
                // Pegar os detalhes
                $details = $transaction->getDetails();

                // Consultar a order através da referência passada no checkout
                $order = Order::find($details->getReference());

                // Inserir o status atual da transação
                $order->status = $details->getStatus();

                // Inserir o id da transação
                $order->transaction = $idTransaction;

                // Salvar dados
                $order->save();

                Session::set('checkout', $order);

                // Notificar cliente sobre seu novo pedido realizado
                event(new CheckoutEvent(Auth::user(), $order));

                return redirect()->route('checkout');
            } else {
                throw new \Exception('Dados informados estão incorretos.');
            }
        } catch (\Exception $error) {
            return redirect('/');
        }
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

    public function notification(Request $request)
    {
        try {
            $notificationCode = $request->get('notificationCode');
            $notificationType = $request->get('notificationType');

            if ($notificationType == 'transaction') {
                // Consultar detalhes da transação
                $transaction = $this->locator->getByNotification($notificationCode);

                // Pegar os detalhes
                $details = $transaction->getDetails();

                // Consultar a order através da referência passada no checkout
                $order = Order::find($details->getReference());

                // Atualizar o status da order para o status atual da transação
                $order->status = $details->getStatus();

                // Inserir o id da transação
                if (empty($order->transaction)) {
                    $order->transaction = $details->getCode();
                }

                // Salvar dados alterados
                $order->save();

                return response(null, 200);
            } else {
                throw new \Exception('Dados informados estão incorretos.');
            }
        } catch (\Exception $error) {
            return response($error->getMessage(), 500);
        }
    }
}

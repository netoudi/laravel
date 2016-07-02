<?php

namespace CodeCommerce\Http\Controllers;

use CodeCommerce\Cart;
use CodeCommerce\Http\Requests;
use CodeCommerce\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * @var Cart
     */
    private $cart;

    /**
     * CartController constructor.
     * @param Cart $cart
     */
    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    public function index()
    {
        if (!Session::get('cart')) {
            Session::set('cart', $this->cart);
            $cart = $this->cart;
        } else {
            $cart = Session::get('cart');
        }

        return view('store.cart', compact('cart'));
    }

    public function add($id)
    {
        $cart = $this->getCart();
        $product = Product::find($id);
        $cart->add($product->id, $product->name, $product->price);

        Session::set('cart', $cart);

        return redirect()->route('cart');
    }

    public function update(Request $request)
    {
        $cart = $this->getCart();
        $items = $request->get('items');
        $cart->update($items);

        Session::set('cart', $cart);

        return redirect()->route('cart');
    }

    public function destroy($id)
    {
        $cart = $this->getCart();
        $cart->remove($id);

        Session::set('cart', $cart);

        return redirect()->route('cart');
    }

    /**
     * @return Cart
     */
    private function getCart()
    {
        if (Session::get('cart')) {
            return Session::get('cart');
        }

        return $this->cart;
    }
}

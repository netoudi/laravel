<?php

namespace CodeCommerce\Http\Controllers;

use CodeCommerce\Http\Requests;
use CodeCommerce\Order;
use Illuminate\Http\Request;

class AdminOrdersController extends Controller
{
    /**
     * @var Order
     */
    private $order;

    /**
     * AdminOrdersController constructor.
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = $this->order->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = $this->order->find($id);

        $options = [
            0 => 'Waiting for Payment',
            1 => 'Product Submitted',
            2 => 'Product Hand',
            3 => 'Cancelled',
        ];

        return view('admin.orders.form', compact('order', 'options'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->order->find($id)->update($request->all());

        return redirect()->route('admin.orders.index');
    }
}

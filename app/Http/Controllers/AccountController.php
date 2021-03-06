<?php

namespace CodeCommerce\Http\Controllers;

use CodeCommerce\Http\Requests;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('store.account', compact('user'));
    }

    public function orders()
    {
        $orders = Auth::user()->orders;

        return view('store.orders', compact('orders'));
    }
}

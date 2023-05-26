<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        if (\Cart::getcontent()->count() == 0) {
            return redirect()->route('welcome');
        }

        return view('checkout.create', [
            'order' => new Order()
        ]);
    }
}

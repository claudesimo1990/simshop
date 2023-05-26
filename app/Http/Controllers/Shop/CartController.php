<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutRequest;
use App\Models\Customer;
use App\Models\OrderItem;
use App\Models\Product;
use Darryldecode\Cart\CartCollection;
use Darryldecode\Cart\ItemCollection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function cartList()
    {
        if (\Cart::isEmpty()) {
            return redirect()->route('welcome');
        }

        return view('cart.cart');
    }

    public function show(Product $product)
    {
        return view('product.show', compact('product'));
    }

    public function addToCart(Request $request): RedirectResponse
    {
        \Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'attributes' => array(
                'image' => $request->media,
            )
        ]);
        session()->flash('livewire-toast', 'Product is Added to Cart Successfully !');
        return redirect()->back();
    }

    public function process(CheckoutRequest $request)
    {
        DB::beginTransaction();
        try {
            $customer = Customer::create([
                'name' => $request->get('firstname') . ' ' . $request->get('lastname'),
                'email' => $request->get('email'),
                'phone' => $request->get('phone'),
                'birthday' => $request->get('birthday'),
                'gender' => $request->get('gender'),
            ]);

            $order = $customer->orders()->create([
                'number' => uniqid(),
                'currency' => 'euro',
                'total_price' => \Cart::getTotal(),
                'status' => 'new',
                'shipping_price' => '00',
                'shipping_method' => 'free',
                'notes' => '',
            ]);

            $order->address()->create([
                'country' => $request->get('country'),
                'street' => $request->get('street'),
                'state' => $request->get('state'),
                'city' => $request->get('city'),
                'zip' => $request->get('zip'),
            ]);

            /** @var CartCollection $items */
            $items = \Cart::getContent();

            $items->map(function (ItemCollection $itemCollection) use ($order) {
                return OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $itemCollection->get('id'),
                    'qty' => $itemCollection->get('price'),
                    'unit_price' => $itemCollection->get('quantity'),
                ]);
            });
            DB::commit();
            \Cart::clear();
            return redirect()->route('checkout.success');
        }catch (\Exception $e) {
            echo $e;
            DB::rollBack();
        }
    }

    public function success()
    {
        return view('checkout.success');
    }

    public function failed()
    {
        return view('checkout.failed');
    }
}

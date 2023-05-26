<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CartList extends Component
{
    protected $listeners = ['cartUpdated' => '$refresh'];
    public $cartItems = [];

    public function removeCart($id)
    {
        \Cart::remove($id);
        $this->emit('cartUpdated');
        $this->emitTo('livewire-toast', 'show', ['type' => 'success', 'message' => 'Item has removed !']);
    }

    public function clearAllCart()
    {
        \Cart::clear();
        $this->emitTo('livewire-toast', 'show', ['type' => 'success', 'message' => 'All Item Cart Clear Successfully !']);
    }

    public function render()
    {
        $this->cartItems = \Cart::getContent()->toArray();

        return view('livewire.cart-list');
    }
}

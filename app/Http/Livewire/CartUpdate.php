<?php

namespace App\Http\Livewire;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CartUpdate extends Component
{
    public $cartItems = [];
    public $quantity = 1;

    public function mount($item): void
    {
        $this->cartItems = $item;

        $this->quantity = $item['quantity'];
    }

    public function updateCart(): void
    {
        \Cart::update($this->cartItems['id'], [
            'quantity' => [
                'relative' => false,
                'value' => $this->quantity
            ]
        ]);
        $this->emit('cartUpdated');
        $this->emitTo('livewire-toast', 'show', ['type' => 'success', 'message' => 'Item quantity has changed !']);
    }

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.cart-update', [
            'name' => $this->cartItems['name']
        ]);
    }
}

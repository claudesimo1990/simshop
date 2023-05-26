<?php

namespace App\Http\Livewire;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class NavCart extends Component
{
    protected $listeners = ['cartUpdated' => 'incrementCartProductCount', '$refresh'];

    public $count = 0;

    public function mount(): void
    {
        $this->count = \Cart::getTotalQuantity();
    }

    public function incrementCartProductCount(): void
    {
        $this->count = \Cart::getTotalQuantity();
    }

    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.nav-cart');
    }
}

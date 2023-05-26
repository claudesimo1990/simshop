<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Filament\Forms;

class Checkout extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public Order $order;

    protected $listeners = ['cartUpdated' => '$refresh'];

    public function removeCart($id)
    {
        \Cart::remove($id);
        session()->flash('success', 'Item has removed !');
        $this->emit('cartUpdated');
    }

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.checkout');
    }
}

<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Flash extends Component
{
    protected $listeners = ['cartUpdated' => 'test', '$refresh'];

    public function test()
    {
    }

    public function render()
    {
        return view('livewire.flash');
    }
}

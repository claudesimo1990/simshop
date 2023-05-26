@extends('layouts.app')

@section('content')
    <div class="bg-gray-50">
        <div class="mx-auto max-w-2xl px-4 pb-24 pt-16 sm:px-6 lg:max-w-7xl lg:px-8">
            <h2 class="sr-only">Checkout</h2>
            @livewire('checkout', [$order])
        </div>
    </div>
@endsection

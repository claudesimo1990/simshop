<form class="lg:grid lg:grid-cols-2 lg:gap-x-12 xl:gap-x-16" action="{{ route('checkout.process') }}" method="POST">
    @csrf
    @method('POST')
    <div>
        <div>
            <h2 class="text-lg font-medium text-gray-900">Contact information</h2>

            <div class="mt-4">
                <label for="email-address" class="block text-sm font-medium text-gray-700">Email address</label>
                <div class="mt-1">
                    @if (auth()->user())
                        <input type="email" id="email-address" name="email" value="{{ auth()->user()->email }}" autocomplete="email" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    @else
                        <input type="email" id="email-address" name="email" autocomplete="email" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    @endif
                </div>
            </div>
        </div>
        <div class="mt-10 border-t border-gray-200 pt-10">
            <h2 class="text-lg font-medium text-gray-900">Shipping information</h2>

            <div class="mt-4 grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-4">
                <div>
                    <label for="first-name" class="block text-sm font-medium text-gray-700">First name</label>
                    <div class="mt-1">
                        <input type="text" id="first-name" name="firstname" value="{{ old('firstname') }}"  autocomplete="given-name" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('firstname')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div>
                    <label for="last-name" class="block text-sm font-medium text-gray-700">Last name</label>
                    <div class="mt-1">
                        <input type="text" id="last-name" name="lastname" value="{{ old('lastname') }}"  autocomplete="family-name" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('lastname')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div>
                    <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                    <div class="mt-1">
                        <input type="text" name="city" id="city" value="{{ old('city') }}"  autocomplete="address-level2" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('city')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="country" class="block text-sm font-medium text-gray-700">Country</label>
                    <div class="mt-1">
                        <select id="country" name="country" autocomplete="country-name" value="{{ old('country') }}"  class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <option>United States</option>
                            <option>Canada</option>
                            <option>Mexico</option>
                        </select>
                        @error('country')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div>
                    <label for="region" class="block text-sm font-medium text-gray-700">State / Province</label>
                    <div class="mt-1">
                        <input type="text" name="state" id="region" value="{{ old('state') }}"  autocomplete="address-level1" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('state')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div>
                    <label for="zip" class="block text-sm font-medium text-gray-700">Postal code</label>
                    <div class="mt-1">
                        <input type="text" name="zip" id="zip" value="{{ old('zip') }}"  autocomplete="zip" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('zip')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                    <div class="mt-1">
                        <input type="tel" name="phone" id="phone" value="{{ old('phone') }}"  autocomplete="phone" placeholder="015752804191" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('phone')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div>
                    <label for="postal-code" class="block text-sm font-medium text-gray-700">Birthday</label>
                    <div class="mt-1">
                        <input type="date" name="birthday" id="postal-code" value="{{ old('birthday') }}" autocomplete="postal-code" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('birthday')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <!-- Payment -->
        <div class="mt-10 border-t border-gray-200 pt-10" x-data="payments">
            <h2 class="text-lg font-medium text-gray-900">Payment</h2>
            <fieldset class="mt-4">
                <legend class="sr-only">Payment type</legend>
                <div class="space-y-4 sm:flex sm:items-center sm:space-x-10 sm:space-y-0">
                    <div class="flex items-center">
                        <input id="credit-card" name="payment-type" @change="change('card')"  type="radio" checked class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500">
                        <label for="credit-card" class="ml-3 block text-sm font-medium text-gray-700">Credit card</label>
                    </div>
                    <div class="flex items-center">
                        <input id="paypal" name="payment-type" type="radio" @change="change('paypal')" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500">
                        <label for="paypal" class="ml-3 block text-sm font-medium text-gray-700">Paypal</label>
                    </div>
                </div>
            </fieldset>
            <template x-cloak x-if="payment == 'card'" x-transition>
                <div class="mt-6 grid grid-cols-4 gap-x-4 gap-y-6">
                    <div class="col-span-4">
                        <label for="card-number" class="block text-sm font-medium text-gray-700">Card number</label>
                        <div class="mt-1">
                            <input type="text" id="card-number" name="card-number" autocomplete="cc-number" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                    </div>
                    <div class="col-span-4">
                        <label for="name-on-card" class="block text-sm font-medium text-gray-700">Name on card</label>
                        <div class="mt-1">
                            <input type="text" id="name-on-card" name="name-on-card" autocomplete="cc-name" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                    </div>
                    <div class="col-span-3">
                        <label for="expiration-date" class="block text-sm font-medium text-gray-700">Expiration date (MM/YY)</label>
                        <div class="mt-1">
                            <input type="text" name="expiration-date" id="expiration-date" autocomplete="cc-exp" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                    </div>
                    <div>
                        <label for="cvc" class="block text-sm font-medium text-gray-700">CVC</label>
                        <div class="mt-1">
                            <input type="text" name="cvc" id="cvc" autocomplete="csc" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                    </div>
                </div>
            </template>
            <template x-cloak x-if="payment == 'paypal'" x-transition>
                <div class="mt-6 grid grid-cols-4 gap-x-4 gap-y-6">
                    <div class="col-span-4">
                        <label for="card-number" class="block text-sm font-medium text-gray-700">Paypal Email</label>
                        <div class="mt-1">
                            <input type="text" id="card-number" name="paypal_email" autocomplete="cc-number" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>
    <!-- Order summary -->
    <div class="mt-10 lg:mt-0">
        <h2 class="text-lg font-medium text-gray-900">Order summary</h2>
        <div class="mt-4 rounded-lg border border-gray-200 bg-white shadow-sm">
            <h3 class="sr-only">Items in your cart</h3>
            <ul role="list" class="divide-y divide-gray-200">

                @foreach(Cart::getContent() as $item)
                    @php
                        $product = getProduct($item['id']);
                    @endphp
                    <li class="flex px-4 py-6 sm:px-6">
                        <div class="flex-shrink-0">
                            {{ $product->image->img('small')->attributes(['css' => 'w-20 rounded-md']) }}
                        </div>
                        <div class="ml-6 flex flex-1 flex-col">
                            <div class="flex">
                                <div class="min-w-0 flex-1">
                                    <h4 class="text-sm">
                                        <a href="#" class="font-medium text-gray-700 hover:text-gray-800">{{ $item['name'] }}</a>
                                    </h4>
                                    <p class="mt-1 text-sm text-gray-500">Black</p>
                                    <p class="mt-1 text-sm text-gray-500">Large</p>
                                </div>
                                <div class="ml-4 flow-root flex-shrink-0">
                                    <button type="button" wire:click.prevent="removeCart('{{ $item['id'] }}')" class="-m-2.5 flex items-center justify-center bg-white p-2.5 text-gray-400 hover:text-gray-500">
                                        <span class="sr-only">Remove</span>
                                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M8.75 1A2.75 2.75 0 006 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 10.23 1.482l.149-.022.841 10.518A2.75 2.75 0 007.596 19h4.807a2.75 2.75 0 002.742-2.53l.841-10.52.149.023a.75.75 0 00.23-1.482A41.03 41.03 0 0014 4.193V3.75A2.75 2.75 0 0011.25 1h-2.5zM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4zM8.58 7.72a.75.75 0 00-1.5.06l.3 7.5a.75.75 0 101.5-.06l-.3-7.5zm4.34.06a.75.75 0 10-1.5-.06l-.3 7.5a.75.75 0 101.5.06l.3-7.5z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="flex flex-1 items-end justify-between pt-2">
                                <p class="mt-1 text-sm font-medium text-gray-900">{!! format_price($item['price']) !!}</p>

                                <div class="ml-4">
                                    <livewire:cart-update :item="$item" :key="$item['id']"/>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach

                <!-- More products... -->
            </ul>
            <dl class="space-y-6 border-t border-gray-200 px-4 py-6 sm:px-6">
                <div class="flex items-center justify-between">
                    <dt class="text-sm">Subtotal</dt>
                    <dd class="text-sm font-medium text-gray-900">{!! format_price(Cart::getSubTotal()) !!}</dd>
                </div>
                <div class="flex items-center justify-between">
                    <dt class="text-sm">Shipping</dt>
                    <dd class="text-sm font-medium text-gray-900">{!! format_price('5.00') !!}</dd>
                </div>
                <div class="flex items-center justify-between">
                    <dt class="text-sm">Taxes</dt>
                    <dd class="text-sm font-medium text-gray-900">{!! format_price('5.02') !!}</dd>
                </div>
                <div class="flex items-center justify-between border-t border-gray-200 pt-6">
                    <dt class="text-base font-medium">Total</dt>
                    <dd class="text-base font-medium text-gray-900">{!! format_price(Cart::getTotal()) !!}</dd>
                </div>
            </dl>

            <div class="border-t border-gray-200 px-4 py-6 sm:px-6">
                <button type="submit" class="w-full rounded-md border border-transparent bg-indigo-600 px-4 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-50">process checkout</button>
            </div>
        </div>
        @livewire('flash')
    </div>
</form>

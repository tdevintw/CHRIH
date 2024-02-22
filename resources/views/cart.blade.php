@extends('layout')
@section('content')
    @if ($count == 0)
        <div class="flex flex-col items-center mt-5 mb-5">
            <h1 class="text-4xl font-extrabold dark:text-white">Your cart is empty</h1>
            <img src="https://cdn-icons-png.flaticon.com/512/11329/11329060.png" alt="">
            <a href="{{ route('home') }}"><button type="button"
                    class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Shop
                    now</button>
            </a>
        </div>
    @else
        <div>
            <div>
                <div class="flex items-end lg:flex-row flex-col justify-end " id="cart">
                    <div div
                        class="w-full lg:px-8 lg:py-14 md:px-6 px-4 md:py-8 py-4 bg-white dark:bg-gray-800 overflow-y-auto overflow-x-hidden lg:h-screen h-auto"
                        id="scroll">
                        <a href="{{route('home')}}">
                            <div class="flex items-center text-gray-500 hover:text-gray-600 dark:text-white cursor-pointer"
                                onclick="checkoutHandler(false)">
                                <img class="dark:hidden"
                                    src="https://tuk-cdn.s3.amazonaws.com/can-uploader/shopping-cart-1-svg1.svg"
                                    alt="previous" />
                                <img class="dark:block hidden"
                                    src="https://tuk-cdn.s3.amazonaws.com/can-uploader/shopping-cart-1-svg1dark.svg"
                                    alt="previous" />
                                <p class="text-sm pl-2 leading-none dark:hover:text-gray-200">Back</p>
                            </div>
                        </a>
                        <p class="lg:text-4xl text-3xl font-black leading-10 text-gray-800 dark:text-white pt-3">Cart:</p>
                        @foreach ($shopingcards as $cart)
                            <div class="md:flex items-strech py-8 md:py-10 lg:py-8 border-t border-gray-50">
                                <div class="md: w-10 2xl:w-1/4 w-full flex justify-center">

                                    <img src="{{ asset('storage/' . $cart->product->image) }}" alt="product"
                                        class=" object-center object-cover md:block hidden" style="width:150px;" />
                                    <img src="{{ asset('storage/' . $cart->product->image) }}" alt="product"
                                        class="md:hidden  object-center object-cover mb-5" style="width:150px;" />
                                </div>
                                <div class="md:pl-3 md:w-8/12 2xl:w-3/4 flex flex-col justify-center">
                                    <div class="flex items-center justify-between w-full pt-1">
                                        <div class="flex gap-3 items-center">
                                            <p class="text-base font-black leading-none text-gray-800 dark:text-white">
                                                {{ $cart->product->name }}

                                            </p>
                                            <p class="text-[12px]">
                                                {{ $cart->product->quantity }} unit Left

                                            </p>
                                        </div>
                                        @if ($cart->product->quantity == 0)
                                            <h2>Out of stock </h2>
                                        @else
                                            <form class="flex items-center gap-3" action="{{ route('cart.check') }}"
                                                method="post">
                                                @csrf

                                                @if ($check && $cart->product_id == $check['id'])
                                                    <p>{{ $check['check'] }}</p>
                                                @endif

                                                <input name="number" type="number" id="number-input"style="width:60px"
                                                    aria-describedby="helper-text-explanation"
                                                    class="w-15 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 "
                                                    value="{{ $cart->quantity }}" />
                                                <input type="hidden" name="product_id" value="{{ $cart->product_id }}">
                                                <input type="hidden" name="product_name"
                                                    value="{{ $cart->product->name }}">


                                                <button type="submit"
                                                    class="text-white bg-green-600 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium  text-sm px-5 py-2.5 text-center me-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">check</button>


                                            </form>
                                        @endif


                                    </div>
                                    <div class="flex items-center justify-between pt-5">
                                        <div class="flex itemms-center">

                                            <form class="flex gap-5" action="{{ route('cart.delete') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $cart->product_id }}">
                                                <p
                                                    class="text-xs leading-3 underline text-gray-800 dark:text-white cursor-pointer">
                                                    Add
                                                    to favorites</p>
                                                <button class="text-xs leading-3 underline text-red-500 pl-5 cursor-pointer"
                                                    type="submit">Remove</button>

                                            </form>

                                        </div>
                                        <p class="text-base font-black leading-none text-gray-800 dark:text-white">
                                            {{ $cart->product->price }}$</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <div class="lg:w-96 md:w-8/12 w-full bg-gray-100 dark:bg-gray-900 h-full">
                        <div
                            class="flex flex-col lg:h-screen h-auto lg:px-8 md:px-7 px-4 lg:py-20 md:py-10 py-6 justify-between overflow-y-auto">
                            <div>
                                <p class="lg:text-4xl text-3xl font-black leading-9 text-gray-800 dark:text-white">Summary
                                </p>
                                @foreach ($shopingcards as $cart)
                                    @if ($cart->product->quantity != 0)
                                        <div class="flex items-center justify-between pt-10">
                                            <p class="text-base leading-none text-gray-800 dark:text-white">
                                                {{ $cart->product->name }} x {{ $cart->quantity }}</p>
                                            <p class="text-base leading-none text-gray-800 dark:text-white">
                                                @php
                                                    $total = $cart->product->price * $cart->quantity;
                                                @endphp
                                                {{ $total }}$
                                            </p>
                                        </div>
                                    @endif
                                @endforeach

                            </div>
                            <div>
                                <div class="flex items-center pb-6 justify-between lg:pt-5 pt-20">
                                    <p class="text-2xl leading-normal text-gray-800 dark:text-white">Total</p>
                                    <p class="text-2xl font-bold leading-normal text-right text-gray-800 dark:text-white">
                                        @php

                                            $totalcart = 0;

                                            foreach ($shopingcards as $cart) {
                                                if ($cart->product->quantity != 0) {
                                                    $products[] = $cart;
                                                    $totalcart = $totalcart + $cart->product->price * $cart->quantity;
                                                }
                                            }

                                        @endphp
                                        {{ $totalcart }}$
                                    </p>
                                </div>
                                <form action="{{ route('pay') }}" method="get">
                                    @csrf
                                    <input type="hidden" name="quantity" value="{{ $count }}">
                                    <input type="hidden" name="total" value="{{ $totalcart }}">
                                    <button type="submit"
                                        class="text-base leading-none w-full py-5 bg-gray-800 border-gray-800 border focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800 text-white dark:hover:bg-gray-700">Checkout</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    @endif
    @if (session('cartinfos'))
        <div id="toast-success"
            class="fixed bottom-0 left-0 w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800">
            <div class="flex items-center">
                <div
                    class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                    </svg>
                    <span class="sr-only">Check icon</span>
                </div>
                <div class="ms-3 text-sm font-normal">{{ session('cartinfos') }}</div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                    onclick="closeToast()">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        </div>
    @endif
    <script>
        function closeToast() {
            const toastSuccess = document.getElementById('toast-success');
            if (toastSuccess) {
                toastSuccess.style.display = 'none';
            }
        }
    </script>
@endsection
@extends('layout')
@section('content')
<section class="text-gray-600 body-font">

    <div class="bg-green-100 py-8 grid grid-cols-1 md:grid-cols-2">
        <!-- Left hero section-->
        <div class="flex flex-col justify-center p-4 py-10 md:p-10">
          <div>
              <h1 class="title-font sm:text-4xl text-3xl mb-4 font-serif font-medium text-2xl lg:w-2/3">
                 BasmaShop " Your Green Oasis"
                </h1>
              <p class="lg:w-2/3">Green Dreams Come True!</p>
          </div>
      
          <div class="mt-8 ">
              <form action="{{ route('search') }}" class="flex">
                  <label for="simple-search" class="sr-only">Search</label>
                  <div class="w-full">
                      <input type="text" name='q' class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Your Plants ..." required />
                  </div>
                  <button type="submit" class="p-2.5 ms-2 text-sm font-medium text-white bg-green-800 rounded-lg border border-blue-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                      <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                      </svg>
                      <span class="sr-only">Search</span>
                  </button>
              </form>
          </div>
          
      </div>
      
        
        <!-- Right hero section-->
        <div class="md:ml-4">
            <img class="object-cover w-full h-full" src="https://media.architecturaldigest.com/photos/61b2663233cd73a3aa79deb8/master/w_1600%2Cc_limit/Image8.jpg"
                alt="">
        </div>
    </div>
  </section>
    <div class=" px-4 mt-8 sm:px-10">
        <div class="font-[sans-serif] bg-gray-50">
           
                <div class="xl:col-span-2 h-max rounded-md p-8 sticky top-0">
                    <h2 class="text-2xl font-bold text-primary-400">All Products in your hand </h2>
                    <section class="text-gray-600 bg-green-50 body-font">
                      <div class="px-5 py-24 mx-auto flex flex-wrap -m-4">
                  
                        @foreach ($products as $product)
                        <div class=" lg:w-1/4 md:w-1/2 p-4 w-full">
                            <a class="block relative h-48 rounded overflow-hidden">
                                <img alt="Product" class="object-cover object-center w-full h-full block"
                                    src="{{ asset('storage/' . $product->image) }}">
                            </a>
        
                            <div class="mt-4 flex items-center justify-between">
                                <div>
                                    <strong class="text-gray-900 title-font text-lg font-medium">{{ $product->name }}</strong>
                                    <p class="mt-1 text-gray-900">Price : <strong class="text-orange-500">${{ $product->price }}</strong></p>
                                    @if ($product->category)
                                    <h1>Category : {{ $product->category->name }}</h1>
                               
                                @endif
                                </div>
                                
                                @if ($product->quantity == 0)
                        <button 
                        class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 rounded-full text-xs px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">out of stock</button>
                        @else
                        <form action="{{route('cart.insert')}}" method="post">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit"
                                class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Add</button>
                        </form>   
                        @endif
                            </div>
                        </div>
                    @endforeach
                      </div>
                  </section>
                </div>
            </div>
        </div>
    </div>
@endsection
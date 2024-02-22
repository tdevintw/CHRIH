@extends('layout')
@section('content')

<section class="text-gray-600 bg-green-50 body-font">
    <div class="px-5 py-8 mx-auto justify-center flex flex-wrap items-center -m-4">
        @if ($products->isEmpty())
       
        <div class="flex flex-col justify-center ">
            <img src="https://cdni.iconscout.com/illustration/premium/thumb/product-is-empty-8044872-6430781.png" alt="">
            <p class="text-4xl text-red-400 font-extrabold dark:text-white">No products found!!?</p>
            </div>
            
        @else
            @foreach ($products as $product)
                <div class=" lg:w-1/4 md:w-1/2 p-4 w-full">
                    <a class="block relative h-48 rounded overflow-hidden">
                        <img alt="Product" class="object-cover object-center w-full h-full block" src="{{ asset('storage/'. $product->image) }}">
                    </a>
                    
                    <div class="mt-4 flex items-center justify-between">
                        <div>
                            <h2 class="text-gray-900 title-font text-lg font-medium">{{ $product->name }}</h2>
                            <p class="mt-1">${{ $product->price }}</p>
                        </div>
                        @if ($product->quantity == 0)
                        <button 
                        class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">out of stock</button>
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
        @endif
    </div>
    
</section>

@endsection
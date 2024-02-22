@extends('layout')

@section('content')
<section class="text-gray-600 body-font overflow-hidden">
  <div class="px-5 py-24 mx-auto flex items-start flex-wrap">
    <div class="lg:w-1/2 px-5 py-24 mx-auto flex flex-wrap -m-4  flex items-center justify-center">
      @if(count($products) > 0)
          <img alt="category img" class="lg:w-2/2 mb-4 h-96  flex items-center object-cover object-center rounded" src="{{ asset('storage/'. $products[0]->category->image) }}">
          <h1 class="text-center mb-4 text-gray-900 text-3xl title-font font-medium">{{ $products[0]->category->name }}</h1>
          <p class="text-center">{{ $products[0]->category->description}}</p>
        
      @endif
    </div>

    <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
      <div>
      </div>
      <section class="text-gray-600 bg-green-50 body-font">
        
        <div class="px-5 py-24 mx-auto flex flex-wrap -m-4">

          @foreach ($products as $product)
            <div class="lg:w-1/2 md:w-1/2  p-4 w-full">
              <a class="block relative h-48 rounded overflow-hidden">
                <img alt="Product" class="object-cover object-center w-full h-full block" src="{{ asset('storage/'. $product->image) }}">
              </a>
              
              <div class="mt-4 flex items-center justify-between">
                <div>
                  <h2 class="text-gray-900 title-font text-lg font-medium">{{ $product->name }}</h2>
                  <p class="mt-1 text-gray-900">Price : <strong class="text-orange-500">${{ $product->price }}</strong></p>
                </div>
                @if ($product->quantity == 0)
                <button 
                class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300  rounded-full text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">out of stock</button>
                @else
                <form action="{{route('cart.insert')}}" method="post">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button type="submit"
                        class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Add</button>
                </form>   
                @endif              </div>
            </div>
          @endforeach
        </div>
      </section>
    </div>
  </div>
</section>
@endsection
@extends('layout')

@section('content')
<section class="text-gray-600 body-font overflow-hidden">
  <div class="px-5 py-24 mx-auto flex items-start flex-wrap">
    <div class="bg-red-400">
    <img alt="ecommerce" class="lg:w-1/2 lg:h-auto h-96 object-cover object-center rounded" src="https://dummyimage.com/400x400">
  </div>
    <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
      <h2 class="text-sm title-font text-gray-500 tracking-widest">BRAND NAME</h2>
      <h1 class="text-gray-900 text-3xl title-font font-medium mb-1">The Catcher in the Rye</h1>
      <section class="text-gray-600 bg-green-50 body-font">
        <div class="px-5 py-24 mx-auto flex flex-wrap -m-4">
            @foreach ($products as $product)
            <div class="lg:w-1/2 md:w-1/2 p-4 w-full">
                <a class="block relative h-48 rounded overflow-hidden">
                    <img alt="Product" class="object-cover object-center w-full h-full block" src="{{ asset('storage/'. $product->image) }}">
                </a>
                
                <div class="mt-4 flex items-center justify-between">
                    <div>
                        <h2 class="text-gray-900 title-font text-lg font-medium">{{ $product->name }}</h2>
                        <p class="mt-1">${{ $product->price }}</p>
                    </div>
                    <button type="button" class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Buy</button>
                </div>
            </div>
            @endforeach
        </div>
      </section>
    </div>
  </div>
</section>
@endsection

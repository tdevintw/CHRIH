@extends('layout')
@section('content')
<section class="text-gray-600 body-font">

  <div class="bg-green-100 py-8 grid grid-cols-1 md:grid-cols-2">
      <!-- Left hero section-->
      <div class="flex flex-col justify-center p-4 py-10 md:p-10">
        <div>
            <h1 class="title-font sm:text-4xl text-3xl mb-4 font-serif font-medium text-2xl lg:w-2/3">
                Discover Happiness in Every Plant .</h1>
            <p class="lg:w-2/3">Explore and Elevate Your Space with Our Exquisite Plant Collection!</p>
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
          <img class="object-cover w-full h-full" src="https://media.istockphoto.com/id/1555375435/fr/photo/serre-%C3%A9cologique-et-portrait-de-femme-avec-une-plante-pour-un-don-durable-ou-botanique.jpg?s=612x612&w=0&k=20&c=B9GvNv-iE4741JmtqN2bUxHxanm-F7gqVdk1o9c3iUE="
              alt="">
      </div>
  </div>
</section>


 <!--Categorie section -->
 <section class="text-gray-600 body-font">
    <div class="px-5 py-8 mx-auto flex flex-wrap -m-4">
        <h1 class="sm:text-3xl text-3xl font-medium title-font text-gray-900 mb-8">The Category </h1>

        <div class="flex flex-wrap -m-4">
            @foreach ($categories as $categorie)
                <div class="lg:w-1/4 md:w-1/2 p-4 w-full">
                    <a href="{{route('show',$categorie->id)}}" class="block w-full h-full">
                        <div class="flex relative">
                            <img alt="gallery" class="absolute inset-0 w-full  object-cover object-center"
                                src="{{ 'storage/'.$categorie->image }}">
                            <div
                                class="px-8 py-10 relative z-10  border-4 border-gray-200 bg-white opacity-0 hover:opacity-100">
                                <strong class="tracking-widest text-sm title-font font-bold text-indigo-700 mb-1">{{$categorie->name}}</strong>
                                <p class="leading-relaxed">{{$categorie->description}}.</p>
                            </div>
                        </div>
                    </a>
                    {{-- <h1 class="text-sm text-gray-500 text-centre ">{{$categorie->name}}</h1>  --}}

                </div>

            @endforeach
        </div>
    </div>
</section>



    <section class="text-gray-600 bg-green-50 body-font">
        <div class="px-5 py-24 mx-auto flex flex-wrap -m-4">
            <h1 class="sm:text-3xl text-2xl font-medium title-font mb-10 text-gray-900 w-full">Large Plants & Trees</h1>
    
            @foreach ($products as $product)
            <div class="lg:w-1/4 md:w-1/2 p-4 w-full">
                <a class="block relative h-48 rounded overflow-hidden">
                    <img alt="Product" class="object-cover object-center w-full h-full block" src="{{ asset('storage/'. $product->image) }}">
                </a>
                
                <div class="mt-4 flex items-center justify-between">
                    <div>
                        <h2 class="text-gray-900 title-font text-lg font-medium">{{ $product->name }}</h2>
                        <p class="mt-1 text-gray-900">Price : <strong class="text-orange-500">${{ $product->price }}</strong></p>
                        @if ($product->category)
                        <h1>Category : {{ $product->category->name }}</h1>
                   
                    @endif                    </div>

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
        </div>
    </section>
    


    <div class=" mx-auto">
        <div class="bg-gradient-to-br from-green-600 to-lime-800	 text-white text-center py-10 px-20 rounded-lg shadow-md relative">
            <img src="https://dynamic.brandcrowd.com/asset/logo/cc6e610e-67f9-4de3-95b1-d55795a240f2/logo-search-grid-2x?logoTemplateVersion=2&v=638371196642500000&text=BasmaShop" class="w-20 mx-auto mb-4 rounded-lg">
            <h3 class="text-2xl font-semibold mb-4"><strong class="">20%</strong> flat off on all rides within the city<br>using HDFC Credit Card</h3>
            <div class="flex items-center space-x-2 mb-6">
                <span id="cpnCode" class="border-dashed border text-white px-4 py-2 rounded-l">Favoris Soldes</span>
                <span id="cpnBtn" class="border border-white bg-white text-purple-600 px-4 py-2 rounded-r cursor-pointer">STEALDEAL20</span>
            </div>
            <p class="text-sm">Valid Till: 20Dec, 2021</p>
            
<div class=" absolute top-1/2 transform -translate-y-1/2 left-0 -ml-6"></div>
<div class="absolute top-1/2 transform -translate-y-1/2 right-0 -mr-6"></div>

        </div>
    </div>

    <section class="text-gray-600 bg-green-50 body-font">
        <div class=" mx-auto flex px-5 py-24 md:flex-row flex-col items-center">

            <div class="lg:max-w-lg lg:w-full md:w-1/2 w-5/6 mb-10 md:mb-0">
                <img class="object-cover object-center rounded" alt="hero"
                    src="https://media.istockphoto.com/id/1305447687/fr/photo/prendre-soin-de-mes-plantes.jpg?s=612x612&w=0&k=20&c=H1fThU4a32My1yqjLkKGTghKRRD6evetgIY3QjgNL9c=">
            </div>
            <div
                class="lg:flex-grow md:w-1/2 lg:pl-24 md:pl-16 flex flex-col md:items-start md:text-left items-center text-center">
                <h1 class="title-font sm:text-4xl text-3xl font-serif  mb-4 font-medium ">Nurturing Indoor Bliss:
                    <br class="hidden lg:inline-block">  Guide to Tailored Plant Care
                </h1>
                <p class="mb-8 leading-relaxed">To ensure the well-being of your indoor Plants, tailor your care routine by
                    providing regular watering, adequate light, well-draining soil, and balanced fertilization. Practice
                    regular pruning, monitor for pests, and maintain appropriate ambient humidity. Protect plants from
                    temperature fluctuations and drafts. To have additional information, click on the "More" button.
                </p>
                <div class="flex justify-center">
                    <button
                        class="inline-flex bg-green-700	 text-white  border-0 py-2 px-6 focus:outline-none hover:bg-green-400 rounded text-lg">More</button>
                </div>
            </div>
        </div>
    </section>
@endsection
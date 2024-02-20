@foreach ($categories as $categorie)
  <div class="flex relative">
    <img alt="gallery" class="absolute inset-0 w-full  object-cover object-center"
        src="{{ 'storage/'.$categorie->image }}">
   </div>


@endforeach




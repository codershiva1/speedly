<a href="{{ route('shop.index', ['category' => $category->slug]) }}"
   class="group flex flex-col items-center text-center bg-[#F4F7FB] rounded-2xl p-2 shadow-sm 
          hover:shadow-md hover:-translate-y-1 transition-all w-full">

    <div class="h-20 w-20 flex items-center justify-center overflow-hidden rounded-md">
        <img src="{{ asset('storage/'.$category->image) }}"
             alt="{{ $category->name }}"
             class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105">
    </div>

    <p class="mt-3 font-semibold text-gray-900 text-xs md:text-sm leading-tight">
        {{ $category->name }}
    </p>

    <p class="text-gray-500 text-[11px] md:text-xs">
        {{ $category->products_count }} Items
    </p>
</a>
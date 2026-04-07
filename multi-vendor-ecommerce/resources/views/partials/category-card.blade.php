<a href="{{ route('shop.index', ['category' => $category->slug]) }}"
   class="group flex flex-col items-center text-center bg-[#61e1cf]/[0.18] rounded-2xl p-3 shadow-sm 
          hover:shadow-md hover:-translate-y-1 transition-all w-full h-full min-h-[140px] justify-between">

    <div class="flex flex-col items-center w-full">
        <div class="h-20 w-20 flex items-center justify-center overflow-hidden rounded-xl bg-white/50 mb-2">
            <img src="@storageUrl($category->image)"
                 alt="{{ $category->name }}"
                 class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-110">
        </div>

        <p class="font-extrabold text-gray-900 text-[11px] md:text-xs leading-tight line-clamp-2 min-h-[2.5rem] flex items-center justify-center px-1">
            {{ $category->name }}
        </p>
    </div>

    <p class="text-gray-500 text-[9px] md:text-[10px] font-bold mt-1 uppercase tracking-tighter">
        {{ $category->products_count }} Items
    </p>
</a>
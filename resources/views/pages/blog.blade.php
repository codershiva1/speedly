<x-layouts.site :title="__('Blog')">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-6 text-sm">
        <h1 class="text-2xl font-semibold text-gray-900">Latest News</h1>
        <!-- <p class="text-gray-700">This is a simple static blog listing. Replace with your CMS or database-driven posts as needed.</p> -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach($latestNews as $article)
                        <article class="bg-white border border-gray-100 overflow-hidden flex flex-col text-xs" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                            <div class="h-48 bg-gray-100 overflow-hidden news-img">
                                <img src="{{ $article['image'] }}" alt="{{ $article['title'] }}" class="w-full h-full object-cover">
                            </div>
                            <div class="p-3 flex-1 flex flex-col">
                                <p class="text-[11px] text-gray-400 mb-1">{{ $article['date']->format('d M Y') }}</p>
                                <h3 class="font-semibold text-gray-900 mb-1 line-clamp-2">{{ $article['title'] }}</h3>
                                <p class="text-gray-600 line-clamp-3 flex-1">{{ $article['excerpt'] }}</p>
                            </div>
                        </article>
                    @endforeach
            <!-- @foreach ([
                ['title' => 'The ultimate guide to finding the right gadget', 'date' => '3 days ago'],
                ['title' => 'Must-have items for your home office', 'date' => '1 week ago'],
                ['title' => 'How to compare vendors and ratings', 'date' => '2 weeks ago'],
            ] as $post)
                <article class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden flex flex-col">
                    <div class="h-28 bg-gray-100"></div>
                    <div class="p-3 flex-1 flex flex-col">
                        <p class="text-[11px] text-gray-400 mb-1">{{ $post['date'] }}</p>
                        <h2 class="font-semibold text-gray-900 mb-1 line-clamp-2">{{ $post['title'] }}</h2>
                        <p class="text-gray-600 line-clamp-3">Short demo teaser content goes here. Connect this to your real blog to show full articles.</p>
                    </div>
                </article>
            @endforeach -->
        </div>
    </div>
</x-layouts.site>

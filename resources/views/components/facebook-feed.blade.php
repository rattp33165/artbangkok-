@php
    use App\Models\FacebookPost;
    $posts = FacebookPost::visible()
        ->orderByRaw('CASE WHEN sort_order > 0 THEN sort_order ELSE 9999 END')
        ->orderByDesc('posted_at')
        ->limit($limit ?? 6)
        ->get();
@endphp

@if($posts->isNotEmpty())
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">

        <div class="flex items-end justify-between mb-12">
            <div>
                <h2 class="text-3xl md:text-4xl font-bold text-black font-['agenda-one']">FACEBOOK UPDATES</h2>
                <p class="text-xs tracking-[0.3em] uppercase text-gray-400 mt-2">Latest Updates from Facebook</p>
            </div>
            @auth
            @if(Auth::user()->isAdmin())
            <livewire:facebook-feed-manager />
            @endif
            @endauth
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($posts as $post)
            <a href="{{ $post->permalink_url }}" target="_blank" rel="noopener noreferrer"
               class="group bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300 flex flex-col">

                {{-- Image --}}
                @if($post->full_picture)
                <div class="aspect-video overflow-hidden bg-gray-100">
                    <img src="{{ $post->full_picture }}" alt=""
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                @else
                <div class="aspect-video bg-black flex items-center justify-center">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="#3b5998">
                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                    </svg>
                </div>
                @endif

                {{-- Content --}}
                <div class="p-5 flex flex-col flex-1">
                    @if($post->message)
                    <p class="text-sm text-gray-600 leading-relaxed flex-1">{{ $post->excerpt }}</p>
                    @else
                    <p class="text-sm text-gray-400 italic flex-1">View post on Facebook</p>
                    @endif

                    <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-100">
                        <span class="text-xs text-gray-400">{{ $post->posted_at->diffForHumans() }}</span>
                        <span class="text-xs text-blue-600 font-medium group-hover:underline">View on Facebookเด →</span>
                    </div>
                </div>

            </a>
            @endforeach
        </div>

        @if(config('services.facebook.page_url'))
        <div class="text-center mt-10">
            <a href="{{ config('services.facebook.page_url') }}" target="_blank" rel="noopener noreferrer"
               class="inline-flex items-center gap-2 border border-gray-300 hover:border-black text-sm text-gray-600 hover:text-black px-6 py-3 rounded-xl transition">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                </svg>
                View all on Facebook
            </a>
        </div>
        @endif

    </div>
</section>
@endif

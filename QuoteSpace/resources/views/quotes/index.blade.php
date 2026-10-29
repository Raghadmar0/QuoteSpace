@extends('layouts.app')

@section('title', 'Explore Published Quotes')

@section('content')
<div class="space-y-8">

    <!-- Hero Header -->
    <div class="text-center max-w-2xl mx-auto pt-4 pb-2">
        <h1 class="font-serif text-4xl font-bold text-stone-900 tracking-tight sm:text-5xl mb-3">
            Words that stay with you.
        </h1>
        <p class="text-stone-600 text-sm sm:text-base">
            Discover and share timeless thoughts, literary excerpts, and personal inspirations curated by readers around the globe.
        </p>
    </div>

    <!-- Search Form Bar -->
    <div class="max-w-xl mx-auto">
        <form method="GET" action="{{ route('quotes.index') }}" class="relative flex items-center">
            <input 
                type="text" 
                name="search" 
                value="{{ request('search') }}"
                placeholder="Search quotes by text or author name..." 
                class="w-full pl-11 pr-24 py-3 text-sm bg-white border border-stone-300 rounded-full shadow-sm focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 transition"
            >
            <div class="absolute left-4 text-stone-400 pointer-events-none">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>
            
            <button type="submit" class="absolute right-1.5 px-4 py-1.5 bg-emerald-700 text-white text-xs font-semibold rounded-full hover:bg-emerald-800 transition">
                Search
            </button>

            @if(request('search'))
                <a href="{{ route('quotes.index') }}" class="ml-2 text-xs text-stone-500 hover:text-stone-800 underline">Clear</a>
            @endif
        </form>
        <p class="mt-1.5 text-center text-[11px] text-stone-400">Search by quote content or author display name.</p>
    </div>

    <!-- Search Status Indicator -->
    @if ($search)
        <div class="flex items-center justify-between text-xs text-stone-500 border-b border-stone-200 pb-2">
            <span>Showing results matching: <strong class="text-stone-800">&ldquo;{{ $search }}&rdquo;</strong></span>
            <span>{{ $quotes->total() }} quotes found</span>
        </div>
    @endif

    <!-- Quote Grid Stream -->
    @if ($quotes->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($quotes as $quote)
                <x-quote-card :quote="$quote" />
            @endforeach
        </div>

        <!-- Pagination Controls -->
        <div class="pt-6">
            {{ $quotes->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="bg-white rounded-2xl p-12 text-center border border-dashed border-stone-300 max-w-md mx-auto my-8">
            <div class="w-12 h-12 bg-stone-100 text-stone-400 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
            </div>
            <h3 class="font-serif text-lg font-semibold text-stone-800 mb-1">No quotes found</h3>
            <p class="text-xs text-stone-500 mb-6">
                @if ($search)
                    No quotes matched your query. Try searching with different keywords.
                @else
                    No quotes have been published yet. Be the first to share one!
                @endif
            </p>
            @auth
                <a href="{{ route('quotes.create') }}" class="inline-flex items-center gap-1.5 px-4 py-2 text-xs font-semibold bg-emerald-700 text-white rounded-lg hover:bg-emerald-800 transition">
                    Publish First Quote
                </a>
            @else
                <a href="{{ route('register') }}" class="inline-flex items-center gap-1.5 px-4 py-2 text-xs font-semibold bg-stone-900 text-amber-50 rounded-lg hover:bg-stone-800 transition">
                    Register to Publish
                </a>
            @endauth
        </div>
    @endif

</div>
@endsection

@extends('layouts.app')

@section('title', 'My Quotes Dashboard')

@section('content')
<div class="space-y-6">

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 border-b border-stone-200 pb-4">
        <div>
            <h1 class="font-serif text-2xl font-bold text-stone-900">My Author Dashboard</h1>
            <p class="text-xs text-stone-500 mt-1">Manage, edit, or delete all quotes published under your account.</p>
        </div>
        <a href="{{ route('quotes.create') }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-emerald-700 text-white text-xs font-semibold rounded-lg hover:bg-emerald-800 transition shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Publish New Quote
        </a>
    </div>

    <!-- Quote Stream Grid -->
    @if ($quotes->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($quotes as $quote)
                <x-quote-card :quote="$quote" :showOwnerActions="true" />
            @endforeach
        </div>

        <div class="pt-4">
            {{ $quotes->links() }}
        </div>
    @else
        <div class="bg-white rounded-2xl p-12 text-center border border-dashed border-stone-300 max-w-md mx-auto my-8">
            <h3 class="font-serif text-lg font-semibold text-stone-800 mb-1">You haven't created any quotes yet</h3>
            <p class="text-xs text-stone-500 mb-6">Write a quote between 3 and 155 characters to share your thoughts.</p>
            <a href="{{ route('quotes.create') }}" class="inline-flex items-center gap-1.5 px-4 py-2 text-xs font-semibold bg-emerald-700 text-white rounded-lg hover:bg-emerald-800 transition">
                Publish Your First Quote
            </a>
        </div>
    @endif

</div>
@endsection

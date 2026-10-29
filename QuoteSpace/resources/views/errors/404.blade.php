@extends('layouts.app')

@section('title', '404 Page Not Found')

@section('content')
<div class="max-w-md mx-auto my-12 text-center">
    <div class="bg-white p-8 rounded-2xl border border-stone-200 shadow-sm">
        <h1 class="font-serif text-3xl font-bold text-stone-900 mb-2">404 — Page Not Found</h1>
        <p class="text-xs text-stone-600 mb-6">
            The quote or page you are looking for does not exist or has been removed.
        </p>
        <a href="{{ route('quotes.index') }}" class="inline-flex items-center px-4 py-2 text-xs font-semibold bg-emerald-700 text-white rounded-lg hover:bg-emerald-800 transition">
            Return to Explore Quotes
        </a>
    </div>
</div>
@endsection

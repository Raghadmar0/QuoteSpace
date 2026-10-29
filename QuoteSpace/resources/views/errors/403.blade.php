@extends('layouts.app')

@section('title', '403 Unauthorized Access')

@section('content')
<div class="max-w-md mx-auto my-12 text-center">
    <div class="bg-white p-8 rounded-2xl border border-stone-200 shadow-sm">
        <div class="w-16 h-16 bg-rose-50 text-rose-600 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
        </div>
        <h1 class="font-serif text-2xl font-bold text-stone-900 mb-2">403 — Unauthorized</h1>
        <p class="text-xs text-stone-600 mb-6">
            You do not have permission to modify or access this quote. Only the original author may edit or delete their own quotes.
        </p>
        <a href="{{ route('quotes.index') }}" class="inline-flex items-center px-4 py-2 text-xs font-semibold bg-stone-900 text-amber-50 rounded-lg hover:bg-stone-800 transition">
            Return to Explore Quotes
        </a>
    </div>
</div>
@endsection

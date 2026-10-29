@extends('layouts.app')

@section('title', 'Publish New Quote')

@section('content')
<div class="max-w-lg mx-auto my-6">
    <div class="bg-white p-8 rounded-2xl border border-stone-200 shadow-sm">
        
        <div class="flex items-center justify-between mb-6">
            <h1 class="font-serif text-2xl font-bold text-stone-900">Publish a Quote</h1>
            <a href="{{ route('quotes.index') }}" class="text-xs text-stone-500 hover:text-stone-800">Cancel</a>
        </div>

        <form method="POST" action="{{ route('quotes.store') }}">
            @csrf

            <div class="mb-5">
                <label for="content" class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1.5">
                    Quote Content
                </label>
                <textarea 
                    name="content" 
                    id="content" 
                    rows="4" 
                    maxlength="155"
                    required
                    oninput="document.getElementById('char-count').innerText = this.value.length;"
                    placeholder="Enter inspiring thoughts or literary lines..."
                    class="w-full px-3.5 py-2.5 text-sm bg-stone-50 border border-stone-300 rounded-lg focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 focus:bg-white transition"
                >{{ old('content') }}</textarea>
                
                <div class="flex justify-between items-center mt-1">
                    <p class="text-xs text-stone-500">Write a quote between 3 and 155 characters.</p>
                    <span class="text-xs font-mono text-stone-400"><span id="char-count">{{ strlen(old('content', '')) }}</span>/155</span>
                </div>
                
                <x-validation-error field="content" />
            </div>

            <div class="flex items-center justify-end gap-3 pt-2">
                <a href="{{ route('quotes.my-quotes') }}" class="px-4 py-2 text-xs font-medium text-stone-600 hover:text-stone-900">
                    Cancel
                </a>
                <button type="submit" class="px-5 py-2 bg-emerald-700 hover:bg-emerald-800 text-white font-semibold text-xs rounded-lg transition shadow-sm">
                    Publish Quote
                </button>
            </div>
        </form>

    </div>
</div>
@endsection

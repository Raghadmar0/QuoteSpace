@extends('layouts.app')

@section('title', 'Join QuoteSpace')

@section('content')
<div class="max-w-md mx-auto my-8">
    <div class="bg-white p-8 rounded-2xl border border-stone-200 shadow-sm">
        <div class="text-center mb-6">
            <h1 class="font-serif text-2xl font-bold text-stone-900">Create your account</h1>
            <p class="text-xs text-stone-500 mt-1">Join our community to publish and curate quotes.</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <x-input 
                name="name" 
                label="Full Display Name" 
                hint="Enter a display name between 2 and 50 characters." 
                required 
            />

            <x-input 
                name="email" 
                label="Email Address" 
                type="email" 
                hint="Use a valid email address for authentication." 
                required 
            />

            <x-input 
                name="password" 
                label="Password" 
                type="password" 
                hint="Use at least 8 characters." 
                required 
            />

            <x-input 
                name="password_confirmation" 
                label="Confirm Password" 
                type="password" 
                hint="Must match your password exactly." 
                required 
            />

            <button type="submit" class="w-full py-2.5 px-4 bg-emerald-700 hover:bg-emerald-800 text-white font-semibold text-sm rounded-lg transition shadow-sm">
                Complete Registration
            </button>
        </form>

        <p class="mt-6 text-center text-xs text-stone-500">
            Already have an account? 
            <a href="{{ route('login') }}" class="font-semibold text-emerald-700 hover:underline">Sign in here</a>
        </p>
    </div>
</div>
@endsection

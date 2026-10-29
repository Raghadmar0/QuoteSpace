@extends('layouts.app')

@section('title', 'Sign In')

@section('content')
<div class="max-w-md mx-auto my-12">
    <div class="bg-white p-8 rounded-2xl border border-stone-200 shadow-sm">
        <div class="text-center mb-6">
            <h1 class="font-serif text-2xl font-bold text-stone-900">Welcome Back</h1>
            <p class="text-xs text-stone-500 mt-1">Sign in to publish or manage your quotes.</p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <x-input 
                name="email" 
                label="Email Address" 
                type="email" 
                hint="Use a valid email address." 
                required 
            />

            <x-input 
                name="password" 
                label="Password" 
                type="password" 
                hint="Use at least 8 characters." 
                required 
            />

            <div class="flex items-center justify-between mb-6">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="remember" class="rounded border-stone-300 text-emerald-600 focus:ring-emerald-500">
                    <span class="text-xs text-stone-600">Remember me</span>
                </label>
            </div>

            <button type="submit" class="w-full py-2.5 px-4 bg-stone-900 hover:bg-stone-800 text-amber-50 font-semibold text-sm rounded-lg transition shadow-sm">
                Sign In to Account
            </button>
        </form>

        <p class="mt-6 text-center text-xs text-stone-500">
            Don't have an account yet? 
            <a href="{{ route('register') }}" class="font-semibold text-emerald-700 hover:underline">Register now</a>
        </p>
    </div>
</div>
@endsection

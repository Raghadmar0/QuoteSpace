<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-stone-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Inspiring Literary Quotes') - {{ config('app.name', 'QuoteSpace') }}</title>

    <!-- Google Fonts: Playfair Display & Inter for literary elegance -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">

    <!-- Tailwind CSS via CDN for portable high-performance styling -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        serif: ['Playfair Display', 'serif'],
                    },
                    colors: {
                        sage: {
                            50: '#f4f7f4',
                            100: '#e3ebe3',
                            500: '#5a7a5a',
                            600: '#466246',
                            700: '#384f38',
                            800: '#2d3e2d',
                        },
                        charcoal: '#1a1a1a',
                        offwhite: '#fcfbf9',
                    }
                }
            }
        }
    </script>
    <style>
        body { background-color: #fcfbf9; color: #1a1a1a; }
    </style>
</head>
<body class="flex flex-col min-h-screen font-sans antialiased text-stone-800">

    <!-- Navigation Header -->
    <header class="sticky top-0 z-30 bg-white/90 backdrop-blur-md border-b border-stone-200">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                
                <!-- Brand Logo -->
                <a href="{{ route('quotes.index') }}" class="flex items-center gap-2 group">
                    <span class="p-2 bg-stone-900 text-amber-50 rounded-lg group-hover:bg-emerald-800 transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
                    </span>
                    <span class="font-serif text-2xl font-bold text-stone-900 tracking-tight">
                        {{ config('app.name', 'QuoteSpace') }}
                    </span>
                </a>

                <!-- Navigation Links -->
                <nav class="hidden md:flex items-center gap-6 text-sm font-medium">
                    <a href="{{ route('quotes.index') }}" class="transition {{ request()->routeIs('quotes.index') ? 'text-emerald-700 font-semibold' : 'text-stone-600 hover:text-stone-900' }}">
                        Explore Quotes
                    </a>

                    @auth
                        <a href="{{ route('quotes.my-quotes') }}" class="transition {{ request()->routeIs('quotes.my-quotes') ? 'text-emerald-700 font-semibold' : 'text-stone-600 hover:text-stone-900' }}">
                            My Quotes
                        </a>
                    @endauth
                </nav>

                <!-- Auth Action Buttons -->
                <div class="flex items-center gap-3">
                    @auth
                        <a href="{{ route('quotes.create') }}" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full text-xs font-semibold bg-emerald-700 text-white hover:bg-emerald-800 transition shadow-sm">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            New Quote
                        </a>

                        <div class="h-4 w-px bg-stone-300"></div>

                        <span class="text-xs text-stone-500 hidden sm:inline">Hi, <strong class="text-stone-800">{{ auth()->user()->name }}</strong></span>

                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-xs font-medium text-stone-500 hover:text-rose-600 transition">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-stone-600 hover:text-stone-900 transition">
                            Sign In
                        </a>
                        <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-semibold bg-stone-900 text-amber-50 hover:bg-stone-800 transition shadow-sm">
                            Register
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- Global Flash Notification Banner -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
        <x-flash-messages />
    </div>

    <!-- Main Content Body -->
    <main class="flex-grow max-w-6xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-stone-200 mt-auto py-8 text-center text-xs text-stone-500">
        <div class="max-w-6xl mx-auto px-4 flex flex-col sm:flex-row justify-between items-center gap-4">
            <p>&copy; {{ date('Y') }} <strong>{{ config('app.name', 'QuoteSpace') }}</strong>. Created for literary quote enthusiasts.</p>
            <div class="flex gap-4">
                <a href="{{ route('quotes.index') }}" class="hover:underline">Browse</a>
                @guest
                    <a href="{{ route('register') }}" class="hover:underline">Join Platform</a>
                @endguest
            </div>
        </div>
    </footer>

</body>
</html>

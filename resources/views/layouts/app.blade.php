<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="bg-slate-100">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Essen') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen text-slate-800">
        <div class="bg-white shadow-sm">
            <div class="mx-auto flex max-w-6xl items-center justify-between px-6 py-4">
                <a href="{{ route('food.index') }}" class="text-2xl font-semibold text-emerald-600">Essen</a>
                <nav class="flex items-center gap-4 text-sm font-medium">
                    <a href="{{ route('food.index') }}" class="text-slate-600 hover:text-slate-900">Menu</a>
                    @auth
                        <a href="{{ route('cart.index') }}" class="text-slate-600 hover:text-slate-900">Cart</a>
                        <a href="{{ route('orders.index') }}" class="text-slate-600 hover:text-slate-900">Orders</a>
                        <span class="text-slate-500">Hi, {{ auth()->user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="rounded-md bg-emerald-500 px-3 py-1.5 text-white shadow hover:bg-emerald-600">Log out</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="rounded-md border border-emerald-500 px-3 py-1.5 text-emerald-600 hover:bg-emerald-50">Log in</a>
                        <a href="{{ route('register') }}" class="rounded-md bg-emerald-500 px-3 py-1.5 text-white shadow hover:bg-emerald-600">Sign up</a>
                    @endauth
                </nav>
            </div>
        </div>

        <main class="mx-auto max-w-6xl px-6 py-10">
            @if (session('status'))
                <div class="mb-6 rounded-md border border-emerald-200 bg-emerald-50 p-4 text-emerald-700">
                    {{ session('status') }}
                </div>
            @endif
            @yield('content')
        </main>
    </body>
</html>

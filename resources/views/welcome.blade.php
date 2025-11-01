@extends('layouts.app')

@section('content')
<section class="grid gap-8 rounded-3xl border border-slate-200 bg-white p-12 text-center shadow-sm">
    <h1 class="text-4xl font-bold text-slate-900">Delicious delivery, right on time.</h1>
    <p class="mx-auto max-w-2xl text-lg text-slate-600">Essen connects you with independent kitchens and curated meals. Sign in to assemble your cart, track your favourites, and checkout in minutes.</p>
    <div class="flex flex-wrap justify-center gap-4">
        @auth
            <a href="{{ route('food.index') }}" class="rounded-md bg-emerald-500 px-5 py-3 text-sm font-semibold uppercase tracking-wide text-white shadow hover:bg-emerald-600">Browse menu</a>
            <a href="{{ route('cart.index') }}" class="rounded-md border border-emerald-500 px-5 py-3 text-sm font-semibold uppercase tracking-wide text-emerald-600 hover:bg-emerald-50">View cart</a>
        @else
            <a href="{{ route('register') }}" class="rounded-md bg-emerald-500 px-5 py-3 text-sm font-semibold uppercase tracking-wide text-white shadow hover:bg-emerald-600">Create account</a>
            <a href="{{ route('login') }}" class="rounded-md border border-emerald-500 px-5 py-3 text-sm font-semibold uppercase tracking-wide text-emerald-600 hover:bg-emerald-50">Log in</a>
        @endauth
    </div>
</section>
@endsection

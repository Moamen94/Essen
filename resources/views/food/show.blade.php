@extends('layouts.app')

@section('content')
<article class="grid gap-6 rounded-2xl border border-slate-200 bg-white p-10 shadow-sm">
    <div>
        <a href="{{ route('food.index') }}" class="text-sm text-emerald-600 hover:underline">← Back to menu</a>
    </div>
    <header class="flex flex-col gap-3">
        <h1 class="text-4xl font-bold text-slate-900">{{ $foodItem->name }}</h1>
        <p class="text-slate-600">{{ $foodItem->description }}</p>
        <p class="text-lg font-semibold text-slate-900">${{ number_format($foodItem->price, 2) }} · ⭐ {{ $foodItem->rating }}/5</p>
    </header>
    @auth
        <form method="POST" action="{{ route('cart.store') }}" class="flex flex-wrap items-center gap-3">
            @csrf
            <input type="hidden" name="food_item_id" value="{{ $foodItem->id }}">
            <label class="flex items-center gap-2 text-sm text-slate-500">
                Quantity
                <input type="number" name="quantity" value="1" min="1" class="w-20 rounded-md border border-slate-300 px-2 py-1">
            </label>
            <button type="submit" class="rounded-md bg-emerald-500 px-4 py-2 font-semibold text-white shadow hover:bg-emerald-600">Add to cart</button>
        </form>
    @else
        <a href="{{ route('login') }}" class="rounded-md bg-emerald-500 px-4 py-2 font-semibold text-white shadow hover:bg-emerald-600">Log in to order</a>
    @endauth
</article>
@endsection

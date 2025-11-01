@extends('layouts.app')

@section('content')
<div class="grid gap-8 lg:grid-cols-[2fr_1fr]">
    <section class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
        <header class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-slate-900">Your cart</h1>
                <p class="text-sm text-slate-500">Review your selections before checking out.</p>
            </div>
            <span class="rounded-full bg-emerald-50 px-3 py-1 text-sm font-semibold text-emerald-600">{{ $items->count() }} items</span>
        </header>
        <div class="flex flex-col gap-4">
            @forelse ($items as $item)
                <div class="flex flex-wrap items-center justify-between gap-4 rounded-xl border border-slate-100 bg-slate-50 px-4 py-3">
                    <div>
                        <h2 class="font-semibold text-slate-900">{{ $item->foodItem->name }}</h2>
                        <p class="text-sm text-slate-500">${{ number_format($item->foodItem->price, 2) }} each</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <form method="POST" action="{{ route('cart.update', $item) }}" class="flex items-center gap-2">
                            @csrf
                            @method('PUT')
                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="w-16 rounded-md border border-slate-300 px-2 py-1 text-sm">
                            <button type="submit" class="text-sm text-emerald-600 hover:text-emerald-700">Update</button>
                        </form>
                        <form method="POST" action="{{ route('cart.destroy', $item) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-sm text-rose-500 hover:text-rose-600">Remove</button>
                        </form>
                        <p class="text-sm font-semibold text-slate-900">${{ number_format($item->subtotal(), 2) }}</p>
                    </div>
                </div>
            @empty
                <p class="rounded-xl border border-dashed border-slate-300 bg-slate-50 p-6 text-center text-slate-500">Your cart is empty. Explore the menu to add dishes.</p>
            @endforelse
        </div>
    </section>

    <aside class="space-y-6">
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="text-xl font-semibold text-slate-900">Order summary</h2>
            <dl class="mt-4 space-y-3 text-sm text-slate-600">
                <div class="flex justify-between">
                    <dt>Subtotal</dt>
                    <dd>${{ number_format($total, 2) }}</dd>
                </div>
                <div class="flex justify-between text-slate-400">
                    <dt>Delivery</dt>
                    <dd>Included</dd>
                </div>
                <div class="flex justify-between text-lg font-semibold text-slate-900">
                    <dt>Total</dt>
                    <dd>${{ number_format($total, 2) }}</dd>
                </div>
            </dl>
            <form method="POST" action="{{ route('orders.store') }}" class="mt-6">
                @csrf
                <button type="submit" class="w-full rounded-md bg-emerald-500 px-4 py-2 text-center text-sm font-semibold text-white shadow hover:bg-emerald-600" {{ $items->isEmpty() ? 'disabled' : '' }}>Checkout</button>
            </form>
        </div>
        <div class="rounded-2xl border border-dashed border-slate-300 bg-white/70 p-4 text-xs text-slate-500">
           يمكنك اختيار طريقة الدفع المفضلة لديك؛ حيث يمكنك الدفع باستخدام البطاقة الائتمانية عبر الإنترنت، أو اختيار الدفع عند التوصيل لضمان راحة أكبر
        </div>
    </aside>
</div>
@endsection

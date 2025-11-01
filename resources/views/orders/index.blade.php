@extends('layouts.app')

@section('content')
<section class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
    <header class="mb-6">
        <h1 class="text-2xl font-semibold text-slate-900">Previous orders</h1>
        <p class="text-sm text-slate-500">Track what you've purchased so far.</p>
    </header>
    <div class="space-y-4">
        @forelse ($orders as $order)
            <article class="rounded-xl border border-slate-100 bg-slate-50 p-6">
                <header class="flex flex-wrap items-center justify-between gap-3 text-sm text-slate-600">
                    <span class="font-semibold text-slate-900">Order #{{ $order->id }}</span>
                    <span>{{ $order->created_at->format('M d, Y h:i A') }}</span>
                    <span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold uppercase tracking-wide text-emerald-700">{{ $order->status }}</span>
                </header>
                <ul class="mt-4 space-y-2 text-sm text-slate-600">
                    @foreach ($order->items as $item)
                        <li class="flex justify-between">
                            <span>{{ $item->quantity }} × {{ $item->foodItem->name }}</span>
                            <span>${{ number_format($item->subtotal, 2) }}</span>
                        </li>
                    @endforeach
                </ul>
                <footer class="mt-4 flex justify-between text-sm font-semibold text-slate-900">
                    <span>Total</span>
                    <span>${{ number_format($order->total_price, 2) }}</span>
                </footer>
            </article>
        @empty
            <p class="rounded-xl border border-dashed border-slate-300 bg-slate-50 p-6 text-center text-slate-500">You haven't placed any orders yet. Add something tasty to your cart to get started.</p>
        @endforelse
    </div>
</section>
@endsection

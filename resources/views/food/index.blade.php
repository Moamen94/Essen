@extends('layouts.app')

@section('content')
<div class="flex flex-col gap-12">
    <section class="flex flex-col gap-4">
        <h1 class="text-3xl font-bold text-slate-900">Explore our seasonal menu</h1>
        <p class="text-slate-600">تصفح قائمة مختارة من الأطباق الشهية التي أعدها طهاة محترفون. اختر أطباقك المفضلة، أضفها إلى العربة، ودعنا نهتم بكل شيء من أجلك</p>
    </section>

    <section class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        @forelse ($foodItems as $item)
            <div class="flex h-full flex-col justify-between rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex flex-col gap-3">
                    <h2 class="text-xl font-semibold text-slate-900">{{ $item->name }}</h2>
                    <p class="text-sm text-slate-600">{{ $item->description }}</p>
                </div>
                <div class="mt-6 flex items-center justify-between">
                    <div>
                        <p class="text-lg font-semibold text-slate-900">${{ number_format($item->price, 2) }}</p>
                        <p class="text-sm text-amber-500">⭐ {{ $item->rating }}/5</p>
                    </div>
                    @auth
                        <form method="POST" action="{{ route('cart.store') }}" class="flex items-center gap-2">
                            @csrf
                            <input type="hidden" name="food_item_id" value="{{ $item->id }}">
                            <input type="number" name="quantity" value="1" min="1" class="w-16 rounded-md border border-slate-300 px-2 py-1 text-sm">
                            <button type="submit" class="rounded-md bg-emerald-500 px-3 py-2 text-sm font-semibold text-white shadow hover:bg-emerald-600">Add to cart</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="rounded-md bg-emerald-500 px-3 py-2 text-sm font-semibold text-white shadow hover:bg-emerald-600">Log in to order</a>
                    @endauth
                </div>
            </div>
        @empty
            <p class="text-slate-600">No food items available yet. Check back soon!</p>
        @endforelse
    </section>

    @auth
        <div class="rounded-2xl border border-dashed border-slate-300 bg-white/70 p-6 text-sm text-slate-500">
          نحن نقدم لك أفضل الأطباق، مصنوعة من المكونات الطازجة فقط. ابدأ تجربتك معنا اليوم
        </div>
    @endauth
</div>
@endsection

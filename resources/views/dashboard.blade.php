@extends('layouts.app')

@section('content')
<div class="grid gap-6 rounded-2xl border border-slate-200 bg-white p-10 shadow-sm">
    <h1 class="text-3xl font-bold text-slate-900">Welcome back, {{ auth()->user()->name }}!</h1>
    <p class="text-slate-600">Jump straight into your next meal. Browse the <a class="text-emerald-600 hover:text-emerald-700" href="{{ route('food.index') }}">menu</a>, review your <a class="text-emerald-600 hover:text-emerald-700" href="{{ route('cart.index') }}">cart</a>, or see past <a class="text-emerald-600 hover:text-emerald-700" href="{{ route('orders.index') }}">orders</a>.</p>
</div>
@endsection

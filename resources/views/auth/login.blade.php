@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-md rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
    <h1 class="mb-6 text-2xl font-semibold text-slate-900">Welcome back</h1>
    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf
        <div>
            <label for="email" class="mb-1 block text-sm font-medium text-slate-600">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-emerald-500 focus:ring-emerald-500">
            @error('email')
                <p class="mt-1 text-sm text-rose-500">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="password" class="mb-1 block text-sm font-medium text-slate-600">Password</label>
            <input id="password" name="password" type="password" required class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-emerald-500 focus:ring-emerald-500">
            @error('password')
                <p class="mt-1 text-sm text-rose-500">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex items-center justify-between text-sm text-slate-600">
            <label class="flex items-center gap-2">
                <input type="checkbox" name="remember" class="rounded border-slate-300">
                Remember me
            </label>
            <a href="{{ route('register') }}" class="text-emerald-600 hover:text-emerald-700">Need an account?</a>
        </div>
        <button type="submit" class="w-full rounded-md bg-emerald-500 px-4 py-2 text-sm font-semibold text-white shadow hover:bg-emerald-600">Log in</button>
    </form>
</div>
@endsection

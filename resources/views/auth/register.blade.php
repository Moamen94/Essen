@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-md rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
    <h1 class="mb-6 text-2xl font-semibold text-slate-900">Create an account</h1>
    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf
        <div>
            <label for="name" class="mb-1 block text-sm font-medium text-slate-600">Name</label>
            <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-emerald-500 focus:ring-emerald-500">
            @error('name')
                <p class="mt-1 text-sm text-rose-500">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="email" class="mb-1 block text-sm font-medium text-slate-600">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-emerald-500 focus:ring-emerald-500">
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
        <div>
            <label for="password_confirmation" class="mb-1 block text-sm font-medium text-slate-600">Confirm password</label>
            <input id="password_confirmation" name="password_confirmation" type="password" required class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-emerald-500 focus:ring-emerald-500">
        </div>
        <p class="text-sm text-slate-600">By creating an account you agree to our <span class="font-semibold text-slate-900">delicious</span> terms of service.</p>
        <button type="submit" class="w-full rounded-md bg-emerald-500 px-4 py-2 text-sm font-semibold text-white shadow hover:bg-emerald-600">Sign up</button>
        <p class="text-center text-sm text-slate-600">Already have an account? <a href="{{ route('login') }}" class="text-emerald-600 hover:text-emerald-700">Log in</a></p>
    </form>
</div>
@endsection

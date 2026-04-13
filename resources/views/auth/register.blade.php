@extends('layouts.app')

@section('title', 'Register — ZooQuarium')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-zoo-900 via-zoo-800 to-stone-900 flex items-center justify-center px-4 py-20">

    <div class="absolute top-20 right-10 w-72 h-72 bg-zoo-500/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-20 left-10 w-80 h-80 bg-amber-400/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="w-full max-w-md relative z-10">

        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">

            {{-- Header --}}
            <div class="bg-gradient-to-br from-zoo-700 to-zoo-900 px-8 pt-10 pb-8 text-center">
                <span class="text-4xl block mb-3">🌿</span>
                <h1 class="font-display text-2xl font-bold text-white">Create Account</h1>
                <p class="text-zoo-100/70 text-sm mt-1">Join ZooQuarium today</p>
            </div>

            {{-- Form --}}
            <div class="px-8 py-8">

                @if($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3 rounded-xl mb-6">
                        <p class="font-semibold mb-1">⚠️ Please fix the following errors:</p>
                        <ul class="list-disc list-inside space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    {{-- Name --}}
                    <div>
                        <label for="name" class="block text-sm font-semibold text-stone-700 mb-1.5">Full Name</label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            required autofocus autocomplete="name"
                            placeholder="John Doe"
                            class="w-full px-4 py-3 rounded-xl border @error('name') border-red-300 bg-red-50 @else border-stone-200 @enderror
                                   text-stone-900 placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-zoo-500 focus:border-transparent transition-all text-sm"
                        />
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm font-semibold text-stone-700 mb-1.5">Email Address</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            required autocomplete="email"
                            placeholder="you@example.com"
                            class="w-full px-4 py-3 rounded-xl border @error('email') border-red-300 bg-red-50 @else border-stone-200 @enderror
                                   text-stone-900 placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-zoo-500 focus:border-transparent transition-all text-sm"
                        />
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div x-data="{ show: false }">
                        <label for="password" class="block text-sm font-semibold text-stone-700 mb-1.5">Password</label>
                        <div class="relative">
                            <input
                                :type="show ? 'text' : 'password'"
                                id="password"
                                name="password"
                                required autocomplete="new-password"
                                placeholder="Min. 8 characters"
                                class="w-full px-4 py-3 pr-12 rounded-xl border @error('password') border-red-300 bg-red-50 @else border-stone-200 @enderror
                                       text-stone-900 placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-zoo-500 focus:border-transparent transition-all text-sm"
                            />
                            <button type="button" @click="show = !show"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-stone-400 hover:text-stone-600">
                                <span x-text="show ? '🙈' : '👁️'"></span>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Confirm Password --}}
                    <div x-data="{ show: false }">
                        <label for="password_confirmation" class="block text-sm font-semibold text-stone-700 mb-1.5">Confirm Password</label>
                        <div class="relative">
                            <input
                                :type="show ? 'text' : 'password'"
                                id="password_confirmation"
                                name="password_confirmation"
                                required autocomplete="new-password"
                                placeholder="Repeat your password"
                                class="w-full px-4 py-3 pr-12 rounded-xl border border-stone-200
                                       text-stone-900 placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-zoo-500 focus:border-transparent transition-all text-sm"
                            />
                            <button type="button" @click="show = !show"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-stone-400 hover:text-stone-600">
                                <span x-text="show ? '🙈' : '👁️'"></span>
                            </button>
                        </div>
                    </div>

                    {{-- Submit --}}
                    <button type="submit"
                            class="w-full bg-zoo-700 hover:bg-zoo-800 text-white font-semibold py-3.5 rounded-xl transition-all shadow-md shadow-zoo-900/20 hover:shadow-lg hover:-translate-y-0.5 text-sm">
                        Create Account →
                    </button>
                </form>

                <p class="text-center text-sm text-stone-500 mt-6">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-zoo-600 font-semibold hover:text-zoo-800">Sign in</a>
                </p>
            </div>
        </div>
    </div>
</div>

@endsection
<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="space-y-1.5">
            <x-input-label for="email" :value="__('Email Address')" />
            <x-text-input id="email" class="block w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="name@domain.com" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <!-- Password -->
        <div class="mt-5 space-y-1.5">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password"
                            placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between mt-5">
            <label for="remember_me" class="inline-flex items-center cursor-pointer select-none">
                <input id="remember_me" type="checkbox" class="rounded border-neutral-200 text-emerald-600 shadow-sm focus:ring-emerald-500/20 focus:ring-2 focus:ring-offset-0 focus:border-emerald-500" name="remember">
                <span class="ms-2 text-xs font-semibold text-neutral-500">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-xs font-bold text-neutral-400 hover:text-neutral-600 transition-colors duration-250" href="{{ route('password.request') }}">
                    {{ __('Forgot password?') }}
                </a>
            @endif
        </div>

        <div class="mt-8">
            <x-primary-button class="w-full">
                {{ __('Log in') }}
            </x-primary-button>
        </div>

        @if (Route::has('register'))
            <div class="mt-6 text-center">
                <span class="text-xs text-neutral-400">{{ __("Don't have an account?") }}</span>
                <a class="text-xs font-bold text-emerald-600 hover:text-emerald-700 transition-colors duration-250 ml-1" href="{{ route('register') }}">
                    {{ __('Create one now') }}
                </a>
            </div>
        @endif
    </form>
</x-guest-layout>

<x-guest-layout>
    <div class="mb-6 text-xs font-semibold text-neutral-400 leading-relaxed">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div class="space-y-1.5">
            <x-input-label for="email" :value="__('Email Address')" />
            <x-text-input id="email" class="block w-full" type="email" name="email" :value="old('email')" required autofocus placeholder="name@domain.com" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <div class="mt-8">
            <x-primary-button class="w-full">
                {{ __('Email Reset Link') }}
            </x-primary-button>
        </div>

        <div class="mt-6 text-center">
            <a class="text-xs font-bold text-emerald-600 hover:text-emerald-700 transition-colors duration-250" href="{{ route('login') }}">
                {{ __('Back to log in') }}
            </a>
        </div>
    </form>
</x-guest-layout>

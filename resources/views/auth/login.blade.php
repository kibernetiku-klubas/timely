<x-guest-layout>
    <body data-page-title="{{ __('login.tab') }}"></body>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-input-label for="name" :value="__('login.name')" />
            <x-text-input id="name" class="block mt-1 w-full lowercase" type="text" name="name" :value="old('name')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('login.passwd')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-purple-500 shadow-sm focus:ring-purple-700" name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('login.remember') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('register') }}">
                    {{ __('login.noacc') }}
                </a>

            <x-primary-button class="ml-3">
                {{ __('login.login') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

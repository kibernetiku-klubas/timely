<x-guest-layout>
    @if ( app()->getLocale()  == 'lt')
        <script src="https://www.google.com/recaptcha/api.js?hl=lt"></script>
    @else
        <script src='https://www.google.com/recaptcha/api.js'></script>
    @endif

    <body data-page-title="{{ __('register.tab') }}"></body>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('register.name')" />
            <x-text-input id="name" class="block mt-1 w-full lowercase" type="text" name="name" :value="old('name')"
                          required autofocus autocomplete="username" maxlength="30" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>


        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('register.passwd')" />

            <x-text-input id="password" class="block mt-1 w-full"
                          type="password"
                          name="password"
                          required autocomplete="new-password"/>

            <x-input-error :messages="$errors->get('password')" class="mt-2"/>
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('register.confirm')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                          type="password"
                          name="password_confirmation" required autocomplete="new-password"/>

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>
        </div>


        <div class="mt-4">
            <div class="flex items-center">
                <input type="checkbox" class="checkbox" name="terms" id="terms" required>

                <div class="ml-2">
                    {{ __('register.agree') }}
                    <a target="_blank" href="/privacy-policy" class="underline text-sm text-gray-600 hover:text-gray-900">{{ __('register.policy') }}</a>
                </div>
            </div>
        </div>

        <div class="mt-4 mb-4">
            @if(config('services.recaptcha.key'))
                <div class="g-recaptcha"
                     data-sitekey="{{config('services.recaptcha.key')}}">
                </div>
            @endif
            @error('g-recaptcha-response')
            <span class="text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
               href="{{ route('login') }}">
                {{ __('register.registered') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('register.register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

<x-app-layout>
    <div class="flex flex-col items-center">
        <div class="mt-36 mx-20">
            <div class="fill-current text-black text-6xl font-bold uppercase">{{ __('500') }}</div>
            <div class="fill-current text-black text-6xl font-bold uppercase mb-8">{{ __('error.servererror') }}</div>
        </div>
    </div>
    <div class="flex flex-col items-center">
        <h2 class="text-2xl text-black font-bold uppercase mx-20">{{ __('error.500description1') }}</h2>
        <h2 class="text-2xl text-black font-bold uppercase mx-20">{{ __('error.500description2') }}</h2>
    </div>
</x-app-layout>

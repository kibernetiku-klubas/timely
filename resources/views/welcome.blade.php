<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css" rel="stylesheet">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<body data-page-title={{ __('welcome.welcome_tab') }}></body>

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">

<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">

@vite(['resources/css/app.css', 'resources/js/app.js'])
<style>
    @media screen and (max-width: 640px) {

        /* Center the "Timely Beta" text */
        .text-black.text-2xl.text-center.font-bold.btn-ghost.rounded-xl {
            text-align: center;
        }

        /* Rearrange the buttons and language selector */
        .md\:ml-4 {
            margin-left: 0;
        }

        .flex-col.md\:flex-row > * {
            margin-top: 8px;
            margin-left: 0;
        }

        .md\:mt-0 {
            margin-top: 8px;
        }

        .relative.sm\:flex.sm\:justify {
            flex-direction: column;
            align-items: center;
            padding-bottom: 16px;
        }

        .sm\:fixed.top-0.left-0.p-6.z-10.text-2xl.text-black.font-bold.btn-ghost.rounded-xl {
            position: static;
            padding: 6px; /* Adjust padding for better visibility */
            text-align: center; /* Center the text */
            margin: 16px 0; /* Add margin for spacing */
        }

        .sm\:fixed.sm\:top-0.sm\:right-0.p-6.text-right.z-10 {
            position: static;
            margin-top: 16px;
        }

        .hero-content img {
            width: 100%;
            height: auto;
            margin: 0 auto;
        }

        .px-12 {
            padding-left: 16px;
            padding-right: 16px;
        }

        .hero-content {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        html, body {
            overflow-x: hidden;
        }

        .md\:flex-row {
            flex-direction: row;
        }

        .md\:ml-4 {
            margin-left: 0.5rem;
        }

        .mt-4.md\:mt-0 {
            margin-top: 0;
        }

        .flex-col.md\:flex-row {
            flex-direction: row;
        }

        .flex-col.md\:flex-row > * {
            margin-top: 0;
            margin-left: 0.5rem;
        }
    }
</style>
</head>

<body class="antialiased">
<div class="relative bg-white">
    <div class="flex flex-col sm:flex-row justify-between items-center px-6 pt-2">
        <a class="text-2xl text-black font-bold btn-ghost rounded-xl p-2 md:p-6" href="/">Timely <span
                class="text-sm md:inline">Beta</span></a>
        @if (Route::has('login'))
            <div class="flex flex-row sm:flex-row items-center">
                @auth
                    <a href="{{ url('/dashboard') }}"
                       class="font-medium text-black uppercase btn-ghost p-6 rounded-xl">{{ __('welcome.dash') }}</a>
                @else
                    <a href="{{ route('login') }}"
                       class="font-medium text-black uppercase btn-ghost p-4 rounded-xl">{{ __('welcome.login') }}</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                           class="font-medium text-black uppercase btn-ghost p-4 rounded-xl">{{ __('welcome.register') }}</a>
                    @endif
                @endauth
                    <x-language-selector></x-language-selector>
            </div>
        @endif
    </div>
</div>


<section class="pt-24 bg-white">
    <div class="px-12 mx-auto max-w-7xl">

        <div class="w-full mx-auto text-left md:w-11/12 xl:w-9/12 md:text-center">
            <div class="mb-16">
                <div
                    class="fill-current text-black text-4xl uppercase">{{ __('welcome.welcometo') }}</div>
                <div class="fill-current text-black text-8xl font-bold">Timely.</div>
            </div>
            <h1 class="mb-8 text-4xl font-extrabold leading-none tracking-normal text-gray-900 md:text-6xl md:tracking-tight">
                <span>{{ __('welcome.your') }}</span> <span
                    class="block w-full py-2 text-transparent bg-clip-text leading-12 bg-gradient-to-r from-purple-950 to-purple-400 lg:inline">{{ __('welcome.meetings') }}</span>
                <span>{{ __('welcome.madeeasy') }}</span>
            </h1>
            <p class="px-0 mb-8 text-lg text-gray-600 md:text-xl lg:px-24">
                {{ __('welcome.timelydesc') }}
            </p>
            <div class="mb-4 space-x-0 md:space-x-2 md:mb-8">
                <a href="{{ route('dashboard') }}"
                   class="inline-flex items-center justify-center w-full px-6 py-3 mb-2 btn btn-primary bg-purple-500 border-purple-500 sm:w-auto sm:mb-0">
                    {{ __('welcome.createfirst') }}
                    <svg class="w-4 h-4 ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                         fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                              clip-rule="evenodd"></path>
                    </svg>
                </a>
            </div>
        </div>
        <div class="w-full mx-auto mt-20 text-center md:w-10/12 shadow-xl">
            <div class="relative z-0 w-full mt-8">
                <div class="relative overflow-hidden shadow-2xl">
                    <div
                        class="flex items-center flex-none px-4 bg-black rounded-b-none h-11 rounded-xl">
                        <div class="flex space-x-1.5">
                            <div class="w-3 h-3 border-2 border-white rounded-full"></div>
                            <div class="w-3 h-3 border-2 border-white rounded-full"></div>
                            <div class="w-3 h-3 border-2 border-white rounded-full"></div>
                        </div>
                    </div>
                    <img src="{{ asset('img/votingpagetimely.png') }}" alt="voting">
                </div>
            </div>
        </div>
    </div>
</section>

<div class="hero bg-white min-h-screen">
    <div class="hero-content flex-col lg:flex-row">
        <div class="w-full mx-auto mt-20 text-center md:w-10/12">
            <div class="relative z-0 w-full mt-8" data-aos="fade-right">
                <div class="relative overflow-hidden shadow-2xl">
                    <div
                        class="flex items-center flex-none px-4 bg-black rounded-b-none h-11 rounded-xl">
                        <div class="flex space-x-1.5">
                            <div class="w-3 h-3 border-2 border-white rounded-full"></div>
                            <div class="w-3 h-3 border-2 border-white rounded-full"></div>
                            <div class="w-3 h-3 border-2 border-white rounded-full"></div>
                        </div>
                    </div>
                    <img src="{{ asset('img/meeting.png') }}" class="max-w-4xl rounded-lg shadow-2xl"
                         alt="Meeting page"/>
                </div>
            </div>
        </div>
        <div class="mt-28">
            <h1 class="text-5xl font-bold text-black"
                data-aos="fade-left">{{ __('welcome.meetingheader') }}</h1>
            <p class="py-6 text-black" data-aos="fade-up">{{ __('welcome.meetingdesc') }}</p>
        </div>
    </div>
</div>

<div class="hero min-h-screen bg-white">
    <div class="hero-content flex-col lg:flex-row-reverse">
        <img src="{{ asset('img/addtimes.png') }}" class="max-w-2xl rounded-lg shadow-2xl"
             alt="Meeting page" data-aos="fade-left"/>
        <div>
            <h1 class="text-5xl font-bold text-black"
                data-aos="fade-right">{{ __('welcome.calendarheader') }}</h1>
            <p class="py-6 text-black" data-aos="fade-up">{{ __('welcome.calendardesc') }}</p>
        </div>
    </div>
</div>

<div class="hero min-h-screen" style="background-image: url({{ asset('img/dashboard.png') }});">
    <div class="hero-overlay bg-opacity-90"></div>
    <div class="hero-content text-white">

        <div class="flex flex-col sm:justify-center items-center mt-8" data-aos="zoom-in">
            <div>
                <div
                    class="fill-current text-white text-6xl font-bold uppercase">{{ __('welcome.waste') }}</div>
                <div
                    class="fill-current text-white text-6xl font-bold uppercase mb-8">{{ __('welcome.nomoretime') }}</div>
            </div>
        </div>
        <div class="max-w-md" data-aos="fade-left">
            <p class="text-xl">{{ __('welcome.waste_upper') }}</p>
            <p class="mb-5 text-2xl font-bold">{{ __('welcome.waste_lower') }}</p>
            <div>
                <a href="{{ route('dashboard') }}">
                    <button class="btn btn-primary bg-purple-500 border-purple-500"
                            data-aos="zoom-in">{{ __('welcome.getstarted') }}</button>
                </a>
            </div>
        </div>
    </div>
</div>
<x-footer></x-footer>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
    // Initialize AOS
    AOS.init();
</script>
</body>

</html>

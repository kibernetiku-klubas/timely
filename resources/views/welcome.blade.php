<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome! • Timely</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Styling for smaller screens */
        @media screen and (max-width: 640px) {
            /* 1. Navigation links overlap on smaller screens */
            .relative.sm\:flex.sm\:justify {
                flex-direction: column;
                align-items: center;
                padding-bottom: 16px; /* Add some padding at the bottom to separate links */
            }

            /* 2. The "Timely" logo and navigation links are fixed, causing issues on smaller screens */
            .sm\:fixed.top-0.left-0.p-6.z-10.text-2xl.text-black.font-bold.btn-ghost.rounded-xl {
                position: static; /* Remove fixed positioning */
            }

            .sm\:fixed.sm\:top-0.sm\:right-0.p-6.text-right.z-10 {
                position: static; /* Remove fixed positioning */
                margin-top: 16px; /* Add some margin to separate the links */
            }

            /* 3. Make the hero images responsive and centered */
            .hero-content img {
                width: 100%;
                height: auto;
                margin: 0 auto;
            }

            /* 4. Ensure content does not exceed the viewport width */
            .px-12 {
                padding-left: 16px;
                padding-right: 16px;
            }

            /* 5. Center content in the hero section */
            .hero-content {
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }

            html, body {
                overflow-x: hidden;
            }

        }
    </style>


</head>

<body class="antialiased">
<div class="relative bg-white">
    <div class="flex justify-between items-center p-6">
        <a class="text-2xl text-black font-bold btn-ghost rounded-xl" href="/">Timely</a>
        @if (Route::has('login'))
            <div class="text-right">
                @auth
                    <a href="{{ url('/dashboard') }}" class="font-medium text-black uppercase btn-ghost p-6 rounded-xl">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="font-medium text-black uppercase btn-ghost p-6 rounded-xl">Log
                        in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                           class="font-medium text-black uppercase btn-ghost p-6 rounded-xl">Register</a>
                    @endif
                @endauth
            </div>
        @endif
    </div>
</div>

<section class="pt-24 bg-white">
    <div class="px-12 mx-auto max-w-7xl">

        <div class="w-full mx-auto text-left md:w-11/12 xl:w-9/12 md:text-center">
            <div class="mb-16">
                <div class="fill-current text-black text-4xl">WELCOME TO</div>
                <div class="fill-current text-black text-8xl font-bold">Timely.</div>
            </div>
            <h1 class="mb-8 text-4xl font-extrabold leading-none tracking-normal text-gray-900 md:text-6xl md:tracking-tight">
                <span>Scheduling your</span> <span
                    class="block w-full py-2 text-transparent bg-clip-text leading-12 bg-gradient-to-r from-purple-950 to-purple-400 lg:inline">meetings</span>
                <span>made easy.</span>
            </h1>
            <p class="px-0 mb-8 text-lg text-gray-600 md:text-xl lg:px-24">
                Having trouble finding the meeting time that suits everyone? Look no further than your free,
                open-source and privacy respecting solution - Timely
            </p>
            <div class="mb-4 space-x-0 md:space-x-2 md:mb-8">
                <a href="{{ route('dashboard') }}"
                   class="inline-flex items-center justify-center w-full px-6 py-3 mb-2 btn btn-primary bg-purple-500 border-purple-500 sm:w-auto sm:mb-0">
                    Create your first meeting
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
                    <div class="flex items-center flex-none px-4 bg-black rounded-b-none h-11 rounded-xl">
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
                    <div class="flex items-center flex-none px-4 bg-black rounded-b-none h-11 rounded-xl">
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
            <h1 class="text-5xl font-bold text-black" data-aos="fade-left">Simple Meeting Page: Info, Times, and Easy
                Voting.</h1>
            <p class="py-6 text-black" data-aos="fade-up">Simplify your meetings with our user-friendly Meeting Page!
                Find essential
                details, including purpose, location, and duration. Send the meeting link to all your partners. Discover
                available time slots and vote on your preferred time, bidding farewell to scheduling headaches!
            </p>
        </div>
    </div>
</div>

<div class="hero min-h-screen bg-white">
    <div class="hero-content flex-col lg:flex-row-reverse">
        <img src="{{ asset('img/addtimes.png') }}" class="max-w-2xl rounded-lg shadow-2xl"
             alt="Meeting page" data-aos="fade-left"/>
        <div>
            <h1 class="text-5xl font-bold text-black" data-aos="fade-right">Effortless Date and Time Selection with
                Simple Calendar.</h1>
            <p class="py-6 text-black" data-aos="fade-up">Our simple calendar feature is designed to take the hassle out
                of date and time
                selection, making scheduling a breeze. We believe that managing your time should be easy and
                stress-free, and that's why our user-friendly interface provides a seamless experience for all your
                scheduling needs.</p>
        </div>
    </div>
</div>

<div class="hero min-h-screen" style="background-image: url({{ asset('img/dashboard.png') }});">
    <div class="hero-overlay bg-opacity-90"></div>
    <div class="hero-content text-white">

        <div class="flex flex-col sm:justify-center items-center mt-8" data-aos="zoom-in">
            <div>
                <div class="fill-current text-white text-6xl font-bold">WASTE</div>
                <div class="fill-current text-white text-6xl font-bold mb-8">NO MORE TIME.</div>
            </div>
        </div>
        <div class="max-w-md" data-aos="fade-left">
            <p class="text-xl">Just like our minimalist dashboard doesn't waste your time.</p>
            <p class="mb-5 text-2xl font-bold">Make your step to effortless meeting scheduling.</p>
            <div>
                <a href="{{ route('dashboard') }}">
                    <button class="btn btn-primary bg-purple-500 border-purple-500" data-aos="zoom-in">Get Started.</button>
                </a>
            </div>
        </div>
    </div>
</div>
<footer class="footer footer-center p-4 bg-white text-black">
    <div>
        <p>Timely, a meeting scheduling and time managing web app
            Copyright (C) 2023 Kibernetiku klubas</p>
    </div>
</footer>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
    // Initialize AOS
    AOS.init();
</script>
</body>

</html>

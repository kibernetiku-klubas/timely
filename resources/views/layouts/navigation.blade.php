<link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css" rel="stylesheet">
<nav>
    <div class="navbar bg-white border-b-2 text-black flex flex-col sm:flex-row sm:justify-between w-full px-4 sm:px-0">
        <div class="flex-1 flex justify-center sm:justify-start py-3 px-4">
            <a class="btn btn-ghost normal-case text-2xl md:text-base lg:text-xl" href="{{ route('dashboard') }}">Timely
                <span class="text-sm md:text-sm lg:text-base mt-0.5">Beta</span>
            </a>
        </div>

        <div class="flex justify-end">
            <a href="/add-meeting"
               class="font-bold btn btn-ghost mx-2 flex items-center text-xl md:text-xl">
                {{ __('navigation.create') }}
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-plus"
                     viewBox="0 0 16 16">
                    <path
                        d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                </svg>
            </a>
        </div>
        <div>
            @if (Auth::check())
                <div class="dropdown dropdown-end">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <label tabindex="0" class="btn btn-ghost">

                            {{ Str::limit(Auth::user()->name, 20) }}

                        </label>

                        <ul tabindex="0"
                            class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-gray-200 rounded-box w-36 sm:w-52 text-black">
                            <li>
                                <a href="{{ route('profile.edit') }}">{{ __('navigation.profile') }}</a>
                            </li>
                            <li>
                                <button type="submit">{{ __('navigation.logout') }}</button>
                            </li>
                        </ul>
                    </form>
                </div>
            @endif
            <div class="lg:mr-6 md:mr-6">
                <x-language-selector></x-language-selector>
            </div>
        </div>
    </div>
</nav>

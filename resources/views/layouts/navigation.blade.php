<nav>
    <div class="navbar bg-white border-b-2 text-black flex flex-col sm:flex-row sm:justify-between w-full">
        <div class="flex-1 flex justify-center sm:justify-start">
            <a class="btn btn-ghost normal-case text-xl" href="{{ route('dashboard') }}">Timely <span class="text-sm mt-1.5">Beta</span></a>
        </div>
        <div class="flex justify-center sm:justify-end">
            <a href="/add-meeting" class="font-bold btn btn-ghost mx-4 sm:mx-6 text-xl flex items-center">
                CREATE A MEETING
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                </svg>
            </a>
            <div class="dropdown dropdown-end">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <label tabindex="0" class="btn btn-ghost">
                        @if (Auth::check())
                            {{ Auth::user()->name }}
                        @endif
                    </label>

                    <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-gray-200 rounded-box w-40 sm:w-52 text-black">
                        <li>
                            <a href="{{ route('profile.edit') }}">Profile</a>
                        </li>
                        <li>
                            <button type="submit">{{ __('Log Out') }}</button>
                        </li>
                    </ul>
                </form>
            </div>
        </div>
    </div>
</nav>

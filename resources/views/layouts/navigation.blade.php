<nav>
    <div class="navbar bg-white border-b-2 text-black">
        <div class="flex-1">
            <a class="btn btn-ghost normal-case text-xl" href="{{ route('dashboard') }}">Timely</a>
        </div>
        <div class="flex-none">
            <div class="dropdown dropdown-end">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <label tabindex="0" class="btn btn-ghost">
                        <div>
                            @if (Auth::check())
                            {{ Auth::user()->name }}
                        </div>
                    </label>
                    <ul tabindex="0"
                        class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-gray-200 rounded-box w-52 text-black">
                        <li>
                            <a href="{{ route('profile.edit') }}">
                                Profile
                            </a>
                        </li>
                    <li>
                    <button type="submit">
                        {{ __('Log Out') }}
                    </button>
                    </li>
                    </ul>
                    @else
                        <a href="{{ route('register') }}">Sign in</a>
                    @endif
                </form>
            </div>
        </div>
    </div>
</nav>

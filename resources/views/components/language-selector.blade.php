    <div class="dropdown">
        <label tabindex="0" class="btn bg-white border-none hover:bg-gray-200 mr-1"><span
                class="flag-icon flag-icon-{{ App::getLocale() }} mask mask-circle"></span></label>
        <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-white rounded-box">
            @foreach (Config::get('languages') as $lang => $language)
                @if ($lang != App::getLocale())
                    <li>
                        <a class="dropdown-item" href="{{ route('lang.switch', $lang) }}">
                            <span class="flag-icon flag-icon-{{ $lang }} mask mask-circle"></span>
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>

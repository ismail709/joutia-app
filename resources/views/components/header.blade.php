<header class="flex justify-between items-center p-4 border h-16">
    <div>
        <a href="{{ route("home") }}">
            <img class="h-full" src="{{ asset('img/logo.png') }}">
        </a>
    </div>
    <div>
        <form action="{{ route("ads.search") }}" method="get" class="flex gap-2 items-center">
            <x-forms.input type="text" name="q" placeholder="Search" />
            <x-forms.button type="submit" class="">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                    fill="#FFFFFF">
                    <path
                        d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z" />
                </svg>
            </x-forms.button>
        </form>
    </div>
    <div class="flex gap-2">
        @guest
            <x-forms.link class="px-3 py-1.5 rounded-md text-white hover:bg-blue-500" href="{{ route('login') }}">
                Login
            </x-forms.link>
            <x-forms.link
                class="px-3 py-1.5 rounded-md border-blue-600 border-1 bg-white text-blue-600 hover:bg-blue-600 hover:text-white"
                href="{{ route('register') }}">
                Register
            </x-forms.link>
        @endguest
        @auth
            <x-forms.link class="px-3 py-1.5 rounded-md text-white hover:bg-blue-500" href="{{ route('ads.create') }}">
                Create
            </x-forms.link>
            <x-forms.link class="px-3 py-1.5 rounded-md text-white hover:bg-blue-500" href="{{ route('profile') }}">
                My profile
            </x-forms.link>
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <x-forms.button
                    class="px-3 py-1.5 rounded-md text-blue-600! border-blue-600 border-1 bg-white hover:bg-blue-600 hover:text-white! cursor-pointer">
                    Logout
                </x-forms.button>
            </form>
        @endauth
    </div>
</header>
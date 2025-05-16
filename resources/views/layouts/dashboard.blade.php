@extends("layouts.app")

@section('content')
    <section class="max-w-4xl w-4xl mx-auto">
        <div class="grid grid-cols-[240px_1fr] p-2">
            <div class="divide-y-2 divide-gray-300">
                <div>
                    <h1 class="text-xl font-semibold p-2">My Menu</h1>
                </div>
                <ul class="flex flex-col gap-2 p-2">
                    <li class="px-4 py-2 bg-gray-200 rounded-full">
                        <a @class(["hover:underline hover:font-bold","font-bold" => request()->routeIs('profile')]) href="{{ route('profile') }}">Profile</a>
                    </li>
                    <li class="relative px-4 py-2 bg-gray-200 rounded-full">
                        <a @class(["hover:underline hover:font-bold","font-bold" => request()->routeIs('myads')]) href="{{ route('myads') }}">My ads</a>
                        @if (request()->routeIs('myads'))
                            <ul class="absolute left-0 top-full flex flex-col gap-2 ps-4 py-2 text-sm w-full">
                                <li class="px-4 py-2 bg-gray-200 rounded-full w-full">
                                    <a @class(['hover:underline hover:font-bold','font-bold' => request('status') == 'approved']) href="?status=approved">
                                        Active ads
                                    </a>
                                </li>
                                <li class="px-4 py-2 bg-gray-200 rounded-full w-full">
                                    <a @class(['hover:underline hover:font-bold','font-bold' => request('status') == 'pending']) href="?status=pending">
                                        Pending ads
                                    </a>
                                </li>
                                <li class="px-4 py-2 bg-gray-200 rounded-full w-full">
                                    <a @class(['hover:underline hover:font-bold','font-bold' => request('status') == 'refused']) href="?status=refused">
                                        Rejected ads
                                    </a>
                                </li>
                            </ul>
                        @endif
                    </li>
                </ul>
            </div>
            <div>
                @yield('profile')
            </div>
        </div>
    </section>
@endsection
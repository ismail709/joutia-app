@extends("layouts.app")

@section('content')
    <section class="max-w-4xl w-4xl mx-auto">
        <div class="grid grid-cols-[240px_1fr] p-2">
            <div class="divide-y-2 divide-gray-300">
                <div>
                    <h1 class="text-xl font-semibold p-2">User info</h1>
                </div>
                <div class="flex flex-col gap-2 p-4">
                    @if(isset($user->profile_img_path))
                        <div class="w-24 h-24 rounded-full mx-auto overflow-hidden">
                            <img class="w-full h-full object-cover object-center" src="{{ asset($user->profile_img_path) }}" />
                        </div>
                    @endif
                    <p class="capitalize text-center font-semibold">
                        {{ $user->name }}
                    </p>
                    <p class="text-center">
                        Member since {{ $user->created_at->format("d-m-Y") }}
                    </p>
                </div>
            </div>
            <div>
                <div class="flex flex-col gap-2 p-4">
                    <div class="mt-4">
                        <p class="text-2xl font-bold">List of ads</p>
                    </div>
                    <div class="grid grid-cols-1 gap-2">
                        @if ($ads->isEmpty())
                            <div class="min-h-80 flex justify-center items-center text-gray-300 text-xl font-bold">
                                This user haven't created any ads yet.
                            </div>
                        @else
                            @foreach ($ads as $ad)
                                <x-ad-card :$ad />
                            @endforeach
                        @endif
                    </div>
                    {{ $ads->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
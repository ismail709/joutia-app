@extends("layouts.dashboard")

@section('profile')
    <div class="flex flex-col gap-2 p-4">
        <div class="mt-4">
            <p class="text-2xl font-bold">List of ads</p>
        </div>
        <div class="grid grid-cols-1 gap-2">
            @if ($ads->isEmpty())
                <div class="min-h-80 flex justify-center items-center text-gray-300 text-xl font-bold">
                    No ads.
                </div>
            @else
                @foreach ($ads as $ad)
                    <x-ad-card :$ad />
                @endforeach
            @endif
        </div>
        {{ $ads->links() }}
    </div>
@endsection
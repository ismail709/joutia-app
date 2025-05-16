@extends("layouts.app")

@section('content')
    <section class="max-w-3xl min-w-3xl mx-auto flex flex-col gap-4">
        <div class="mt-4">
            <p class="text-2xl font-bold">Results for "{{ $q }}"</p>
            <p>{{ $ads->total() }} results in {{ number_format($time/1e9,2) }} seconds</p>
        </div>
        @foreach ($ads as $ad)
            <x-ad-card :$ad />
        @endforeach
        {{ $ads->links() }}
    </section>
@endsection
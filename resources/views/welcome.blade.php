@extends("layouts.app")

@section('content')
    @include('components.categories')
    <section class="max-w-3xl min-w-3xl mx-auto flex flex-col gap-4 p-4">
        <div class="mt-4">
            <p class="text-2xl font-bold">All ads</p>
            <p>{{ $ads->count() }} results</p>
        </div>
        @foreach ($ads as $ad)
            <x-ad-card :$ad />
        @endforeach
        {{ $ads->links() }}
    </section>
@endsection
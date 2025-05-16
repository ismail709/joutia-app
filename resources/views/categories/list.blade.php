@extends("layouts.app")

@section('content')
    <section class="max-w-3xl min-w-3xl mx-auto flex flex-col gap-4 p-4">
        <div class="mt-4">
            <p class="text-2xl font-bold capitalize">All categories</p>
        </div>
        <div class="grid grid-cols-3 gap-4">
            @foreach ($categories as $category)
                <div class="capitalize">
                    <h2 class="font-semibold"><a class="hover:underline"
                            href="{{ route('categories.show', $category->id) }}">{{ $category->name }}</a></h2>
                    <ul class="ps-4">
                        @foreach ($category->subCategories as $subCategory)
                            <li>
                                <a class="hover:underline" href="{{ route('categories.show', $subCategory->id) }}">
                                    {{ $subCategory->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </section>
@endsection
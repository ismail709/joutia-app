<section
    class="min-h-[calc(100vh-64px)] relative flex flex-col items-center justify-center bg-cover bg-no-repeat bg-center bg-[url('/public/img/hero.jpg')]">
    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm z-0"></div>
    <div class="z-10 text-center">
        <p class="text-5xl font-bold mb-12 text-white">What are you looking for?</p>
        <div class="grid grid-cols-5 gap-2">
            @foreach ($categories as $category)
                <div
                    class="capitalize text-white font-bold h-16 rounded-md bg-linear-to-tr from-blue-400 to-blue-600 flex items-center justify-center p-4 hover:scale-120">
                    <a href="{{ route('categories.show',$category->id) }}">
                        {{ $category->name }}
                    </a>
                </div>
            @endforeach
        </div>
        <p class="mt-4">
            <a class="text-blue-300 hover:underline hover:text-white" href="{{ route('categories.list') }}">See all categories</a>
        </p>
    </div>
</section>
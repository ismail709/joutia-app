@extends("layouts.app")

@section('content')
    <section class="max-w-3xl mx-auto flex flex-col gap-4 p-4">
        <div class="mt-4 text-sm text-blue-600">
            <a class="hover:underline" href="{{ route('home') }}">Home</a> > <a class="hover:underline"
                href="{{ route('home') }}">{{ $ad->category->parentCategory->name }}</a> > <a class="hover:underline"
                href="{{ route('home') }}">{{ $ad->category->name }}</a> > {{ $ad->title }}
        </div>
        <div class="w-full max-w-full">
            <div class="swiper select-none">
                <div class="swiper-wrapper">
                    @foreach ($ad->images as $img)
                        <div class="swiper-slide">
                            <img class="w-full h-96 object-cover rounded-md" src="{{ asset($img->img_path) }}" alt="Ad image">
                        </div>
                    @endforeach
                </div>
                <!-- Optional navigation -->
                <div class="swiper-button-next text-white!"></div>
                <div class="swiper-button-prev text-white!"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
        <div class="flex justify-between items-center border border-gray-300 text-gray-500 rounded-md p-4">
            <div class="flex gap-4 items-center">
                <div class="w-12 h-12 rounded-full overflow-hidden">
                    <img class="h-full w-full object-cover object-center" src="{{ asset($ad->user->profile_img_path) }}">
                </div>
                <p class="capitalize font-bold">
                    <a href="{{ route('user.show', $ad->user->id) }}">
                        {{ $ad->user->name }}
                    </a>
                </p>
            </div>
            <div>
                <x-forms.button class="cursor-pointer rounded-md px-3 py-1.5" id="show-phone-btn">
                    Show number
                </x-forms.button>
                <p class="hidden" id="phone-number">
                    {{ $ad->user->phone_number }}
                </p>
            </div>
        </div>
        <div>
            <p class="text-xl font-bold">
                {{ $ad->title }}
            </p>
            <p class="text-2xl text-green-600 font-bold">
                {{ number_format($ad->price) }} MAD
            </p>
            <p class="text-justify mt-8">
                {{ $ad->description }}
            </p>
        </div>
    </section>
    @include('components.suggestions')
@endsection

@pushOnce('scripts')
<script>
    new Swiper('.swiper', {
        loop: true,
        spaceBetween: 10,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });

    const showbtn = document.querySelector('#show-phone-btn');
    const phonenumber = document.querySelector('#phone-number');
    showbtn.onclick = () => {
        showbtn.classList.toggle("hidden");
        phonenumber.classList.toggle("hidden");
    }
</script>
@endpushOnce
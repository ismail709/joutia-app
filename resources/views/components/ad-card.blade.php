<div @class(["flex gap-4", "flex-col max-w-48" => isset($mode) && $mode == "portrait"])>
    <div class="w-full max-w-48">
        <div class="swiper select-none">
            <div class="swiper-wrapper">
                @foreach ($ad->images as $img)
                    <div class="swiper-slide">
                        <img loading="lazy" class="w-full h-48 object-cover rounded-md" src="{{ asset($img->img_path) }}"
                            alt="Ad image">
                        <div class="swiper-lazy-preloader"></div>
                    </div>
                @endforeach
            </div>
            <!-- Optional navigation -->
            <div class="swiper-button-next text-white!"></div>
            <div class="swiper-button-prev text-white!"></div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
    <div>
        <p class="text-xl font-bold capitalize">
            <a class="block truncate" href="{{ route('ads.show', $ad->id) }}">
                {{ $ad->title }}
            </a>
        </p>
        <p class="capitalize">
            {{ $ad->category->name }}
        </p>
        <p class="text-sm text-blue-600 capitalize">
            by <a href="{{ route('user.show', $ad->user->id) }}">{{ $ad->user->name }}</a>
        </p>
        <p class="text-xl text-green-600 my-2">
            {{ number_format($ad->price, 0) }} MAD
        </p>
        @if (request()->routeIs('myads'))
            <div class="flex gap-2">
                <x-forms.link class="rounded-md py-1.5 px-3 text-white" href="{{ route('ads.edit',$ad->id) }}">Edit</x-forms.link>
                <form action="{{ route('ads.destroy', $ad->id) }}" method="post"
                    onsubmit="return confirm('Are you sure you want to delete this ad?');">
                    @csrf
                    @method('DELETE')
                    <x-forms.button class="rounded-md bg-red-500 py-1.5 px-3" type="submit">Delete</x-forms.button>
                </form>
            </div>
        @endif
    </div>
</div>
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
</script>
@endpushOnce
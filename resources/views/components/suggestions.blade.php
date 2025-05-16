<section class="max-w-3xl mx-auto mt-8 p-4">
    <h2 class="text-xl font-bold mb-4">Suggested Ads</h2>
    <div class="suggestions-swiper select-none max-w-full overflow-hidden">
        <div class="swiper-wrapper">
            @foreach ($suggestedAds as $ad)
                <div class="swiper-slide">
                    <x-ad-card :$ad mode="portrait" />
                </div>
            @endforeach
        </div>
        <!-- Optional navigation -->
        <div class="suggestions-button-next"></div>
        <div class="suggestions-button-prev"></div>
        <div class="suggestions-pagination text-center"></div>
    </div>
</section>

@pushOnce('scripts')
<script>
    new Swiper('.suggestions-swiper', {
        loop: true,
        autoplay: {
            delay: 1500,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: '.suggestions-button-next',
            prevEl: '.suggestions-button-prev',
        },
        slidesPerView: 1,
        spaceBetween: 10,
        pagination: {
            el: ".suggestions-pagination",
            clickable: true,
        },
        breakpoints: {
            640: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 10,
            },
            1024: {
                slidesPerView: 3,
                spaceBetween: 10,
            },
        }
    });
</script>
@endpushOnce
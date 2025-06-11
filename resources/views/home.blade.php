<x-app-layout title="Home Page">
    @section('hero')
<div x-data="{
        currentSlide: 0,
        slides: [
            '{{ asset('images/hero1.jpg') }}',
            '{{ asset('images/hero2.jpg') }}',
            '{{ asset('images/hero3.jpg') }}'
        ],
        init() {
            setInterval(() => {
                this.currentSlide = (this.currentSlide + 1) % this.slides.length;
            }, 5000);
        }
    }"
    class="relative w-full h-[500px] overflow-hidden"
>
    <!-- Slides -->
    <template x-for="(slide, index) in slides" :key="index">
        <div
            x-show="currentSlide === index"
            class="absolute inset-0 bg-cover bg-center transition-all duration-700 ease-in-out"
            :style="`background-image: url(${slide})`"
        >
            <div class="flex flex-col items-center justify-center h-full bg-black/40 text-white text-center px-4">
                <h1 class="text-3xl md:text-5xl font-bold">
                    {{ __('home.hero.title') }}
                    <span class="text-green-400">Better Globe Forestry</span>
                    <span class="text-white">Blog</span>
                </h1>
                {{-- <p class="mt-4 text-lg">{{ __('home.hero.desc') }}</p> --}}
                <a href="{{ route('posts.index') }}"
                   class="mt-6 inline-block bg-green-600 hover:bg-green-700 px-6 py-2 text-lg font-semibold rounded">
                    {{ __('home.hero.cta') }}
                </a>
            </div>
        </div>
    </template>

    <!-- Dots -->
    <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 flex gap-2">
        <template x-for="(slide, index) in slides" :key="index">
            <button
                @click="currentSlide = index"
                class="w-3 h-3 rounded-full"
                :class="{
                    'bg-white': currentSlide === index,
                    'bg-white/50': currentSlide !== index
                }"
            ></button>
        </template>
    </div>
</div>
@endsection


    <div class="w-full mb-10">

        <h2 class="mt-16 mb-5 text-3xl font-bold text-green-500">{{ __('home.latest_posts') }}</h2>
        <div class="w-full mb-5">
            <div class="grid grid-cols-3 gap-10 w-full">
                @foreach ($latestPosts as $post)

                        <div class="md:col-span-1 col-span-3">                        
                             <x-posts.post-card :post="$post" class="md:col-span-1 col-span-3" />
                        </div>

                    @endforeach
            </div>
        </div>
        <a class="block mt-10 text-lg font-semibold text-center text-green-500" href="{{ route('posts.index') }}">
        <a class="block mt-10 text-lg font-semibold text-center text-green-500" href="{{ route('posts.index') }}">
            {{ __('home.more_posts') }}</a>


            <hr>



            <div class="mb-16">
            <h2 class="mt-16 mb-5 text-3xl font-bold text-green-500"> {{ __('home.featured_posts') }} </h2>
            <div class="w-full">
                <div class="grid grid-cols-3 gap-10 w-full">
                    @foreach ($featuredPosts as $post)

                        {{-- <div class="md:col-span-1 col-span-3">                         --}}
                             <x-posts.post-card :post="$post" class="md:col-span-1 col-span-3" />
                        {{-- </div> --}}

                    @endforeach
                </div>
            </div>
            <a class="block mt-10 text-lg font-semibold text-center text-green-500" href="{{ route('posts.index') }}">
            <a class="block mt-10 text-lg font-semibold text-center text-green-500" href="{{ route('posts.index') }}">
                {{ __('home.more_posts') }}</a>
        </div>
    </div>
</x-app-layout>

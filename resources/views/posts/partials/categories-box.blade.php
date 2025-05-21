<div>
    <h3 class="mb-3 text-lg font-semibold text-gray-900">{{ __('blog.recommended_topics') }}</h3>
    <div class="topics flex flex-wrap justify-start gap-2">
        @foreach ($categories as $category)
            {{-- <x-posts.category-badge :category="$category" /> --}}
            <x-badge wire:navigate href="{{ route('posts.index', ['category'=>$category->slug]) }}" textColor="{{ $category->text_color }}" bgColor="{{ $category->bgColor }}">
                {{ $category->title }}
            </x-badge>

            {{-- <a href="#" class="bg-red-600 text-white rounded-xl px-3 py-1 text-base" {{ $category->title }} --}}
        @endforeach
    </div>
</div>

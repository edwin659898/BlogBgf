<nav class="flex items-center justify-between px-6 py-3 border-b border-gray-100">
    <div id="nav-left" class="flex items-center">
        <a href="{{ route('home') }}">
            {{-- <x-application-mark /> --}}
            <img src="images/logo.png" alt="BGF" height="50" width="50">
        </a>
        <div class="ml-10 top-menu">
            <div class="flex space-x-4">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'font-bold underline' : '' }}">
                    {{ __('menu.home') }}
                </a>
                <a href="{{ route('posts.index') }}" class="{{ request()->routeIs('posts.index') ? 'font-bold underline' : '' }}">
                    {{ __('menu.blog') }}
                </a>
                <a href="https://betterglobeforestry.com" target="_blank">Our Website </a>
            </div>
        </div>
    </div>
    <div id="nav-right" class="flex items-center md:space-x-6">
        @auth
            @include('layouts.partials.header-right-auth')
        @else
            @include('layouts.partials.header-right-guest')
        @endauth
    </div>
</nav>
<header id="header" class="header {{ Route::currentRouteName() == 'home' ? 'is-home' : null }}">
    @if (Route::currentRouteName() == 'home')
        @include('website.includes.map')
        @include('website.includes.address-search')
    @endif
</header>

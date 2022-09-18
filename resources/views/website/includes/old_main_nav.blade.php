<nav class="navbar navbar-expand-sm fixed-top navbar-light bg-light">
    <div class="container-fluid">
        {{-- Navbar Toggeler --}}
        <div
            class="navbar-toggler"
            {{-- type="button" --}}
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </div>

        {{-- Navigation --}}
        <div class="collapse navbar-collapse row" id="navbarSupportedContent">
            <div class="col-lg-6">
                <a class="navbar-brand mt-2 mt-lg-0" href="{{ route('home') }}">
                    <img
                        src="{{ asset('assets/brand.png') }}"
                        height="45"
                        alt="{{ env('APP_NAME') }} Logo" />
                </a>
            </div>
            <div class="col-lg-6">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('restaurants.list') }}">{{ __('Restaurants') }}</a>
                    </li>
                    @if (session('current-restaurant') && session('current-restaurant')->is_open && count(getCart()->items))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('cart-index') }}">
                                <i class="bi bi-cart"></i>
                                {{ __('Cart') }}
                            </a>
                        </li>
                    @endif
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('backpack.account.info') }}">
                                <i class="bi bi-person"></i>
                                {{ __('My account') }}
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('backpack.auth.login') }}">
                                <i class="bi bi-box-arrow-in-right"></i>
                                {{ __('Login') }}
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </div>
</nav>

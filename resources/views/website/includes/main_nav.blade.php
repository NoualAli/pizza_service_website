<nav class="main_navbar">
    <a class="brand" href="{{ route('home') }}">
        <img
            src="{{ asset('assets/brand.png') }}"
            height="45"
            alt="{{ env('APP_NAME') }} Logo" />
    </a>
    <div class="hamburger" data-target="menu--container">
        <span class="bar"></span>
    </div>
    <div class="menu--container">
        <ul class="main_menu">
            <li>
                <a class="nav_link" href="{{ route('restaurants.list') }}">{{ __('Restaurants') }}</a>
            </li>
            @if (session('current-restaurant') && session('current-restaurant')->is_open && count(getCart()->items))
                <li>
                    <a href="{{ url('cart-index') }}" class="nav_link">
                        <i class="bi bi-cart"></i>
                        {{ __('Cart') }}
                    </a>
                </li>
            @endif

        </ul>
        <ul class="login_menu">
            @auth
                <li>
                    <a class="ps-navbar-btn account-btn" href="{{ route('backpack.account.info') }}">
                        <i class="bi bi-person"></i>
                        {{ __('My account') }}
                    </a>
                </li>
            @else
                <li>
                    <a class="ps-navbar-btn login-btn" href="{{ route('backpack.auth.login') }}">
                        <i class="bi bi-box-arrow-in-right"></i>
                        {{ __('Login') }}
                    </a>
                </li>
                <li>
                    <a class="ps-navbar-btn register-btn" href="{{ route('backpack.auth.register') }}">
                        <i class="bi bi-box-arrow-in-right"></i>
                        {{ __('Register') }}
                    </a>
                </li>
            @endauth

        </ul>
    </div>
</nav>
@once
    @push('scripts')
        <script type="text/javascript">
            const hamburgerElt = document.querySelector('.hamburger')

            function handleHamburger() {
                if (hamburgerElt) {
                    const navbarElt = document.querySelector(`.${hamburgerElt.dataset.target}`)
                    hamburgerElt.addEventListener('click', function() {
                        this.classList.toggle('is-active')
                        navbarElt.classList.toggle('is-active')
                    })
                }
            }

            window.addEventListener('DOMContentLoaded', handleHamburger)
        </script>
    @endpush
@endonce

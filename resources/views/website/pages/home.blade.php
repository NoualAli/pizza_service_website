@extends('website.layouts.default')

@section('content')
    <home-slider></home-slider>
    <div class="container-fluid">
        <restaurants-list></restaurants-list>
    </div>
    <div class="container-fluid">
        <div class="row text-center my-5">
            <h2>Easy and fast</h2>
            <div class="col-lg-4 text-center">
                <img src="{{ asset('assets/place-order.svg') }}" alt="Place order" height="171">
                <br>
                <b>Place order</b>
                <p class="text-muted">
                    search your favorite restaurant and place your portion of food whenever you want.
                </p>
            </div>
            <div class="col-lg-4 text-center">
                <img src="{{ asset('assets/prepares-order.png') }}" alt="Prepares meal" height="171">
                <br>
                <b>Prepares meal</b>
                <p class="text-muted">
                    The restaurant receives a food order request they have the option to accept or request and prepare a
                    meal.
                </p>
            </div>
            <div class="col-lg-4 text-center">
                <img src="{{ asset('assets/receive-order.svg') }}" alt="Receive order" height="171">
                <br>
                <b>Receive order</b>
                <p class="text-muted">
                    A driver can place a portion of the meal at your doorstep & you can give feedback based on services.
                </p>
            </div>
        </div>

        <div class="row text-center">
            <h2>Different order types</h2>
            <div class="col-lg-4">
                <img src="{{ asset('assets/delivery.svg') }}" alt="Delivery" height="171">
                <br>
                <b>Delivery</b>
                <p class="text-muted">
                    Get your order where ever you are
                </p>
            </div>
            <div class="col-lg-4">
                <img src="{{ asset('assets/pick-up.svg') }}" alt="Pickup" height="171">
                <br>
                <b>Pick up</b>
                <p class="text-muted">
                    Go to restaurant and pick up your order
                </p>
            </div>
            <div class="col-lg-4">
                <img src="{{ asset('assets/on-the-spot.svg') }}" alt="On the spot" height="171">
                <br>
                <b>On the spot</b>
                <p class="text-muted">
                    Go to the restaurant and consume your order on the spot
                </p>
            </div>
        </div>
        {{-- <restaurants-list></restaurants-list> --}}
    </div>
    <div class="bg-light py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 align-middle">
                    <h2>Download GoGo Food App</h2>
                    <p>
                        As a customer, you can download the gogofood customer app to get your favorite or healthy meal
                        whenever
                        and wherever you want at your location in Helsinki. You can register into apps with social media
                        account
                        or with your personal information.
                    </p>
                    <p>
                        After successfully login, you can search meals by name or customize restaurants with filters with
                        timing, rating, pricing, etc. You can see a list of food restaurants with info like name, offer
                        details,
                        rating, etc.
                    </p>
                    <p>
                        After selecting a restaurant, you can see the food list, select food with toppings, and place your
                        orders. Also, you get a discount on the total amount of cost. To pay for a portion of your food, you
                        have secure payment options and track your order with advanced GPS integration to the app.
                    </p>
                    <div class="btn-group">
                        <a href="https://play.google.com/store/apps/details?id=com.gogo.food.user&hl=fr&gl=US"
                            target="_blank">
                            <img src="{{ asset('assets/google-play-badge-black.png') }}" alt="Play store">
                        </a>
                        <a href="">
                            <img src="{{ asset('assets/app-store-badge-black.png') }}" alt="App store">
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="{{ asset('assets/Mockup.png') }}" alt="Mockup" class="w-100">
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <img src="{{ asset('assets/Mockup2.png') }}" alt="Mockup" class="w-100">
            </div>
            <div class="col-lg-6 align-middle">
                <h2>Become a Partner</h2>
                <p>
                    Download the gogofood store app and expand your restaurant business with online platforms. You can sign
                    up for the app with information like name, email, and contact details.
                </p>
                <p>
                    You can add your restaurant details like restaurant name, product details, timing, delivery radius,
                    estimated delivery time, packaging charges, food details, promo code, from the restaurant admin panel.
                </p>
                <p>
                    After the admin approves your restaurant request, you will get the food order request. You manage
                    customer requests with the accept or decline option. Also, you can promote your restaurant business
                    within the app.
                </p>
            </div>
        </div>
    </div>
@endsection

@once
    @push('scripts')
        <script src="{{ asset(mix('website/js/home.js')) }}"></script>
    @endpush
@endonce

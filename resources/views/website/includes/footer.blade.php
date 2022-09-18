<!-- Footer -->
<footer class="text-center text-lg-start bg-white text-muted mt-5 border-top">
    <!-- Section: Social media -->
    <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
        <!-- Left -->
        <div class="me-5 d-none d-lg-block">
            <span>{{ __('Get connected with us on social networks') }}:</span>
        </div>
        <!-- Left -->

        <!-- Right -->
        <div>
            <a href="#" class="me-4 link-grayish">
                <i class="bi bi-facebook"></i>
            </a>
            <a href="#" class="me-4 link-grayish">
                <i class="bi bi-instagram"></i>
            </a>
            <a href="#" class="me-4 link-grayish">
                <i class="bi bi-twitter"></i>
            </a>
        </div>
        <!-- Right -->
    </section>

    <section class="container-fluid text-center text-md-start mt-5">
        <!-- Grid row -->
        <div class="row mt-3">
            <!-- Grid column -->
            <div class="col-md-4 col-lg-5 col-xl-4 mx-auto mb-4">
                <!-- Content -->
                <h6 class="text-uppercase fw-bold mb-4">
                    <i class="bi bi-gem me-3 text-grayish"></i>
                    {{ env('APP_NAME') }}
                </h6>
                <ul class="list-style-none">
                    <li>
                        <a href="{{ route('about_us') }}"
                            class="py-1 fw-bold text-muted text-decoration-none">{{ __('About us') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('terms_and_conditions') }}"
                            class="py-1 fw-bold text-muted text-decoration-none">{{ __('Terms & Conditions') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('privacy_policy') }}"
                            class="py-1 fw-bold text-muted text-decoration-none">{{ __('Privacy Policy') }}</a>
                    </li>
                </ul>
            </div>

            <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                <ul class="list-style-none p-0">
                    <li>
                        <a href="{{ route('home') }}" class="py-1 fw-bold text-muted text-decoration-none">
                            {{ __('Home') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('restaurants.list') }}"
                            class="py-1 fw-bold text-muted text-decoration-none">
                            {{ __('Restaurants') }}
                        </a>
                    </li>
                    <li>
                        <a href=""
                            class="py-1 fw-bold text-muted text-decoration-none">
                            {{ __('Job Position') }}
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Contact --}}
            <div class="col-md-5 col-lg-5 col-xl-4 mx-auto mb-md-0 mb-4">
                <!-- Links -->
                <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
                <p><i class="bi bi-house me-3 text-grayish"></i>
                    <a href="https://www.google.com/maps/place/https://www.google.com/maps/place/Maistraatinportti+4a,+00240+Helsinki,+Finlande/@60.1983782,24.9239266,17z/data=!3m1!4b1!4m5!3m4!1s0x4692098c4dafc5a3:0x676744493fa14a2b!8m2!3d60.1983756!4d24.9261153"
                        class="text-muted text-decoration-none" target="_blank">
                        Maistraatinportti 4 A, 00240 Helsinki
                    </a>
                </p>
                <p>
                    <i class="bi bi-envelope me-3 text-grayish"></i>
                    <a href="mailto:contact@pizzaservice.fi" class="text-muted text-decoration-none">
                        contact@pizzaservice.fi
                    </a>
                </p>
                <p>
                    <i class="bi bi-phone me-3 text-grayish"></i>
                    <a href="tel:+358443309343" class="text-muted text-decoration-none">+358443309343</a>
                </p>
            </div>
            <!-- Grid column -->
        </div>
        <!-- Grid row -->
    </section>
    <!-- Section: Links  -->

    <!-- Copyright -->
    <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.025);">
        Pizza Service by
        <a href="gogofood.fi" class="text-decoration-none" target="_blank">
            GoGo Food Finland oy
        </a>
        | &copy; 2022 All rights reserved
    </div>
    <!-- Copyright -->
</footer>
<!-- Footer -->

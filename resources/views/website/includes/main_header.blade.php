<header id="header" class="header bg-primary {{ Route::currentRouteName() == 'home' ? 'is-home' : null }}">
    <div id="carouselExampleIndicators" class="carousel slide h-100 overflow-hidden" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>

        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('assets/heros/restaurant.jpg') }}" class="d-block w-auto h-100">
            </div>
            {{-- <div class="carousel-item">
                <img src="https://fakeimg.pl/1200x400/?text=Slider 2&font=lobster" class="d-block w-100">
            </div>
            <div class="carousel-item">
                <img src="https://fakeimg.pl/1200x400/?text=Slider 3&font=lobster" class="d-block w-100">
            </div> --}}
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</header>

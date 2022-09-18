@extends('website.layouts.default')

@section('content')
    <hero-component src="{{ asset($restaurant->cover) }}">
        <div class="container text-center">
            <h1>{{ $restaurant->name }}</h1>
            <p class="fw-bold">
                <i class="bi bi-clock"></i>
                <span class="{{ $restaurant->is_open ? 'text-success' : 'text-danger' }}">
                    {{ $restaurant->is_open ? 'Open' : 'Closed' }}
                </span>
                <span>
                    {{ $restaurant->today_time_slots }}
                </span>
            </p>
            {{-- Categories --}}
            <p>
                <i class="bi bi-tags"></i>
                {{ implode(', ', $restaurant->categories->pluck('name')->toArray()) }}
            </p>

            {{-- Min order and Delivery time --}}
            <div class="d-flex flex-column flex-lg-row justify-content-center align-items-center">
                <p>
                    <label class="fw-bold">
                        <i class="bi bi-cash"></i>
                        Order Min Amount :
                    </label>&nbsp;
                    <span class="inr-min">{{ $restaurant->minimum_order }} €</span>
                </p>
                <p class="d-none d-lg-block">
                    &nbsp;
                    |
                    &nbsp;
                </p>
                <p>
                    <label class="fw-bold">
                        <i class="bi bi-clock"></i>
                        Delivery time :
                    </label>&nbsp;
                    <span>{{ $restaurant->delivery_time }} min</span>
                </p>
            </div>

            {{-- Phone and Address --}}
            <div class="d-flex flex-column flex-lg-row justify-content-center align-items-center">
                <p>
                    <label class="fw-bold">
                        <i class="bi bi-phone"></i>
                        Phone number :
                    </label>&nbsp;
                    <a href="tel:{{ $restaurant->phone }}"
                        class="text-decoration-none text-white">
                        {{ $restaurant->phone }}
                    </a>
                </p>
                <p class="d-none d-lg-block">
                    &nbsp;
                    |
                    &nbsp;
                </p>
                <p>
                    <label class="fw-bold">
                        <i class="bi bi-geo-alt"></i>
                        Address :
                    </label>&nbsp;
                    <a href="https://www.google.com/maps/place/{{ $restaurant->address . '/@' . $restaurant->coordinates }},15z"
                        target="_blank"
                        class="text-decoration-none text-white">
                        {{ $restaurant->address }}
                    </a>
                </p>
            </div>

            <div class="d-flex flex-column flex-lg-row justify-content-center align-items-center">
                @if ($restaurant->discount)
                    <p>
                        <label class="fw-bold">
                            <i class="bi bi-cash"></i>
                            Discount :
                        </label>&nbsp;
                        <span class="inr-min">- {{ $restaurant->discount }} %</span>
                    </p>
                    <p class="d-none d-lg-block">
                        &nbsp;
                        |
                        &nbsp;
                    </p>
                @endif
                <p>
                    <label class="fw-bold">
                        <i class="bi bi-cash"></i>
                        Delivery fee :
                    </label>&nbsp;
                    <span>{{ $restaurant->delivery_fee }} €</span>
                </p>
            </div>
            <scroll-button section="menusSection" title="Menus"></scroll-button>
        </div>
    </hero-component>
    <div class="container-fluid" id="menusSection">
        <products-list :restaurant="{{ $restaurant }}"></products-list>
    </div>
@endsection

@once
    @push('scripts')
        <script src="{{ asset(mix('website/js/restaurant.js')) }}"></script>
    @endpush
@endonce

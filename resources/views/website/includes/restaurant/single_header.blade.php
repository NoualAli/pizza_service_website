<div class="row w-100 py-5 border m-0">
    <div class="col-lg-4 col-12 text-center">
        <img class="img-fluid" src="{{ asset($restaurant->thumbnail) }}" alt="{{ $restaurant->name }} thumbnail">
    </div>
    <div class="col-lg-8 col-12">
        <div class="row">
            <div class="col-12">
                <h1>{{ $restaurant->name }}</h1>
            </div>
            <div class="col-12">
                <div class="col-sm-12 info">
                    <div class="row">
                        <div class="col-sm-3 info">
                            <div>
                                <label class="fw-bold">
                                    Opening Hours:
                                    <span class="text-secondary">
                                        {{ $restaurant->slots }}
                                    </span>
                                </label>
                                <p class="{{ $restaurant->is_open ? 'text-success' : 'text-danger' }}">
                                    {{ $restaurant->is_open ? 'Open' : 'Closed' }}
                                </p>
                            </div>
                            <div>
                                <label class="fw-bold">Categories :</label>
                                <p>
                                    {{ implode(', ', $restaurant->categories->pluck('name')->toArray()) }}
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-5 info">
                            <div class="inline min-amount">
                                <label class="fw-bold">Order Min Amount :</label>
                                <p class="inr-min">{{ $restaurant->minimum_order }} €</p>
                            </div>
                            <div class="inline">
                                <label class="fw-bold">Delivery time : </label>
                                <p>{{ $restaurant->delivery_time }} mins</p>
                            </div>
                            {{-- <div class="inline">
                                <label class="fw-bold">Offer :</label>
                                <p>
                                    10 % discount on min Order 10
                                </p>
                            </div> --}}
                        </div>
                        <div class="col-sm-4 info">
                            <div class="inline">
                                <label class="fw-bold">Phone number : </label>
                                <p>
                                    <a href="tel:">+358505432727</a>
                                </p>
                            </div>

                            <div>
                                <label class="fw-bold">Address :</label>
                                <a href="https://www.google.com/maps/place/{{ $restaurant->address . '/@' . $restaurant->coordinates }},15z"
                                    target="_blank"
                                    class="text-decoration-none">
                                    {{ $restaurant->address }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <div class="card mb-3 text-decoration-none text-dark" style="max-width: 540px;">
    <div class="row g-0">
        <div class="col-md-4">
            <img src="{{ $restaurant->thumbnail }}" class="img-fluid rounded-start" alt="{{ $restaurant->name }}">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title">{{ $restaurant->name }}</h5>
                <p class="card-text">{{ $restaurant->description }}</p>
                <p class="card-text">
                    @foreach ($restaurant->categories as $category)
                        <small class="badge bg-primary">{{ $category->name }}</small>
                    @endforeach
                </p>
            </div>
        </div>
        <div class="col">
            <div class="card-footer">
                <a href="{{ route('restaurants.single', $restaurant) }}" class="btn btn-primary text-white">Go
                    restaurant</a>
            </div>
        </div>
    </div>
</div> --}}

<div class="ps-card"
    style="background-image: url({{ asset($restaurant->thumbnail) }})">
    <div class="book-container">
        <div class="content">
            <a class="btn" href="{{ route('restaurants.single', $restaurant) }}">{{ __('Show menu') }}</a>
        </div>
    </div>
    <div class="informations-container">
        <h2 class="title">{{ $restaurant->name }}</h2>
        <p class="sub-title">{{ $restaurant->description }}</p>
        <p class="price"><svg class="icon" style="width:24px;height:24px" viewBox="0 0 24 24">
                <path fill="currentColor"
                    d="M3,6H21V18H3V6M12,9A3,3 0 0,1 15,12A3,3 0 0,1 12,15A3,3 0 0,1 9,12A3,3 0 0,1 12,9M7,8A2,2 0 0,1 5,10V14A2,2 0 0,1 7,16H17A2,2 0 0,1 19,14V10A2,2 0 0,1 17,8H7Z" />
            </svg>{{ number_format($restaurant->products()->avg('price')) }} €</p>
        <div class="more-informations">
            <div class="box categories">
                {{-- <svg class="icon" style="width:24px;height:24px" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="M11,9H13V7H11M12,20C7.59,20 4,16.41 4,12C4,7.59 7.59,4 12,4C16.41,4 20,7.59 20,12C20,16.41 16.41,20 12,20M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M11,17H13V11H11V17Z" />
                </svg> --}}
                @foreach ($restaurant->categories as $category)
                    <span class="badge bg-primary">
                        {{ $category->name }}
                    </span>
                @endforeach
            </div>
            <div class="box date">
                <div class="icon">
                    <i class="bi bi-clock"></i>
                </div>
                <p>{{ $restaurant->slots }}</p>
            </div>
        </div>
    </div>
</div>

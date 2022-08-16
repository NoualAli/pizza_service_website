<div class="row my-5">
    <h1 class="text-center">{{ __('All restaurants') }}</h1>
    @foreach ($restaurants as $restaurant)
        <div class="col-lg-6">
            @include('website.includes.restaurant.restaurant')
        </div>
    @endforeach
</div>

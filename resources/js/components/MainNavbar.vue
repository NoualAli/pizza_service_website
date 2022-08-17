<template>
    <nav class="navbar navbar-expand-sm fixed-top navbar-light bg-light">
        <div class="container-fluid">
            <div class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </div>
            <div class="collapse navbar-collapse row" id="navbarSupportedContent">
                <div class="col-lg-6">
                    <a class="navbar-brand mt-2 mt-lg-0" href="home">
                        <img src="assets/brand.png" height="45" alt="{{ env('APP_NAME') }} Logo" loading="lazy" />
                    </a>
                </div>
                <div class="col-lg-6">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="restaurants">Restaurants</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-cart"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

</template>

@extends('member.layout')

@section('content')
    <div id="carouselExampleControls" class="carousel slide mb-5 mt-3 carousel-wrapper" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('/assets/image/carousel-1.jpg') }}" class="d-block w-100 img-slider-item"
                     alt="hero-carousel-1">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('/assets/image/carousel-1.jpg') }}" class="d-block w-100 img-slider-item"
                     alt="hero-carousel-1">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <section id="product-section">
        <div class="w-100 d-flex justify-content-center mb-3">
            <p class="section-title">Our Products</p>
        </div>
        <div class="product-container mb-3">
            @foreach($products as $product)
                <div class="card-product" data-id="{{ $product->id }}">
                    <img src="{{ $product->gambar }}" alt="product-image">
                    <div class="product-info">
                        <p class="product-name">{{ $product->nama }}</p>
                        <p class="product-specification">Usia : {{ $product->umur }} tahun</p>
                        <p class="product-specification">Berat : {{ $product->berat }} kg</p>
                        <p class="product-price">Rp.{{ number_format($product->harga, 0, ',', '.') }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="w-100 d-flex justify-content-center mb-3">
            <a href="#">See All</a>
        </div>
    </section>
@endsection

@section('js')
    <script>
        function eventProductDetail() {
            $('.card-product').on('click', function () {
                let id = this.dataset.id;
                window.location.href = '/product/' + id;
            })
        }

        $(document).ready(function () {
            eventProductDetail();
        })
    </script>
@endsection

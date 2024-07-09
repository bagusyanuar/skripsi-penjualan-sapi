@extends('member.layout')

@section('content')
    <section id="greeting-section" class="mb-3">
        <div class="greeting-wrapper row" style="--bs-gutter-x: 0;">
            <div class="col-md-6 col-lg-6 left-wrapper">
                <p style="font-size: 2.5em; line-height: 1; color: var(--dark); font-weight: 600; margin-bottom: 0;">
                    Heli Farm
                </p>
                <p style="font-size: 0.8em; color: var(--dark); font-weight: 500; margin-bottom: 20px;">
                    Penyedia sapi terpercaya se karisidenan surakarta.
                </p>
                <a href="#" class="greeting-button">
                    <span class="me-2">Pilih Sapi Sekarang</span>
                    <i class='bx bx-right-arrow-alt' style="font-size: 1.25em;"></i>
                </a>
            </div>
            <div class="col-md-6 col-lg-6 right-wrapper">
                <img src="{{ asset('/assets/image/greeting-image.png') }}" width="400" alt="greeting-image">
            </div>
        </div>
    </section>
    <div class="main-content">
        <section id="product-section">
            <div class="w-100 d-flex justify-content-center mb-3">
                <p class="section-title" style="width: fit-content; color: var(--dark)">PILIHAN SAPI</p>
            </div>
            <div class="product-container mb-4">
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
                <a href="{{ route('member.product') }}" style="color: var(--dark); font-weight: 500;">
                    Lihat Semua Pilihan Sapi
                </a>
            </div>
        </section>
    </div>

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

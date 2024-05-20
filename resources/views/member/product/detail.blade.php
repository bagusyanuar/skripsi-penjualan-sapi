@extends('member.layout')

@section('content')
    <div class="w-100 d-flex justify-content-between align-items-center mb-3">
        <p class="page-title">Product Detail</p>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('member.home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('member.product') }}">Product</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $product->nama }}</li>
            </ol>
        </nav>
    </div>
    <div class="product-detail-container">
        <div class="product-detail-image-container">
            <div class="image-container">
                <img src="{{ $product->gambar }}" alt="product-image">
            </div>
        </div>
        <div class="product-detail-info-container mb-3">
            <p class="product-detail-name">{{ $product->nama }}</p>
            <p class="product-detail-specification">Umur : {{ $product->umur }} (tahun)</p>
            <p class="product-detail-specification mb-3">Berat : {{ $product->berat }} (kg)</p>
            <div class="product-detail-action">
                <a href="#" class="btn-add-cart" id="btn-add-cart">
                    <i class='bx bx-cart-alt'></i>
                    <span>Tambah Keranjang</span>
                </a>
                <a href="#" class="btn-shop" id="btn-shop">
                    <i class='bx bx-shopping-bag'></i>
                    <span>Beli Sekarang</span>
                </a>
            </div>
        </div>
    </div>
    <hr class="custom-divider"/>
    <p class="page-title" style="font-size: 1em">Product Description</p>
    <div style="font-size: 0.8em">{!! $product->deskripsi !!}</div>
@endsection

@section('js')
    <script src="{{ asset('/js/helper.js') }}"></script>
    <script>


    </script>
@endsection

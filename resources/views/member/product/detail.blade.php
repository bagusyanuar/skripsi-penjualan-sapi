@extends('member.layout')

@section('content')
    <div class="lazy-backdrop" id="overlay-loading">
        <div class="d-flex flex-column justify-content-center align-items-center">
            <div class="spinner-border text-light" role="status">
            </div>
            <p class="text-light">Sedang Menyimpan Data...</p>
        </div>
    </div>
    <div class="main-content">
        <div class="w-100 d-flex justify-content-between align-items-center mb-3">
            <p class="page-title">Product Detail</p>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0" style="padding: 0 0;">
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
                <p style="margin-bottom: 2px; color: var(--bg-accent); font-size: 2.25em; font-weight: bold">
                    Rp. {{ number_format($product->harga,0, ',','.') }}</p>
                <div class="d-flex align-items-center mb-3">
                    <p class="product-detail-specification mb-0" style="font-size: 0.8em">Umur : {{ $product->umur }}
                        (tahun)</p>
                    <span class="me-2 ms-2">|</span>
                    <p class="product-detail-specification mb-0" style="font-size: 0.8em">Berat : {{ $product->berat }}
                        (kg)</p>
                </div>

                <p class="page-title" style="font-size: 1em">Product Description</p>
                <div style="font-size: 0.8em">{!! $product->deskripsi !!}</div>
            </div>
            <div class="product-detail-action-container">
                <p style="font-weight: bold; color: var(--dark); margin-bottom: 0;">Beli Sekarang</p>
                <hr class="custom-divider"/>
                <div class="product-detail-action">
                    @auth()
                        <a href="#" class="btn-add-cart mb-1" id="btn-cart" data-id="{{ $product->id }}">Keranjang</a>
                    @else
                        <a href="{{ route('member.login') }}" class="btn-add-cart mb-1">Keranjang</a>
                    @endauth
                </div>
            </div>
        </div>
        <hr class="custom-divider"/>

    </div>
@endsection

@section('js')
    <script src="{{ asset('/js/helper.js') }}"></script>
    <script>
        var cartURL = '{{ route('member.cart') }}';

        function eventAddToCart() {
            $('#btn-cart').on('click', function (e) {
                e.preventDefault();
                let id = this.dataset.id;
                addToCartHandler(id)
            })
        }

        async function addToCartHandler(id) {
            try {
                blockLoading(true);
                await $.post(cartURL, {
                    id
                });
                blockLoading(false);
                Swal.fire({
                    title: 'Success',
                    text: 'Berhasil menambahkan product ke keranjang...',
                    icon: 'success',
                    timer: 700
                }).then(() => {
                    window.location.href = '/keranjang';
                })
            } catch (e) {
                blockLoading(false);
                let error_message = JSON.parse(e.responseText);
                ErrorAlert('Error', error_message.message);
            }
        }

        $(document).ready(function () {
            eventAddToCart();
        })

    </script>
@endsection

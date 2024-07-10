@extends('member.layout')

@section('content')
    <div class="main-content">
        <div class="w-100 d-flex justify-content-between align-items-center mb-3">
            <p class="page-title">Pesanan</p>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0" style="padding: 0 0;">
                    <li class="breadcrumb-item"><a href="{{ route('member.home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('member.order') }}">Pesanan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $data->no_penjualan }}</li>
                </ol>
            </nav>
        </div>
        <div class="w-100">
            <div class="row mb-3">
                <div class="col-6">
                    <div style="font-size: 0.8em; color: var(--dark);">
                        <div class="d-flex align-items-center mb-1">
                            <span style="" class="me-2">No. Pembelian :</span>
                            <span style="font-weight: 600;">{{ $data->no_penjualan }}</span>
                        </div>
                        <div class="d-flex align-items-center mb-1">
                            <span style="" class="me-2">Tgl. Pembelian :</span>
                            <span
                                style="font-weight: 600;">{{ \Carbon\Carbon::parse($data->tanggal)->format('d F Y') }}</span>
                        </div>

                        @if($data->tanggal_check !== null)
                            <div class="d-flex align-items-center mb-1">
                                <span style="" class="me-2">Pengecekan Sapi :</span>
                                <div class="d-flex align-items-center gap-1">
                                    <span>Ya</span>
                                    <span style="font-weight: 600;">({{ \Carbon\Carbon::parse($data->tanggal_check)->format('d F Y') }})</span>
                                </div>
                            </div>
                        @else
                            <div class="d-flex align-items-center mb-1">
                                <span style="" class="me-2">Pengecekan Sapi :</span>
                                <div class="d-flex align-items-center gap-1">
                                    <span>Tidak</span>
                                </div>
                            </div>
                        @endif
                        <div class="d-flex align-items-center mb-1">
                            <span style="" class="me-2">Alamat Pengiriman :</span>
                            <span style="font-weight: 600;">{{ $data->alamat }}</span>
                        </div>
                        <div class="d-flex align-items-center mb-1">
                            <span style="" class="me-2">Status :</span>
                            <div style="font-weight: 600;">
                                @if($data->status === 0)
                                    <div class="chip-status-warning">menunggu pembayaran</div>
                                @elseif($data->status === 1)
                                    <div class="chip-status-warning">menunggu konfirmasi pembayaran</div>
                                @elseif($data->status === 2)
                                    <div class="chip-status-warning">pesanan di proses</div>
                                @elseif($data->status === 3)
                                    <div class="chip-status-info">pesanan di kirim</div>
                                @elseif($data->status === 4)
                                    <div class="chip-status-success">selesai</div>
                                @elseif($data->status === 5)
                                    <div class="chip-status-danger">Pesanan Di tolak</div>
                                @endif
                            </div>
                        </div>
                        @if($data->status === 5)
                            <div class="d-flex align-items-center mb-1">
                                <span style="" class="me-2">Alasan Penolakan :</span>
                                <span style="font-weight: 600;">{{ $data->pembayaran_status->deskripsi }}</span>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-6">
                    <div class="progress-wrapper">
                        <div class="progress-item-wrapper">
                            <div class="progress-item active">
                                <i class='bx bx-money'></i>
                            </div>
                            <div class="progress-item-text active">Menunggu Pembayaran</div>
                        </div>
                        <div class="progress-connector-wrapper">
                            <div
                                class="progress-connector {{ ($data->status < 5 && $data->status > 0) ? 'active' : '' }}"></div>
                        </div>
                        <div class="progress-item-wrapper">
                            <div class="progress-item {{ ($data->status !== 5 && $data->status > 0) ? 'active' : '' }}">
                                <i class='bx bx-user-circle'></i>
                            </div>
                            <div
                                class="progress-item-text {{ ($data->status !== 5 && $data->status > 0) ? 'active' : '' }}">
                                Menunggu Konfirmasi Pembayaran
                            </div>
                        </div>
                        <div class="progress-connector-wrapper">
                            <div
                                class="progress-connector {{ ($data->status !== 5 && $data->status > 1) ? 'active' : '' }}"></div>
                        </div>
                        <div class="progress-item-wrapper">
                            <div class="progress-item {{ ($data->status !== 5 && $data->status > 1) ? 'active' : '' }}">
                                <i class='bx bx-package'></i>
                            </div>
                            <div
                                class="progress-item-text {{ ($data->status !== 5 && $data->status > 1) ? 'active' : '' }}">
                                Pesanan Di Proses
                            </div>
                        </div>
                        <div class="progress-connector-wrapper">
                            <div
                                class="progress-connector {{ ($data->status !== 5 && $data->status > 2) ? 'active' : '' }}"></div>
                        </div>
                        <div class="progress-item-wrapper">
                            <div class="progress-item {{ ($data->status !== 5 && $data->status > 2) ? 'active' : '' }}">
                                <i class='bx bx-car'></i>
                            </div>
                            <div
                                class="progress-item-text {{ ($data->status !== 5 && $data->status > 2) ? 'active' : '' }}">
                                Barang Dikirim
                            </div>
                        </div>
                        <div class="progress-connector-wrapper">
                            <div
                                class="progress-connector {{ ($data->status !== 5 && $data->status > 3) ? 'active' : '' }}"></div>
                        </div>
                        <div class="progress-item-wrapper">
                            <div class="progress-item {{ ($data->status !== 5 && $data->status > 3) ? 'active' : '' }}">
                                <i class='bx bx-check'></i>
                            </div>
                            <div
                                class="progress-item-text {{ ($data->status !== 5 && $data->status > 3) ? 'active' : '' }}">
                                Selesai
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="custom-divider"/>
            <div class="d-flex w-100 gap-3">
                <div class="flex-grow-1 d-flex gap-2">
                    <div class="cart-list-container">
                        <div class="cart-item-container mb-3" style="height: fit-content;">
                            <img src="{{ asset('/assets/products/f3d01311-b593-499b-9916-09c69d480db1.jpg') }}"
                                 alt="product-image">
                            <div class="flex-grow-1">
                                <p style="color: var(--dark); font-size: 1em; margin-bottom: 0; font-weight: bold">Sapi
                                    A</p>
                                <p style="margin-bottom: 0; color: var(--dark-tint); font-size: 0.8em;">Jenis A</p>
                                <div class="d-flex align-items-center" style="font-size: 0.8em;">
                                    <span style="color: var(--dark-tint);" class="me-1">Jumlah: </span>
                                    <span style="color: var(--dark); font-weight: bold;">1X (Rp.25.000.000)</span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end" style="width: 150px;">
                                <p style="font-size: 1em; font-weight: bold; color: var(--dark);">
                                    Rp25.000.000</p>
                            </div>
                        </div>
                        <div class="cart-item-container" style="height: fit-content;">
                            <img src="{{ asset('/assets/products/f3d01311-b593-499b-9916-09c69d480db1.jpg') }}"
                                 alt="product-image">
                            <div class="flex-grow-1">
                                <p style="color: var(--dark); font-size: 1em; margin-bottom: 0; font-weight: bold">Sapi
                                    A</p>
                                <p style="margin-bottom: 0; color: var(--dark-tint); font-size: 0.8em;">Jenis A</p>
                                <div class="d-flex align-items-center" style="font-size: 0.8em;">
                                    <span style="color: var(--dark-tint);" class="me-1">Jumlah: </span>
                                    <span style="color: var(--dark); font-weight: bold;">1X (Rp.25.000.000)</span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end" style="width: 150px;">
                                <p style="font-size: 1em; font-weight: bold; color: var(--dark);">
                                    Rp25.000.000</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-content" style="width: 350px; height: fit-content;">
                    <p style="font-size: 1em; font-weight: bold; color: var(--dark);">Ringkasan Belanja</p>
                    <hr class="custom-divider"/>
                    <div class="d-flex align-items-center justify-content-between mb-1" style="font-size: 1em;">
                        <span style="color: var(--dark-tint); font-size: 0.8em">Total</span>
                        <span id="lbl-total"
                              style="color: var(--dark); font-weight: bold;">Rp25.000.000</span>
                    </div>

                    @if($data->status === 0 || $data->status === 5)
                        <hr class="custom-divider"/>
                        <a href="{{ route('member.order.payment', ['id' => $data->id]) }}" class="btn-action-primary">Bayar</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

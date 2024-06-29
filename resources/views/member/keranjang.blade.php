@extends('member.layout')

@section('content')
    <div class="main-content">
        <div class="w-100 d-flex justify-content-between align-items-center mb-3">
            <p class="page-title">Cart</p>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0" style="padding: 0 0;">
                    <li class="breadcrumb-item"><a href="{{ route('member.home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Cart</li>
                </ol>
            </nav>
        </div>
        <div class="d-flex" style="gap: 1rem">
            <div class="cart-list-container">
                @forelse($carts as $cart)
                    <div class="cart-item-container mb-3">
                        <img src="{{ $cart->product->gambar }}" alt="product-image">
                        <div class="flex-grow-1">
                            <p style="color: var(--dark); font-size: 1em; margin-bottom: 0; font-weight: bold">{{ $cart->product->nama }}</p>
                            <p style="margin-bottom: 0; color: var(--dark-tint); font-size: 0.8em;">{{ $cart->product->kategori->nama }}</p>
                            <div class="d-flex align-items-center" style="font-size: 0.8em;">
                                <span style="color: var(--dark-tint);" class="me-1">Jumlah: </span>
                                <span style="color: var(--dark); font-weight: bold;">{{ $cart->qty }}X (Rp.{{ number_format($cart->harga, 0, ',' ,'.') }})</span>
                            </div>
                            <div class="d-flex justify-content-start w-100">
                                <a href="#" class="btn-delete-item" data-id="{{ $cart->id }}">
                                    <i class='bx bx-trash'></i>
                                </a>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end" style="width: 150px;">
                            <p style="font-size: 1em; font-weight: bold; color: var(--dark);">
                                Rp{{ number_format($cart->total, 0, ',' ,'.') }}</p>
                        </div>
                    </div>
                @empty
                    <div class="w-100 d-flex justify-content-center align-items-center flex-column"
                         style="background-color: white; border-radius: 12px; box-shadow: 0 8px 10px rgba(0, 0, 0, 0.2); padding: 1rem 1.5rem; min-height: 495px; ">
                        <p style="margin-bottom: 1rem; font-weight: bold;">Belum Ada Data Belanja...</p>
                        <a href="{{ route('member.product') }}" class="btn-action-accent" style="width: fit-content">Pergi
                            Belanja</a>
                    </div>
                @endforelse
            </div>
            <div class="cart-action-container">
                <p style="font-size: 1em; font-weight: bold; color: var(--dark);">Ringkasan Belanja</p>
                <hr class="custom-divider"/>
                <div class="w-100">
                    <span class="form-label input-label" style="font-size: 0.8em; font-weight: 600;">Pengecekan Sapi</span>
                    <div class="mt-2">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input pcb" type="radio" name="pcb" id="pcb_yes"
                                   value="1" checked>
                            <label class="form-check-label" for="pcb_yes" style="font-size: 0.8em; color: var(--dark);">
                                Ya
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input pcb" type="radio" name="pcb" id="pcb_no" value="0">
                            <label class="form-check-label" for="pcb_no" style="font-size: 0.8em; color: var(--dark);">
                                Tidak
                            </label>
                        </div>
                    </div>
                    <hr class="custom-divider"/>
                    <div class="w-100" id="panel-pcb">
                        <div class="w-100 mb-1">
                            <label for="pcb_date" class="form-label input-label">Tanggal PCB</label>
                            <input type="date" class="text-input"
                                      id="pcb_date"
                                      name="pcb_date" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" />
                        </div>
                    </div>
                </div>
                <div class="w-100 mb-1">
                    <label for="address" class="form-label input-label">Alamat</label>
                    <textarea rows="3" placeholder="contoh: Wonosaren rt 04 rw 08, jagalan, jebres" class="text-input"
                              id="address"
                              name="address">{{ $address }}</textarea>
                </div>
                <hr class="custom-divider"/>
                <a href="{{ route('member.order.payment', ['id' => '1']) }}" class="btn-action-accent mb-1" id="btn-checkout">Checkout</a>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script src="{{ asset('/js/helper.js') }}"></script>
    <script>
        var path = '/{{request()->path()}}';

        function eventDeleteCart() {
            $('.btn-delete-item').on('click', function (e) {
                e.preventDefault();
                let id = this.dataset.id;
                AlertConfirm('Konfirmasi', 'Apakah anda yakin ingin menghapus data?', function () {
                    let url = path + '/' + id + '/delete';
                    BaseDeleteHandler(url, id);
                })
            })
        }

        function changePCHHandler() {
            let val = $('input[name=pcb]:checked').val();
            let elPanelPCB = $('#panel-pcb');
            if (val === '0') {
                elPanelPCB.addClass('d-none');
            } else {
                elPanelPCB.removeClass('d-none');
            }
        }

        function eventChangePCB() {
            $('.pcb').on('change', function () {
                changePCHHandler();
            })
        }

        $(document).ready(function () {
            eventChangePCB();
            eventDeleteCart();
        })
    </script>
@endsection

@extends('member.layout')

@section('content')
    <div class="w-100 d-flex justify-content-between align-items-center mb-3">
        <p class="page-title">Products</p>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('member.home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Product</li>
            </ol>
        </nav>
    </div>
    <section id="product-content">
        <div class="text-group-container mb-4">
            <i class='bx bx-search'></i>
            <input type="text" placeholder="cari product..." class="text-group-input" id="param"
                   name="param" aria-describedby="emailHelp">
        </div>
        <div id="product-result-container">
        </div>
    </section>
@endsection

@section('js')
    <script src="{{ asset('/js/helper.js') }}"></script>
    <script>
        var path = '/{{ request()->path() }}';

        async function getData() {
            try {
                let resultEl = $('#product-result-container');
                resultEl.empty();
                resultEl.append(createLoader('sedang mengunduh data...', 400));
                let param = $('#param').val();
                let url = path + '?param=' + param;
                let response = await $.get(url);
                let data = response['data'];
                resultEl.empty();
                if (data.length > 0) {
                    resultEl.append(createProductElement(data));
                    eventProductDetail();
                } else {
                    resultEl.append(createEmptyProduct());
                }
            } catch (e) {
                alert('error');
            }
        }

        function createProductElement(data = []) {
            let productsEl = '';
            $.each(data, function (k, v) {
                let id = v['id'];
                let image = v['gambar'];
                let name = v['nama'];
                let age = v['umur'];
                let weight = v['berat'];
                let price = v['harga'];
                let formattedPrice = price.toLocaleString('id-ID')
                productsEl += '<div class="card-product" data-id="' + id + '">' +
                    '<img src="' + image + '" alt="product-image" />' +
                    '<div class="product-info">' +
                    '<p class="product-name">' + name + '</p>' +
                    '<p class="product-specification">Usia : ' + age + ' tahun</p>' +
                    '<p class="product-specification">Berat : ' + weight + ' kg</p>' +
                    '<p class="product-price">Rp.' + formattedPrice + '</p>' +
                    '</div>' +
                    '</div>';
            });
            return (
                '<div class="product-container" style="justify-content: start !important; gap: 1.5rem !important;">' + productsEl +
                '</div>'
            )
        }

        function eventProductDetail() {
            $('.card-product').on('click', function () {
                let id = this.dataset.id;
                window.location.href = '/product/' + id;
            })
        }

        async function eventSearchHandler() {
            $("#param").keyup(
                debounce(function (e) {
                    console.log(e.currentTarget.value);
                    getData();
                }, 1000)
            );
        }

        $(document).ready(function () {
            getData();
            eventSearchHandler();
        });
    </script>
@endsection

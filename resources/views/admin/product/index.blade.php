@extends('admin.layout')

@section('content')
    <div class="mb-3">
        <p class="content-title">Product</p>
        <p class="content-sub-title">Manajemen data product</p>
    </div>
    <div class="card-content">
        <div class="content-header mb-3">
            <p class="header-title">Data Product</p>
            <a href="{{ route('admin.product.add') }}" class="btn-add">
                <i class='bx bx-plus'></i>
                <span>New Product</span>
            </a>
        </div>
        <hr class="custom-divider"/>
        <table id="table-data" class="display table w-100">
            <thead>
            <tr>
                <th width="5%" class="text-center">#</th>
                <th width="15%">Gambar</th>
                <th>Nama</th>
                <th width="12%" class="text-end">Harga (Rp.)</th>
                <th width="15%" class="text-center">Aksi</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection

@section('js')
    <script>
        var table;

        function generateTable() {
            table = $('#table-data').DataTable({
                "aaSorting": [],
                "order": [],
                scrollX: true,
                responsive: true,
                paging: true,
                "fnDrawCallback": function (setting) {
                    // eventDelete();
                    // eventDetail();
                },
            });
        }

        $(document).ready(function () {
            generateTable();
        })
    </script>
@endsection

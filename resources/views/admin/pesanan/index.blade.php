@extends('admin.layout')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-1">
        <div>
            <p class="content-title">Pesanan</p>
            <p class="content-sub-title">Manajemen data pesanan</p>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pesanan</li>
            </ol>
        </nav>
    </div>
    <ul class="nav nav-pills mb-3 custom-tab-pills" id="transaction-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link custom-tab-link active" id="pills-new-tab" data-bs-toggle="pill"
                    data-bs-target="#pills-new"
                    type="button" role="tab" aria-controls="pills-new" aria-selected="true">
                Pesanan Baru
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link custom-tab-link" id="pills-process-tab" data-bs-toggle="pill"
                    data-bs-target="#pills-process"
                    type="button" role="tab" aria-controls="pills-process" aria-selected="false">
                Pesanan Proses
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link custom-tab-link" id="pills-send-tab" data-bs-toggle="pill"
                    data-bs-target="#pills-send"
                    type="button" role="tab" aria-controls="pills-send" aria-selected="false">
                Pesanan Di Kirim
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link custom-tab-link" id="pills-finish-tab" data-bs-toggle="pill"
                    data-bs-target="#pills-finish"
                    type="button" role="tab" aria-controls="pills-finish" aria-selected="false">
                Pesanan Selesai
            </button>
        </li>
    </ul>
    <div class="tab-content" id="transaction-content">
        <div class="tab-pane fade show active" id="pills-new" role="tabpanel" aria-labelledby="pills-new-tab">
            <div class="card-content">
                <div class="content-header mb-3">
                    <p class="header-title">Data Pesanan Baru</p>
                </div>
                <hr class="custom-divider"/>
                <table id="table-data-new-order" class="display table w-100">
                    <thead>
                    <tr>
                        <th width="5%" class="text-center">#</th>
                        <th width="18%">No. Penjualan</th>
                        <th>Nama Customer</th>
                        <th width="10%" class="text-end">Total</th>
                        <th width="8%" class="text-center"></th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="tab-pane fade" id="pills-process" role="tabpanel" aria-labelledby="pills-process-tab">
            <div class="card-content">
                <div class="content-header mb-3">
                    <p class="header-title">Data Pesanan Di Proses</p>
                </div>
                <hr class="custom-divider"/>
                <table id="table-data-process-order" class="display table w-100">
                    <thead>
                    <tr>
                        <th width="5%" class="text-center">#</th>
                        <th width="15%" class="text-center">No. Penjualan</th>
                        <th class="text-left">Customer</th>
                        <th width="12%" class="text-center">No. HP</th>
                        <th width="8%" class="text-center"></th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="tab-pane fade" id="pills-send" role="tabpanel" aria-labelledby="pills-send-tab">
            <div class="card-content">
                <div class="content-header mb-3">
                    <p class="header-title">Data Pesanan Di Kirim</p>
                </div>
                <hr class="custom-divider"/>
                <table id="table-data-send-order" class="display table w-100">
                    <thead>
                    <tr>
                        <th width="5%" class="text-center">#</th>
                        <th width="15%" class="text-center">No. Penjualan</th>
                        <th class="text-left">Customer</th>
                        <th width="12%" class="text-center">No. HP</th>
                        <th width="8%" class="text-center"></th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="tab-pane fade" id="pills-finish" role="tabpanel" aria-labelledby="pills-finish-tab">
            <div class="card-content">
                <div class="content-header mb-3">
                    <p class="header-title">Data Pesanan Selesai</p>
                </div>
                <hr class="custom-divider"/>
                <table id="table-data-finish-order" class="display table w-100">
                    <thead>
                    <tr>
                        <th width="5%" class="text-center">#</th>
                        <th width="15%" class="text-center">No. Penjualan</th>
                        <th class="text-left">Customer</th>
                        <th width="12%" class="text-center">No. HP</th>
                        <th width="8%" class="text-center"></th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>

    </div>

@endsection

@section('js')
    <script src="{{ asset('/js/helper.js') }}"></script>
    <script>
        var path = '/{{ request()->path() }}';
        var table, tableProcess, tableSend ,tableFinish;

        function generateTableNewOrder() {
            table = $('#table-data-new-order').DataTable({
                ajax: {
                    type: 'GET',
                    url: path,
                    'data': function (d) {
                        d.status = 1
                    }
                },
                "aaSorting": [],
                "order": [],
                scrollX: true,
                responsive: true,
                paging: true,
                "fnDrawCallback": function (setting) {
                },
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false,
                        orderable: false,
                        className: 'text-center middle-header',
                    },
                    {
                        data: 'no_penjualan',
                        className: 'middle-header text-center',
                    },
                    {
                        data: 'user.customer.nama',
                        className: 'middle-header',
                    },
                    {
                        data: 'total',
                        className: 'middle-header text-end',
                        render: function (data) {
                            return data.toLocaleString('id-ID');
                        }
                    },
                    {
                        data: null,
                        orderable: false,
                        className: 'text-center middle-header',
                        render: function (data) {
                            let id = data['id'];
                            let urlDetail = path + '/' + id + '/pesanan-baru';
                            return '<div class="w-100 d-flex justify-content-center align-items-center gap-1">' +
                                '<a style="color: var(--dark-tint)" href="' + urlDetail + '" class="btn-table-action" data-id="' + id + '"><i class="bx bx-dots-vertical-rounded"></i></a>' +
                                '</div>';
                        }
                    }
                ],
            });
        }

        function generateTableProcessOrder() {
            tableProcess = $('#table-data-process-order').DataTable({
                ajax: {
                    type: 'GET',
                    url: path,
                    'data': function (d) {
                        d.status = 2
                    }
                },
                "aaSorting": [],
                "order": [],
                scrollX: true,
                responsive: true,
                paging: true,
                "fnDrawCallback": function (setting) {
                },
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false,
                        orderable: false,
                        className: 'text-center middle-header',
                    },
                    {
                        data: 'no_penjualan',
                        className: 'middle-header text-center',
                    },
                    {
                        data: 'user.customer.nama',
                        className: 'middle-header text-left',
                    },
                    {
                        data: 'user.customer.no_hp',
                        className: 'middle-header text-left',
                    },
                    {
                        data: null,
                        orderable: false,
                        className: 'text-center middle-header',
                        render: function (data) {
                            let id = data['id'];
                            let urlDetail = path + '/' + id + '/pesanan-proses';
                            return '<div class="w-100 d-flex justify-content-center align-items-center gap-1">' +
                                '<a style="color: var(--dark-tint)" href="' + urlDetail + '" class="btn-table-action" data-id="' + id + '"><i class="bx bx-dots-vertical-rounded"></i></a>' +
                                '</div>';
                        }
                    }
                ],
            });

        }

        function generateTableTakeOrder() {
            tableSend = $('#table-data-send-order').DataTable({
                ajax: {
                    type: 'GET',
                    url: path,
                    'data': function (d) {
                        d.status = 3
                    }
                },
                "aaSorting": [],
                "order": [],
                scrollX: true,
                responsive: true,
                paging: true,
                "fnDrawCallback": function (setting) {
                },
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false,
                        orderable: false,
                        className: 'text-center middle-header',
                    },
                    {
                        data: 'no_penjualan',
                        className: 'middle-header text-center',
                    },
                    {
                        data: 'user.customer.nama',
                        className: 'middle-header text-left',
                    },
                    {
                        data: 'user.customer.no_hp',
                        className: 'middle-header text-left',
                    },
                    {
                        data: null,
                        orderable: false,
                        className: 'text-center middle-header',
                        render: function (data) {
                            let id = data['id'];
                            let urlDetail = path + '/' + id + '/siap-diambil';
                            return '<div class="w-100 d-flex justify-content-center align-items-center gap-1">' +
                                '<a style="color: var(--dark-tint)" href="' + urlDetail + '" class="btn-table-action" data-id="' + id + '"><i class="bx bx-dots-vertical-rounded"></i></a>' +
                                '</div>';
                        }
                    }
                ],
            });

        }

        function generateTableFinishOrder() {
            tableFinish = $('#table-data-finish-order').DataTable({
                ajax: {
                    type: 'GET',
                    url: path,
                    'data': function (d) {
                        d.status = 4
                    }
                },
                "aaSorting": [],
                "order": [],
                scrollX: true,
                responsive: true,
                paging: true,
                "fnDrawCallback": function (setting) {
                },
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false,
                        orderable: false,
                        className: 'text-center middle-header',
                    },
                    {
                        data: 'no_penjualan',
                        className: 'middle-header text-center',
                    },
                    {
                        data: 'user.customer.nama',
                        className: 'middle-header text-left',
                    },
                    {
                        data: 'user.customer.no_hp',
                        className: 'middle-header text-left',
                    },
                    {
                        data: null,
                        orderable: false,
                        className: 'text-center middle-header',
                        render: function (data) {
                            let id = data['id'];
                            let urlDetail = path + '/' + id + '/pesanan-selesai';
                            return '<div class="w-100 d-flex justify-content-center align-items-center gap-1">' +
                                '<a style="color: var(--dark-tint)" href="' + urlDetail + '" class="btn-table-action" data-id="' + id + '"><i class="bx bx-dots-vertical-rounded"></i></a>' +
                                '</div>';
                        }
                    }
                ],
            });

        }

        function eventChangeTab() {
            $('#transaction-tab').on('shown.bs.tab', function (e) {
                if (e.target.id === 'pills-process-tab') {
                    tableProcess.columns.adjust();
                }

                if (e.target.id === 'pills-send-tab') {
                    tableSend.columns.adjust();
                }

                if (e.target.id === 'pills-finish-tab') {
                    tableFinish.columns.adjust();
                }
            })
        }

        $(document).ready(function () {
            generateTableNewOrder();
            // generateTableProcessOrder();
            // generateTableTakeOrder();
            // generateTableFinishOrder();
            eventChangeTab();
        })
    </script>
@endsection

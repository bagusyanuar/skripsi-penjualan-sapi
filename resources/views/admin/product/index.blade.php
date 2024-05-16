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
            {{--            <tbody>--}}
            {{--            @foreach($data as $datum)--}}
            {{--                <tr>--}}
            {{--                    <td width="5%" class="text-center middle-header">{{ $loop->index + 1 }}</td>--}}
            {{--                    <td class="middle-header">{{ $datum->nama }}</td>--}}
            {{--                    <td class="middle-header">{{ $datum->nama }}</td>--}}
            {{--                    <td class="middle-header">{{ $datum->nama }}</td>--}}
            {{--                    <td class="middle-header">{{ $datum->nama }}</td>--}}
            {{--                </tr>--}}
            {{--            @endforeach--}}
            {{--            </tbody>--}}
        </table>
    </div>
@endsection

@section('js')
    <script>
        var path = '/{{ request()->path() }}';
        var table;

        function generateTable() {
            table = $('#table-data').DataTable({
                ajax: {
                    type: 'GET',
                    url: path,
                    // 'data': data
                },
                "aaSorting": [],
                "order": [],
                scrollX: true,
                responsive: true,
                paging: true,
                "fnDrawCallback": function (setting) {
                    expandRow();
                    // eventDelete();
                    // eventDetail();
                },
                columns: [
                    {
                        className: 'dt-control',
                        orderable: false,
                        data: null,
                        render: function () {
                            return '<i class="bx bx-plus-circle"></i>';
                        }
                    },
                    {
                        data: 'nama',
                        className: 'middle-header',
                    },
                    {
                        data: 'nama'
                    },
                    {
                        data: 'harga',
                        className: 'text-right middle-header'
                    },
                    {
                        data: null,
                        render: function () {
                            return '-';
                        }
                    }
                ],
            });
        }

        function expandRow() {
            $('#table-data tbody').on('click', 'td.dt-control', function () {
                var tr = $(this).closest('tr');
                var row = table.row(tr);
                var i = $(this).children();
                if (row.child.isShown()) {
                    // This row is already open - close it
                    console.log('close')
                    row.child.hide();
                    tr.removeClass('shown');
                    i.removeClass('bx-minus-circle');
                    i.addClass('bx-plus-circle');
                } else {
                    console.log('open')
                    // Open this row
                    row.child(detailElement(row.data())).show();
                    tr.addClass('shown');
                    i.removeClass('bx-plus-circle');
                    i.addClass('bx-minus-circle');
                    // console.log(tr.closest('i'));
                }
            });
        }

        function detailElement(data) {
            let a = data['deskripsi'].toString();
            let elString = $.parseHTML(a);
            console.log(elString[0].nodeValue);
            return (
                '<div>' + elString[0].nodeValue + '</div>'
            );
        }

        $(document).ready(function () {
            generateTable();
            expandRow();
        })
    </script>
@endsection

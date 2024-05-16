@extends('admin.layout')

@section('content')
    <div class="mb-3">
        <p class="content-title">Edit Product</p>
        <p class="content-sub-title">Edit data product</p>
    </div>
    <div class="card-content">
        <form method="post" id="form-data">
            @csrf
            <div class="w-100 mb-3">
                <label for="name" class="form-label input-label">Product Name <span
                        class="color-danger">*</span></label>
                <input type="text" placeholder="product name" class="text-input" id="name"
                       name="name" value="{{ $data->nama }}">
                <span id="name-error" class="input-label-error d-none"></span>
            </div>
            <div class="w-100 mb-3">
                <label for="price" class="form-label input-label">Product Price (Rp.) <span
                        class="color-danger">*</span></label>
                <input type="number" placeholder="product price" class="text-input" id="price"
                       name="price" value="{{ $data->harga }}">
                <span id="price-error" class="input-label-error d-none"></span>
            </div>
            <div class="w-100 mb-3">
                <label for="description" class="form-label input-label">Description</label>
                <textarea rows="6" placeholder="Product Description" class="text-input" id="description"
                          name="description">{{ $data->deskripsi }}</textarea>
            </div>
            <div class="w-100">
                <label for="document-dropzone" class="form-label input-label">Product Picture</label>
                <div class="w-100 needsclick dropzone mb-3" id="document-dropzone"></div>
            </div>
        </form>
        <hr class="custom-divider"/>
        <div class="d-flex align-items-center justify-content-end w-100">
            <a href="#" class="btn-add" id="btn-save">
                <i class='bx bx-check'></i>
                <span>Save</span>
            </a>
        </div>
    </div>
@endsection

@section('css')
    <link href="{{ asset('/css/dropzone.min.css') }}" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection

@section('js')
    <script src="{{ asset('/js/helper.js') }}"></script>
    <script src="{{ asset('/js/dropzone.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        var path = '/{{ request()->path() }}';
        var uploadedDocumentMap = {};
        var myDropzone;
        Dropzone.autoDiscover = false;
        Dropzone.options.documentDropzone = {
            success: function (file, response) {
                $('#form').append('<input type="hidden" name="files[]" value="' + file.name + '">');
                console.log(response);
                uploadedDocumentMap[file.name] = response.name
            },
        };

        function setupDropzone() {
            $('#document-dropzone').dropzone({
                url: path,
                maxFilesize: 5,
                addRemoveLinks: true,
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                },
                autoProcessQueue: false,
                paramName: "file",
                init: function () {
                    myDropzone = this;
                    $('#btn-save').on('click', function (e) {
                        e.preventDefault();
                        Swal.fire({
                            title: "Konfirmasi!",
                            text: "Apakah anda yakin ingin menyimpan data?",
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Batal',
                        }).then((result) => {
                            if (result.value) {
                                blockLoading(true);
                                if (myDropzone.files.length > 0) {
                                    myDropzone.processQueue();
                                } else {
                                    let frm = $('#form-data')[0];
                                    let f_data = new FormData(frm);
                                    $.ajax({
                                        type: "POST",
                                        enctype: 'multipart/form-data',
                                        url: path,
                                        data: f_data,
                                        processData: false,
                                        contentType: false,
                                        cache: false,
                                        timeout: 600000,
                                        success: function (data) {
                                            blockLoading(false);
                                            Swal.fire({
                                                title: 'Berhasil',
                                                text: 'Berhasil Menyimpan data...',
                                                icon: 'success',
                                                timer: 700
                                            }).then(() => {
                                                window.location.reload();
                                            });
                                        },
                                        error: function (e) {
                                            blockLoading(false);
                                            Swal.fire({
                                                title: 'Ooops',
                                                text: 'Gagal Menyimpan Data...',
                                                icon: 'error',
                                                timer: 700
                                            });
                                            let response = e.responseJSON;
                                            if (response['status'] === 400) {
                                                const data = response['data'];
                                                validateMessage(data, ['name', 'price']);
                                            }
                                        }
                                    })
                                }
                            }
                        });
                    });
                    this.on('sending', function (file, xhr, formData) {
                        // Append all form inputs to the formData Dropzone will POST
                        var data = $('#form-data').serializeArray();
                        $.each(data, function (key, el) {
                            formData.append(el.name, el.value);
                        });
                    });

                    this.on('success', function (file, response) {
                        blockLoading(false);
                        Swal.fire({
                            title: 'Berhasil',
                            text: 'Berhasil Menyimpan data...',
                            icon: 'success',
                            timer: 700
                        }).then(() => {
                            window.location.reload();
                        });
                    });

                    this.on('error', function (file, response) {
                        blockLoading(false);
                        Swal.fire({
                            title: 'Ooops',
                            text: 'Gagal Menyimpan Data...',
                            icon: 'error',
                            timer: 700
                        });
                        if (response['status'] === 400) {
                            const data = response['data'];
                            validateMessage(data, ['name', 'price']);
                        }
                    });

                    this.on('addedfile', function (file) {
                        if (this.files.length > 1) {
                            this.removeFile(this.files[0]);
                        }
                    });
                },
            })
        }

        $(document).ready(function () {
            $('#description').summernote({
                toolbar: [
                    ['para', ['ul', 'ol']],
                    ['table', ['table']],
                ]
            });
            setupDropzone();
        })
    </script>
@endsection



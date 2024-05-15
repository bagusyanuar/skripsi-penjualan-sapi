@extends('admin.layout')

@section('content')
    <div class="mb-3">
        <p class="content-title">New Product</p>
        <p class="content-sub-title">Create new data product</p>
    </div>
    <div class="card-content">
        <div class="w-100 mb-3">
            <label for="name" class="form-label input-label">Product Name</label>
            <input type="text" placeholder="product name" class="text-input" id="name"
                   name="name" aria-describedby="emailHelp">
        </div>
    </div>
@endsection

@extends('member.layout')

@section('content')
    <div class="w-100 d-flex justify-content-between align-items-center mb-3">
        <p class="page-title">Cart</p>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('member.home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Cart</li>
            </ol>
        </nav>
    </div>
@endsection

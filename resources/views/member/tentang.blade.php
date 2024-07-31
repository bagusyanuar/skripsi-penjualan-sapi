@extends('member.layout')

@section('content')
    <div class="main-content">
        <div class="w-100 d-flex justify-content-between align-items-center mb-3">
            <p class="page-title">Tentang Kami</p>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0" style="padding: 0 0;">
                    <li class="breadcrumb-item"><a href="{{ route('member.home') }}">Beranda</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tentang Kami</li>
                </ol>
            </nav>
        </div>
        <div class="w-100"style="min-height: 300px;">
            <p style="color: var(--dark); font-size: 1em; margin-bottom: 1rem; font-weight: 600;">Heli Farm</p>
            <p style="text-align: justify; font-size: 0.8em; color: var(--dark);">
                Heli Farm adalah peternakan terbesar dan terpercaya se solo raya.
            </p>
        </div>
    </div>
@endsection

@extends('layouts.app')
@section('title', 'Advanced Forms')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
@endpush
@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Advanced Forms</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Forms</a></div>
                    <div class="breadcrumb-item">Address</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Users</h2>



                <div class="card">
                    <div class="card-header">
                        <h4>Alamat untuk {{ $user->name }}</h4>

                    </div>
                    <div class="card-body">

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form method="POST" action="{{ route('address.save', $user->id) }}">
                            @csrf

                            <div class="form-group">
                                <label>Nama Penerima</label>
                                <input type="text" name="name" class="form-control"
                                    value="{{ old('name', $address->name ?? '') }}" required>
                            </div>

                            <div class="form-group">
                                <label>Nomor Telepon</label>
                                <input type="text" name="phone" class="form-control"
                                    value="{{ old('phone', $address->phone ?? '') }}" required>
                            </div>

                            <div class="form-group">
                                <label>Kode Pos</label>
                                <input type="text" name="postal_code" class="form-control"
                                    value="{{ old('postal_code', $address->postal_code ?? '') }}" required>
                            </div>

                            <div class="form-group">
                                <label>Alamat Lengkap</label>
                                <textarea name="full_address" class="form-control" rows="100" required>{{ old('full_address', $address->full_address ?? '') }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">Simpan Alamat</button>
                            <a class="btn btn-danger mt-3" href="/user">Kembali</a>

                        </form>
                    </div>
                </div>

            </div>
        </section>
    </div>
@endsection

@extends('layouts.app')

@section('title', 'Product Detail')

@push('style')
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Product Detail</h1>
                <div class="section-header-button">
                    <a href="{{ route('product.index') }}" class="btn btn-primary">Back to List</a>
                </div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Product</a></div>
                    <div class="breadcrumb-item">Detail</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Product Info</h4>
                            </div>
                            <div class="card-body">
                                <p><strong>Name:</strong> {{ $product->name }}</p>
                                <p><strong>Category:</strong> {{ $product->category->name ?? '-' }}</p>
                                <p><strong>Price:</strong> Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                                <p><strong>Stock:</strong> {{ $product->stock }}</p>
                                <p><strong>Standart:</strong> {{ $product->standart ?? '-' }}</p>
                                <p><strong>Hardness:</strong> {{ $product->hardness ?? '-' }}</p>
                                <p><strong>Strength:</strong> {{ $product->strength ?? '-' }}</p>
                                <p><strong>Machinability:</strong> {{ $product->machinability ?? '-' }}</p>
                                <p><strong>Characteristics:</strong> {{ $product->characteristics ?? '-' }}</p>
                                <p><strong>Usage:</strong> {{ $product->usage ?? '-' }}</p>
                                <p><strong>Available:</strong>
                                    <span class="badge badge-{{ $product->is_available ? 'success' : 'danger' }}">
                                        {{ $product->is_available ? 'Yes' : 'No' }}
                                    </span>
                                </p>
                                <p><strong>Created At:</strong> {{ $product->created_at->format('Y-m-d') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Product Image</h4>
                            </div>
                            <div class="card-body text-center">
                                @if ($product->image)
                                    <img src="{{ asset('storage/products/' . $product->image) }}"
                                        class="img-fluid img-thumbnail" style="max-height: 300px;">
                                @else
                                    <p>No image available.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
@endpush

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
                    {{-- KIRI: Product Info + Image --}}
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

                        <div class="card mt-3">
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

                    {{-- KANAN: Product Reviews --}}
                    <div class="col-12 col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Product Reviews</h4>
                            </div>
                            <div class="card-body">
                                @if ($product->reviews->isEmpty())
                                    <p class="text-muted">No reviews available for this product.</p>
                                @else
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>User</th>
                                                    <th>Rating</th>
                                                    <th>Review</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($product->reviews as $review)
                                                    <tr>
                                                        <td>{{ $review->user->name }}</td>
                                                        <td>
                                                            <span class="text-warning">
                                                                @php
                                                                    $fullStars = floor($review->point);
                                                                    $hasHalfStar = $review->point - $fullStars >= 0.5;
                                                                @endphp
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    @if ($i <= $fullStars)
                                                                        <i class="fas fa-star"></i>
                                                                    @elseif ($i == $fullStars + 1 && $hasHalfStar)
                                                                        <i class="fas fa-star-half-alt"></i>
                                                                    @else
                                                                        <i class="far fa-star"></i>
                                                                    @endif
                                                                @endfor
                                                            </span>
                                                            <small class="text-muted ml-2">({{ $review->point }})</small>
                                                        </td>
                                                        <td>{{ $review->review }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
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

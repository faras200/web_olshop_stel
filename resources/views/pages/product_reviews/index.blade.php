@extends('layouts.app')

@section('title', 'Product Reviews')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Product Reviews</h1>
                <div class="section-header-button">
                    <a href="{{ route('product-review.create') }}" class="btn btn-primary">Add New</a>
                </div>
            </div>

            <div class="section-body">
                @include('layouts.alert')
                <div class="card">
                    <div class="card-header">
                        <h4>Review List</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>User</th>
                                        <th>Point</th>
                                        <th>Review</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reviews as $review)
                                        <tr>
                                            <td>{{ $review->product->name }}</td>
                                            <td>{{ $review->user->name }}</td>
                                            <td>{{ $review->point }}
                                                @php
                                                    $fullStars = floor($review->point);
                                                    $hasHalfStar = $review->point - $fullStars >= 0.5;
                                                @endphp

                                                <span class="text-warning ml-1">
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

                                            </td>
                                            <td>{{ $review->review }}</td>
                                            <td>
                                                <a href="{{ route('product-review.show', $review) }}"
                                                    class="btn btn-sm btn-primary"><i class="fas fa-eye"></i>View</a>
                                                <a href="{{ route('product-review.edit', $review) }}"
                                                    class="btn btn-sm btn-info"><i class="fas fa-edit"></i>Edit</a>
                                                <form action="{{ route('product-review.destroy', $review) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Delete this review?')"><i
                                                            class="fas fa-times"></i>Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

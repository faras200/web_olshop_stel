@extends('layouts.app')

@section('title', 'Review Detail')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Review Detail</h1>
                <div class="section-header-back">
                    <a href="{{ route('product-review.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
            </div>

            <div class="section-body">
                <div class="card">
                    <div class="card-header">
                        <h4>Review Information</h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-2 font-weight-bold">Product</div>
                            <div class="col-sm-10">{{ $product_review->product->name }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-2 font-weight-bold">User</div>
                            <div class="col-sm-10">{{ $product_review->user->name }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-2 font-weight-bold">Point</div>
                            <div class="col-sm-10">{{ $product_review->point }}
                                @php
                                    $fullStars = floor($product_review->point);
                                    $hasHalfStar = $product_review->point - $fullStars >= 0.5;
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
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-2 font-weight-bold">Review</div>
                            <div class="col-sm-10">{{ $product_review->review }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

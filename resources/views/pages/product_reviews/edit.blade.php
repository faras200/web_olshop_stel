@extends('layouts.app')

@section('title', 'Edit Review')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Product Review</h1>
            </div>

            <div class="section-body">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('product-review.update', $product_review) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="product_id">Product</label>
                                <select name="product_id" id="product_id" class="form-control">
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}" @selected($product->id == $product_review->product_id)>
                                            {{ $product->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="user_id">User</label>
                                <select name="user_id" id="user_id" class="form-control">
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}" @selected($user->id == $product_review->user_id)>{{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="point">Point</label>
                                <input type="number" step="0.1" name="point" id="point" class="form-control"
                                    value="{{ $product_review->point }}">
                            </div>
                            <div class="form-group">
                                <label for="review">Review</label>
                                <textarea name="review" id="review" rows="4" class="form-control">{{ $product_review->review }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

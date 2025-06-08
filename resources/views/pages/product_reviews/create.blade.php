@extends('layouts.app')

@section('title', 'Create Review')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Create Product Review</h1>
            </div>

            <div class="section-body">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('product-review.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="product_id">Product</label>
                                <select name="product_id" id="product_id" class="form-control">
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="user_id">User</label>
                                <select name="user_id" id="user_id" class="form-control">
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="point">Point</label>
                                <input type="number" step="0.1" name="point" id="point" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="review">Review</label>
                                <textarea name="review" id="review" rows="4" class="form-control"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

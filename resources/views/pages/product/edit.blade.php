@extends('layouts.app')

@section('title', 'Edit Product')

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
                <h1>Edit Product</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Forms</a></div>
                    <div class="breadcrumb-item">Product</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Product</h2>



                <div class="card">
                    <form action="{{ route('product.update', $product) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                            <h4>Edit Product</h4>
                        </div>
                        <div class="card-body">
                            {{-- Name --}}
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name', $product->name) }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Description --}}
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description">{{ old('description', $product->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Price --}}
                            <div class="form-group">
                                <label>Price</label>
                                <input type="number" class="form-control @error('price') is-invalid @enderror"
                                    name="price" value="{{ old('price', $product->price) }}">
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Stock --}}
                            <div class="form-group">
                                <label>Stock</label>
                                <input type="number" class="form-control @error('stock') is-invalid @enderror"
                                    name="stock" value="{{ old('stock', $product->stock) }}">
                                @error('stock')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Category --}}
                            <div class="form-group">
                                <label class="form-label">Category</label>
                                <select class="form-control selectric @error('category_id') is-invalid @enderror"
                                    name="category_id">
                                    <option value="">-- Select Category --</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Standart --}}
                            <div class="form-group">
                                <label>Standart</label>
                                <input type="text" class="form-control" name="standart"
                                    value="{{ old('standart', $product->standart) }}">
                            </div>

                            {{-- Hardness --}}
                            <div class="form-group">
                                <label>Hardness</label>
                                <input type="text" class="form-control" name="hardness"
                                    value="{{ old('hardness', $product->hardness) }}">
                            </div>

                            {{-- Strength --}}
                            <div class="form-group">
                                <label>Strength</label>
                                <input type="text" class="form-control" name="strength"
                                    value="{{ old('strength', $product->strength) }}">
                            </div>

                            {{-- Machinability --}}
                            <div class="form-group">
                                <label>Machinability</label>
                                <input type="text" class="form-control" name="machinability"
                                    value="{{ old('machinability', $product->machinability) }}">
                            </div>

                            {{-- Characteristics --}}
                            <div class="form-group">
                                <label>Characteristics</label>
                                <textarea class="form-control" name="characteristics">{{ old('characteristics', $product->characteristics) }}</textarea>
                            </div>

                            {{-- Usage --}}
                            <div class="form-group">
                                <label>Usage</label>
                                <textarea class="form-control" name="usage">{{ old('usage', $product->usage) }}</textarea>
                            </div>

                            {{-- Is Available --}}
                            <div class="form-group">
                                <label>Available?</label>
                                <select class="form-control" name="is_available">
                                    <option value="1"
                                        {{ old('is_available', $product->is_available) == '1' ? 'selected' : '' }}>Yes
                                    </option>
                                    <option value="0"
                                        {{ old('is_available', $product->is_available) == '0' ? 'selected' : '' }}>No
                                    </option>
                                </select>
                            </div>

                            {{-- Image --}}
                            <div class="form-group">
                                <label>Photo Product</label>
                                <div class="mb-2">
                                    @if ($product->image)
                                        <img src="{{ asset('storage/products/' . $product->image) }}" width="100"
                                            class="img-thumbnail">
                                    @endif
                                </div>
                                <input type="file" class="form-control @error('image') is-invalid @enderror"
                                    name="image">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </form>

                </div>

            </div>
        </section>
    </div>
@endsection

@push('scripts')
@endpush

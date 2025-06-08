<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductReview;
use App\Http\Controllers\Controller;

class ProductReviewController extends Controller
{
    public function index()
    {
        $reviews = ProductReview::with(['product', 'user'])->latest()->get();
        return view('pages.product_reviews.index', compact('reviews'));
    }

    public function create()
    {
        $products = Product::all();
        $users = User::all();
        return view('pages.product_reviews.create', compact('products', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'user_id' => 'required|exists:users,id',
            'point' => 'required|numeric|min:0|max:5',
            'review' => 'required|string',
        ]);

        ProductReview::create($request->all());

        return redirect()->route('product-review.index')->with('success', 'Review created successfully.');
    }

    public function show(ProductReview $product_review)
    {
        return view('pages.product_reviews.show', compact('product_review'));
    }

    public function edit(ProductReview $product_review)
    {
        $products = Product::all();
        $users = User::all();
        return view('pages.product_reviews.edit', compact('product_review', 'products', 'users'));
    }

    public function update(Request $request, ProductReview $product_review)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'user_id' => 'required|exists:users,id',
            'point' => 'required|numeric|min:0|max:5',
            'review' => 'required|string',
        ]);

        $product_review->update($request->all());

        return redirect()->route('product-review.index')->with('success', 'Review updated successfully.');
    }

    public function destroy(ProductReview $product_review)
    {
        $product_review->delete();

        return redirect()->route('product-review.index')->with('success', 'Review deleted successfully.');
    }
}

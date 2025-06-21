<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\ProductReview;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class ProductReviewController extends Controller
{
    // GET: /api/product-reviews
    public function index(Request $request): JsonResponse
    {
        $query = ProductReview::with(['product', 'user']); // eager loading

        if (!empty($request->product_id)) {
            $query->where('product_id', $request->product_id);
        }

        if (!empty($request->user_id)) {
            $query->where('user_id', $request->user_id);
        }

        $reviews = $query->orderBy('created_at', 'desc')->get()->map(function ($review) {
            return [
                'id'         => $review->id,
                'product_id' => $review->product_id,
                'product_name' => $review->product->name ?? null,
                'product_image' => $review->product->image ?? null,
                'user_id'    => $review->user_id,
                'user_name'  => $review->user->name ?? null,
                'point'      => $review->point,
                'review'     => $review->review,
                'created_at' => $review->created_at,
                'updated_at' => $review->updated_at,
            ];
        });

        return response()->json([
            'message' => 'Success',
            'data' => $reviews
        ], 200);
    }

    // POST: /api/product-reviews
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'product_id' => 'required',
            'user_id'    => 'required',
            'point'      => 'required|min:1|max:5',
            'review'     => 'string',
        ]);

        // Cek apakah user sudah memberikan review untuk produk ini dalam 24 jam terakhir
        $alreadyReviewed = ProductReview::where('product_id', $validated['product_id'])
            ->where('user_id', $validated['user_id'])
            ->where('created_at', '>=', Carbon::now()->subDay()) // 24 jam terakhir
            ->exists();

        if ($alreadyReviewed) {
            return response()->json('Anda sudah memberikan review. Silakan beri review lagi nanti', 429); // 429 Too Many Requests
        }

        $review = ProductReview::create($validated);
        return response()->json($review, 201);
    }

    // GET: /api/product-reviews/{id}
    public function show($id): JsonResponse
    {
        $review = ProductReview::find($id);

        if (!$review) {
            return response()->json(['message' => 'Review not found'], 404);
        }

        return response()->json($review);
    }

    // PUT/PATCH: /api/product-reviews/{id}
    public function update(Request $request, $id): JsonResponse
    {
        $review = ProductReview::find($id);

        if (!$review) {
            return response()->json(['message' => 'Review not found'], 404);
        }

        $validated = $request->validate([
            'product_id' => 'sometimes|integer|exists:products,id',
            'user_id'    => 'sometimes|integer|exists:users,id',
            'point'      => 'sometimes|integer|min:1|max:5',
            'review'     => 'sometimes|string',
        ]);

        $review->update($validated);

        return response()->json($review);
    }

    // DELETE: /api/product-reviews/{id}
    public function destroy($id): JsonResponse
    {
        $review = ProductReview::find($id);

        if (!$review) {
            return response()->json(['message' => 'Review not found'], 404);
        }

        $review->delete();

        return response()->json(['message' => 'Review deleted']);
    }
}

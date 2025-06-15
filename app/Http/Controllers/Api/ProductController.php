<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // get products get all or search by category_id pagination
        // $products = Product::with('category')->when($request->category_id, function ($query) use ($request) {
        //     return $query->where('category_id', $request->category_id);
        // })
        //     ->paginate(10);

        $products = Product::select(
            'products.*',
            'categories.name as category_name',
            'categories.description as category_description',
            DB::raw('ROUND(AVG(product_reviews.point), 1) as average_rating')
        )
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->leftJoin('product_reviews', 'products.id', '=', 'product_reviews.product_id')
            ->groupBy('products.id')
            ->when($request->category_id, function ($query) use ($request) {
                return $query->where('products.category_id', $request->category_id);
            })
            ->when($request->sort_by === 'top_rating', function ($query) {
                return $query->orderByDesc('average_rating');
            })
            ->when($request->sort_by === 'lowest_rating', function ($query) {
                return $query->orderBy('average_rating');
            })
            ->paginate(10);

        return response()->json([
            'message' => 'Success',
            'data' => $products
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //index
    public function index()
    {
        $products = \App\Models\Product::paginate(5);
        return view('pages.product.index', compact('products'));
    }

    //create
    public function create()
    {
        $categories = \App\Models\Category::all();
        return view('pages.product.create', compact('categories'));
    }

    //store
    public function store(Request $request)
    {
        $filename = time() . '.' . $request->image->extension();
        $request->image->storeAs('public/products', $filename);
        // $data = $request->all();

        $product = new \App\Models\Product;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = (int) $request->price;
        $product->stock = (int) $request->stock;
        $product->category_id = $request->category_id;
        $product->standart = $request->standart;
        $product->hardness = $request->hardness;
        $product->strength = $request->strength;
        $product->machinability = $request->machinability;
        $product->characteristics = $request->characteristics;
        $product->usage = $request->usage;
        $product->is_available = $request->is_available ?? 0;
        $product->image = $filename;
        $product->save();

        return redirect()->route('product.index');
    }

    //edit
    public function edit($id)
    {
        $product = \App\Models\Product::findOrFail($id);
        $categories = \App\Models\Category::all();
        return view('pages.product.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = \App\Models\Product::findOrFail($id);

        // Handle image upload
        if ($request->hasFile('image')) {
            $filename = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/products', $filename);
            $product->image = $filename;
        } else {
            $filename = $product->image;
        }

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => (int) $request->price,
            'stock' => (int) $request->stock,
            'category_id' => $request->category_id,
            'standart' => $request->standart,
            'hardness' => $request->hardness,
            'strength' => $request->strength,
            'machinability' => $request->machinability,
            'characteristics' => $request->characteristics,
            'usage' => $request->usage,
            'is_available' => $request->is_available ?? 0, // default to 0 if null
            'image' => $filename
        ]);

        return redirect()->route('product.index')->with('success', 'Product updated successfully');
    }

    public function show(Product $product)
    {
        $product->load('category', 'reviews.user'); // pastikan relasi `reviews` dan `user` ada
        return view('pages.product.show', compact('product'));
    }

    //destroy
    public function destroy($id)
    {
        $product = \App\Models\Product::findOrFail($id);
        $product->delete();

        return redirect()->route('product.index')->with('success', 'Product deleted successfully');
    }
}

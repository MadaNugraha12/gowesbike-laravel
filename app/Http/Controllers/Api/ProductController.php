<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();

        return ProductResource::collection($products);
    }

    public function show(int $id)
    {
        $product = Product::with('category')->findOrFail($id);

        return new ProductResource($product);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'groupset' => 'nullable|string|max:255',
            'brakes' => 'nullable|string|max:255',
            'wheelset' => 'nullable|string|max:255',
            'tires' => 'nullable|string|max:255',
            'crankset' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')
                ->store('products', 'public');
        }

        $product = Product::create($validated);

        return new ProductResource($product->load('category'));
    }

    public function update(Request $request, int $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'groupset' => 'nullable|string|max:255',
            'brakes' => 'nullable|string|max:255',
            'wheelset' => 'nullable|string|max:255',
            'tires' => 'nullable|string|max:255',
            'crankset' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $validated['image'] = $request->file('image')
                ->store('products', 'public');
        }

        $product->update($validated);

        return new ProductResource($product->load('category'));
    }

    public function destroy(Product $product)
    {
        $hasOrders = DB::table('order_details')
            ->where('product_id', $product->id)
            ->exists();

        if ($hasOrders) {
            $product->delete();

            return response()->json([
                'message' => 'Produk berhasil disembunyikan karena memiliki riwayat pesanan.'
            ]);
        }

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->forceDelete();

        return response()->json([
            'message' => 'Produk berhasil dihapus permanen.'
        ]);
    }
}

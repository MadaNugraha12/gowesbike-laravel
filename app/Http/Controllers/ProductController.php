<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $search = request('search');
        $categoryId = request('category_id');

        $products = Product::query();

        // Search berdasarkan nama, brand, atau deskripsi
        if ($search) {
            $products->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                      ->orWhere('brand', 'like', '%' . $search . '%')
                      ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        // Filter berdasarkan kategori
        if ($categoryId) {
            $products->where('category_id', $categoryId);
        }

        // Pagination 6 produk per halaman
        $products = $products->paginate(6)->withQueryString();

        $categories = \App\Models\Category::all();

        return view('products', compact(
            'products',
            'categories',
            'categoryId',
            'search'
        ));
    }

    public function create()
    {
        $categories = \App\Models\Category::all();

        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'brand' => 'required',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'description' => 'required',
            'groupset' => 'nullable',
            'brakes' => 'nullable',
            'wheelset' => 'nullable',
            'tires' => 'nullable',
            'crankset' => 'nullable',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'name' => $request->name,
            'brand' => $request->brand,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'description' => $request->description,
            'groupset' => $request->groupset,
            'brakes' => $request->brakes,
            'wheelset' => $request->wheelset,
            'tires' => $request->tires,
            'crankset' => $request->crankset,
            'image' => $imagePath,
        ]);

        return redirect()
            ->route('products.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);

        $categories = \App\Models\Category::all();

        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'brand' => 'required',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'description' => 'required',
            'groupset' => 'nullable',
            'brakes' => 'nullable',
            'wheelset' => 'nullable',
            'tires' => 'nullable',
            'crankset' => 'nullable',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $product = Product::findOrFail($id);

        $imagePath = $product->image;

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $imagePath = $request->file('image')->store('products', 'public');
        }

        $product->update([
            'name' => $request->name,
            'brand' => $request->brand,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'description' => $request->description,
            'groupset' => $request->groupset,
            'brakes' => $request->brakes,
            'wheelset' => $request->wheelset,
            'tires' => $request->tires,
            'crankset' => $request->crankset,
            'image' => $imagePath,
        ]);

        return redirect()
            ->route('products.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('product-detail', compact('product'));
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}
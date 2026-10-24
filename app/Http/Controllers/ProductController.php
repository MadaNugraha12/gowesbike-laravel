<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

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
        ]);

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
        ]);

        $product = Product::findOrFail($id);

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

        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}
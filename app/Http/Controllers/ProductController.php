<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $search = request('search');
        $categoryId = request('category_id');

        $productsQuery = Product::query();

        if ($search) {
            $productsQuery->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('brand', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        if ($categoryId) {
            $productsQuery->where('category_id', $categoryId);
        }

        /** @var LengthAwarePaginator $products */
        $products = $productsQuery->paginate(6);
        $products->withQueryString();

        $categories = Category::all();

        return view('products', compact(
            'products',
            'categories',
            'categoryId',
            'search'
        ));
    }

    public function create()
    {
        $categories = Category::all();

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

    public function edit(int $id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, int $id)
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

    public function show(int $id)
    {
        $product = Product::findOrFail($id);

        return view('product-detail', compact('product'));
    }

    public function destroy(int $id)
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

<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Menampilkan isi keranjang.
     */
    public function index()
    {
        $cart = session()->get('cart', []);

        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('cart', compact('cart', 'total'));
    }


    /**
     * Menambahkan produk ke keranjang.
     */
    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {

            $cart[$id]['quantity']++;

        } else {

            $cart[$id] = [
                'name' => $product->name,
                'brand' => $product->brand,
                'price' => $product->price,
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);

        return redirect()
            ->route('cart.index')
            ->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }


    /**
     * Mengubah jumlah produk di keranjang.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = session()->get('cart', []);

        if (!isset($cart[$id])) {

            return redirect()
                ->route('cart.index')
                ->with('error', 'Produk tidak ditemukan di keranjang.');
        }

        $cart[$id]['quantity'] = $request->quantity;

        session()->put('cart', $cart);

        return redirect()
            ->route('cart.index')
            ->with('success', 'Jumlah produk berhasil diperbarui.');
    }


    /**
     * Menghapus produk dari keranjang.
     */
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (!isset($cart[$id])) {

            return redirect()
                ->route('cart.index')
                ->with('error', 'Produk tidak ditemukan di keranjang.');
        }

        unset($cart[$id]);

        session()->put('cart', $cart);

        return redirect()
            ->route('cart.index')
            ->with('success', 'Produk berhasil dihapus dari keranjang.');
    }
}
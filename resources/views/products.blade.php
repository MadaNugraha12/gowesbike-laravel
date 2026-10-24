@extends('layouts.app')

@section('title', 'Products - GowesBike')

@section('styles')

<style>
    .products-section {
        max-width: 1200px;
        margin: 0 auto;
        padding: 60px 20px;
    }

    .products-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .products-header h1 {
        font-size: 36px;
        margin-bottom: 10px;
    }

    .products-header p {
        color: #666;
        margin-bottom: 20px;
    }

    .add-product-button {
        display: inline-block;
        padding: 12px 20px;
        background: #111;
        color: white;
        text-decoration: none;
        border-radius: 8px;
        font-weight: 600;
    }

    .add-product-button:hover {
        opacity: 0.85;
    }

    .search-filter {
        margin-top: 25px;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .search-input {
        padding: 12px 16px;
        width: 300px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 14px;
        box-sizing: border-box;
    }

    .search-button {
        padding: 12px 18px;
        background: #111;
        color: white;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
    }

    .search-button:hover {
        opacity: 0.85;
    }

    .category-filter {
        margin-top: 15px;
    }

    .category-select {
        padding: 12px 16px;
        border: 1px solid #ddd;
        border-radius: 8px;
        min-width: 220px;
        background: white;
        font-size: 14px;
        cursor: pointer;
    }

    .success-message {
        max-width: 1200px;
        margin: 0 auto 25px auto;
        padding: 15px 20px;
        background: #e8f8ed;
        border: 1px solid #a8dfb8;
        color: #176b2c;
        border-radius: 8px;
    }

    .product-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 25px;
    }

    .product-card {
        background: white;
        border: 1px solid #e5e5e5;
        border-radius: 14px;
        padding: 25px;
        transition: 0.2s;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
    }

    .product-link {
        display: block;
        text-decoration: none;
        color: inherit;
    }

    .product-brand {
        font-size: 13px;
        font-weight: bold;
        color: #777;
        letter-spacing: 1px;
    }

    .product-category {
        display: inline-block;
        margin-top: 8px;
        padding: 5px 10px;
        background: #f1f1f1;
        color: #555;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .product-name {
        font-size: 22px;
        margin: 10px 0;
    }

    .product-description {
        color: #666;
        line-height: 1.6;
        min-height: 70px;
    }

    .product-price {
        font-size: 20px;
        font-weight: bold;
        margin-top: 20px;
    }

    .product-actions {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-top: 15px;
    }

    .product-actions form {
        margin: 0;
    }

    .edit-button {
        display: inline-block;
        padding: 9px 16px;
        background: #eee;
        color: #111;
        text-decoration: none;
        border-radius: 7px;
        font-size: 14px;
        font-weight: 600;
    }

    .edit-button:hover {
        background: #ddd;
    }

    .delete-button {
        padding: 9px 16px;
        background: #ffe5e5;
        color: #b00020;
        border: 1px solid #ffb5b5;
        border-radius: 7px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
    }

    .delete-button:hover {
        background: #ffd5d5;
    }

    .no-products {
        grid-column: 1 / -1;
        text-align: center;
        padding: 50px 20px;
        color: #666;
        background: #fafafa;
        border: 1px solid #eee;
        border-radius: 12px;
    }

    /* Pagination */

    .pagination {
        margin-top: 40px;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    .pagination a,
    .pagination span {
        display: inline-block;
        padding: 10px 15px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 14px;
    }

    .pagination a {
        border: 1px solid #ddd;
        color: #111;
        background: white;
    }

    .pagination a:hover {
        background: #f1f1f1;
    }

    .pagination .active {
        background: #111;
        color: white;
        border: 1px solid #111;
    }

    .pagination .disabled {
        border: 1px solid #ddd;
        color: #aaa;
        background: #f5f5f5;
    }

    @media (max-width: 900px) {
        .product-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 600px) {

        .products-section {
            padding: 40px 15px;
        }

        .products-header h1 {
            font-size: 30px;
        }

        .product-grid {
            grid-template-columns: 1fr;
        }

        .search-input {
            width: 100%;
        }

        .search-button {
            width: 100%;
        }

        .category-select {
            width: 100%;
        }

        .product-actions {
            flex-direction: column;
            align-items: stretch;
        }

        .edit-button,
        .delete-button {
            width: 100%;
            box-sizing: border-box;
            text-align: center;
        }
    }
</style>

@endsection


@section('content')

<section class="products-section">

    <div class="products-header">

        <h1>GowesBike Products</h1>

        <p>
            Pilih road bike terbaik untuk kebutuhan Anda.
        </p>

        <a
            href="{{ route('products.create') }}"
            class="add-product-button"
        >
            + Tambah Produk
        </a>


        {{-- Search --}}

        <form
            action="{{ route('products.index') }}"
            method="GET"
            class="search-filter"
        >

            <input
                type="text"
                name="search"
                value="{{ $search }}"
                placeholder="Cari nama, brand, atau deskripsi..."
                class="search-input"
            >

            {{-- Menjaga filter kategori ketika melakukan search --}}

            @if ($categoryId)

                <input
                    type="hidden"
                    name="category_id"
                    value="{{ $categoryId }}"
                >

            @endif

            <button
                type="submit"
                class="search-button"
            >
                Cari
            </button>

        </form>


        {{-- Filter Kategori --}}

        <form
            action="{{ route('products.index') }}"
            method="GET"
            class="category-filter"
        >

            {{-- Menjaga search ketika memilih kategori --}}

            @if ($search)

                <input
                    type="hidden"
                    name="search"
                    value="{{ $search }}"
                >

            @endif

            <select
                name="category_id"
                onchange="this.form.submit()"
                class="category-select"
            >

                <option value="">
                    Semua Kategori
                </option>

                @foreach ($categories as $category)

                    <option
                        value="{{ $category->id }}"
                        {{ $categoryId == $category->id ? 'selected' : '' }}
                    >
                        {{ $category->name }}
                    </option>

                @endforeach

            </select>

        </form>

    </div>


    {{-- Pesan sukses --}}

    @if (session('success'))

        <div class="success-message">
            {{ session('success') }}
        </div>

    @endif


    {{-- Daftar Produk --}}

    <div class="product-grid">

        @forelse ($products as $product)

            <div class="product-card">

                <a
                    href="{{ route('products.show', $product->id) }}"
                    class="product-link"
                >

                    <div class="product-brand">
                        {{ $product->brand }}
                    </div>


                    {{-- Kategori Produk --}}

                    @if ($product->category)

                        <div class="product-category">
                            {{ $product->category->name }}
                        </div>

                    @endif


                    <h2 class="product-name">
                        {{ $product->name }}
                    </h2>


                    <p class="product-description">
                        {{ $product->description }}
                    </p>


                    <div class="product-price">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </div>

                </a>


                {{-- Tombol Edit dan Hapus --}}

                <div class="product-actions">

                    <a
                        href="{{ route('products.edit', $product->id) }}"
                        class="edit-button"
                    >
                        Edit
                    </a>


                    <form
                        action="{{ route('products.destroy', $product->id) }}"
                        method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus produk ini?')"
                    >

                        @csrf

                        @method('DELETE')

                        <button
                            type="submit"
                            class="delete-button"
                        >
                            Hapus
                        </button>

                    </form>

                </div>

            </div>

        @empty

            <div class="no-products">

                <h3>Produk tidak ditemukan</h3>

                <p>
                    Coba gunakan kata pencarian atau kategori yang berbeda.
                </p>

            </div>

        @endforelse

    </div>


    {{-- Pagination --}}

    @if ($products->hasPages())

        <div class="pagination">

            {{-- Previous --}}

            @if ($products->onFirstPage())

                <span class="disabled">
                    Previous
                </span>

            @else

                <a href="{{ $products->previousPageUrl() }}">
                    Previous
                </a>

            @endif


            {{-- Nomor halaman --}}

            @for ($page = 1; $page <= $products->lastPage(); $page++)

                @if ($page == $products->currentPage())

                    <span class="active">
                        {{ $page }}
                    </span>

                @else

                    <a href="{{ $products->url($page) }}">
                        {{ $page }}
                    </a>

                @endif

            @endfor


            {{-- Next --}}

            @if ($products->hasMorePages())

                <a href="{{ $products->nextPageUrl() }}">
                    Next
                </a>

            @else

                <span class="disabled">
                    Next
                </span>

            @endif

        </div>

    @endif

</section>

@endsection
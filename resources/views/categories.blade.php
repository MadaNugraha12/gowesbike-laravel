@extends('layouts.app')

@section('title', 'Categories - GowesBike')

@section('styles')

<style>
    .categories-section {
        max-width: 1000px;
        margin: 0 auto;
        padding: 60px 20px;
    }

    .categories-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .categories-header h1 {
        font-size: 36px;
        margin-bottom: 10px;
    }

    .categories-header p {
        color: #666;
        margin-bottom: 20px;
    }

    .add-category-button {
        display: inline-block;
        padding: 12px 20px;
        background: #111;
        color: white;
        text-decoration: none;
        border-radius: 8px;
        font-weight: 600;
    }

    .add-category-button:hover {
        opacity: 0.85;
    }

    .success-message {
        margin-bottom: 25px;
        padding: 15px 20px;
        background: #e8f8ed;
        border: 1px solid #a8dfb8;
        color: #176b2c;
        border-radius: 8px;
    }

    .category-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    .category-card {
        background: white;
        border: 1px solid #e5e5e5;
        border-radius: 14px;
        padding: 25px;
        transition: 0.2s;
    }

    .category-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
    }

    .category-name {
        font-size: 24px;
        margin-bottom: 10px;
    }

    .category-description {
        color: #666;
        line-height: 1.6;
        min-height: 50px;
    }

    .category-product-count {
        margin-top: 15px;
        font-size: 14px;
        color: #777;
    }

    .category-actions {
        display: flex;
        gap: 10px;
        margin-top: 20px;
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

    @media (max-width: 700px) {
        .category-grid {
            grid-template-columns: 1fr;
        }

        .category-actions {
            flex-direction: column;
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

<section class="categories-section">

    <div class="categories-header">

        <h1>GowesBike Categories</h1>

        <p>
            Kelola kategori produk GowesBike.
        </p>

        <a
            href="{{ route('categories.create') }}"
            class="add-category-button"
        >
            + Tambah Kategori
        </a>

    </div>

    @if (session('success'))

        <div class="success-message">
            {{ session('success') }}
        </div>

    @endif

    <div class="category-grid">

        @foreach ($categories as $category)

            <div class="category-card">

                <h2 class="category-name">
                    {{ $category->name }}
                </h2>

                <p class="category-description">
                    {{ $category->description ?? 'Tidak ada deskripsi.' }}
                </p>

                <div class="category-product-count">
                    {{ $category->products->count() }} produk
                </div>

                <div class="category-actions">

                    <a
                        href="{{ route('categories.edit', $category->id) }}"
                        class="edit-button"
                    >
                        Edit
                    </a>

                    <form
                        action="{{ route('categories.destroy', $category->id) }}"
                        method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus kategori ini?')"
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

        @endforeach

    </div>

</section>

@endsection

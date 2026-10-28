@extends('layouts.app')

@section('title', 'Edit Produk - GowesBike')

@section('content')

<div class="form-container">

    <div class="form-header">
        <h1>Edit Produk</h1>
        <p>Perbarui informasi produk GowesBike.</p>
    </div>

    @if ($errors->any())
        <div class="error-box">
            <strong>Terjadi kesalahan:</strong>

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nama Produk</label>

            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name', $product->name) }}"
                placeholder="Contoh: Trek Émonda SL 5"
            >
        </div>

        <div class="form-group">
            <label for="brand">Brand</label>

            <input
                type="text"
                id="brand"
                name="brand"
                value="{{ old('brand', $product->brand) }}"
                placeholder="Contoh: TREK"
            >
        </div>

        <div class="form-group">
            <label for="category_id">Kategori</label>

            <select id="category_id" name="category_id">

                <option value="">-- Pilih Kategori --</option>

                @foreach ($categories as $category)

                    <option
                        value="{{ $category->id }}"
                        {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}
                    >
                        {{ $category->name }}
                    </option>

                @endforeach

            </select>
        </div>

        <div class="form-group">
            <label for="price">Harga</label>

            <input
                type="number"
                id="price"
                name="price"
                value="{{ old('price', $product->price) }}"
                placeholder="Contoh: 42000000"
            >
        </div>

        <div class="form-group">
            <label for="description">Deskripsi</label>

            <textarea
                id="description"
                name="description"
                rows="5"
                placeholder="Deskripsi produk..."
            >{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="form-group">
            <label for="image">Gambar Produk</label>

            @if ($product->image)
                <div style="margin-bottom: 12px;">
                    <img
                        src="{{ asset('storage/' . $product->image) }}"
                        alt="{{ $product->name }}"
                        style="width: 180px; height: 120px; object-fit: cover; border-radius: 8px;"
                    >
                </div>

                <small style="display: block; margin-bottom: 8px; color: #777;">
                    Gambar saat ini. Pilih gambar baru jika ingin menggantinya.
                </small>
            @endif

            <input
                type="file"
                id="image"
                name="image"
                accept=".jpg,.jpeg,.png,.webp"
            >

            <small>
                Format: JPG, JPEG, PNG, WEBP. Maksimal 2 MB.
            </small>
        </div>

        <div class="spec-grid">

            <div class="form-group">
                <label for="groupset">Groupset</label>

                <input
                    type="text"
                    id="groupset"
                    name="groupset"
                    value="{{ old('groupset', $product->groupset) }}"
                >
            </div>

            <div class="form-group">
                <label for="brakes">Brakes</label>

                <input
                    type="text"
                    id="brakes"
                    name="brakes"
                    value="{{ old('brakes', $product->brakes) }}"
                >
            </div>

            <div class="form-group">
                <label for="wheelset">Wheelset</label>

                <input
                    type="text"
                    id="wheelset"
                    name="wheelset"
                    value="{{ old('wheelset', $product->wheelset) }}"
                >
            </div>

            <div class="form-group">
                <label for="tires">Tires</label>

                <input
                    type="text"
                    id="tires"
                    name="tires"
                    value="{{ old('tires', $product->tires) }}"
                >
            </div>

            <div class="form-group">
                <label for="crankset">Crankset</label>

                <input
                    type="text"
                    id="crankset"
                    name="crankset"
                    value="{{ old('crankset', $product->crankset) }}"
                >
            </div>

        </div>

        <div class="form-actions">

            <a
                href="{{ route('products.index') }}"
                class="btn-cancel"
            >
                Batal
            </a>

            <button
                type="submit"
                class="btn-submit"
            >
                Update Produk
            </button>

        </div>

    </form>

</div>

@endsection

@section('styles')

<style>

    .form-container {
        max-width: 850px;
        margin: 0 auto;
        padding: 60px 20px;
    }

    .form-header {
        margin-bottom: 30px;
    }

    .form-header h1 {
        font-size: 36px;
        margin-bottom: 8px;
    }

    .form-header p {
        color: #666;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .form-group input,
    .form-group textarea,
    .form-group select {
        width: 100%;
        box-sizing: border-box;
        padding: 12px 14px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 15px;
        font-family: inherit;
        background: white;
    }

    .form-group textarea {
        resize: vertical;
    }

    .form-group input:focus,
    .form-group textarea:focus,
    .form-group select:focus {
        outline: none;
        border-color: #111;
    }

    .form-group small {
        color: #777;
        font-size: 13px;
    }

    .spec-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0 20px;
    }

    .error-box {
        background: #ffecec;
        border: 1px solid #ffb5b5;
        color: #a40000;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 25px;
    }

    .error-box ul {
        margin: 8px 0 0 20px;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        margin-top: 30px;
    }

    .btn-cancel,
    .btn-submit {
        padding: 12px 20px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 15px;
        cursor: pointer;
    }

    .btn-cancel {
        border: 1px solid #ddd;
        color: #333;
        background: white;
    }

    .btn-submit {
        border: none;
        background: #111;
        color: white;
    }

    @media (max-width: 600px) {

        .spec-grid {
            grid-template-columns: 1fr;
        }

        .form-actions {
            flex-direction: column;
        }

        .btn-cancel,
        .btn-submit {
            text-align: center;
        }

    }

</style>

@endsection
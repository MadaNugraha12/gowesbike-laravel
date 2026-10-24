@extends('layouts.app')

@section('title', 'Edit Kategori - GowesBike')

@section('content')

<div class="form-container">

    <div class="form-header">
        <h1>Edit Kategori</h1>

        <p>
            Perbarui informasi kategori GowesBike.
        </p>
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

    <form
        action="{{ route('categories.update', $category->id) }}"
        method="POST"
    >

        @csrf
        @method('PUT')

        <div class="form-group">

            <label for="name">
                Nama Kategori
            </label>

            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name', $category->name) }}"
                placeholder="Contoh: Racing"
            >

        </div>

        <div class="form-group">

            <label for="description">
                Deskripsi
            </label>

            <textarea
                id="description"
                name="description"
                rows="5"
                placeholder="Deskripsi kategori..."
            >{{ old('description', $category->description) }}</textarea>

        </div>

        <div class="form-actions">

            <a
                href="{{ route('categories.index') }}"
                class="btn-cancel"
            >
                Batal
            </a>

            <button
                type="submit"
                class="btn-submit"
            >
                Update Kategori
            </button>

        </div>

    </form>

</div>

@endsection

@section('styles')

<style>

    .form-container {
        max-width: 700px;
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
    .form-group textarea {
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
    .form-group textarea:focus {
        outline: none;
        border-color: #111;
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

    .btn-cancel:hover {
        background: #f5f5f5;
    }

    .btn-submit:hover {
        opacity: 0.85;
    }

    @media (max-width: 600px) {

        .form-actions {
            flex-direction: column;
        }

        .btn-cancel,
        .btn-submit {
            width: 100%;
            box-sizing: border-box;
            text-align: center;
        }

    }

</style>

@endsection
@extends('layouts.app')

@section('title', 'Checkout - GowesBike')

@section('styles')

<style>
    .checkout-section {
        max-width: 1100px;
        margin: 0 auto;
        padding: 60px 20px;
    }

    .checkout-header {
        margin-bottom: 40px;
    }

    .checkout-header h1 {
        font-size: 36px;
        margin-bottom: 10px;
    }

    .checkout-header p {
        color: #666;
    }

    .checkout-container {
        display: grid;
        grid-template-columns: 1.3fr 0.7fr;
        gap: 30px;
        align-items: start;
    }

    /* FORM */

    .checkout-form {
        background: white;
        padding: 30px;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
    }

    .checkout-form h2 {
        font-size: 22px;
        margin-bottom: 25px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 12px 14px;

        border: 1px solid #d1d5db;
        border-radius: 8px;

        font-family: inherit;
        font-size: 15px;
    }

    .form-group textarea {
        min-height: 120px;
        resize: vertical;
    }

    .form-group input:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #2563eb;
    }

    .error-message {
        margin-top: 6px;
        color: #dc2626;
        font-size: 13px;
    }

    .checkout-button {
        width: 100%;

        border: none;
        background: #2563eb;
        color: white;

        padding: 15px;

        border-radius: 8px;

        font-size: 16px;
        font-weight: 700;

        cursor: pointer;
    }

    .checkout-button:hover {
        background: #1d4ed8;
    }

    /* ORDER SUMMARY */

    .order-summary {
        background: white;
        padding: 30px;

        border: 1px solid #e5e7eb;
        border-radius: 12px;
    }

    .order-summary h2 {
        font-size: 22px;
        margin-bottom: 25px;
    }

    .summary-item {
        padding: 15px 0;
        border-bottom: 1px solid #e5e7eb;
    }

    .summary-item-name {
        font-weight: 600;
        margin-bottom: 5px;
    }

    .summary-item-info {
        color: #666;
        font-size: 14px;
    }

    .summary-item-price {
        margin-top: 8px;
        font-weight: 600;
    }

    .summary-total {
        display: flex;
        justify-content: space-between;
        align-items: center;

        margin-top: 25px;
        padding-top: 20px;

        border-top: 2px solid #111827;
    }

    .summary-total-label {
        font-size: 18px;
        font-weight: 700;
    }

    .summary-total-value {
        font-size: 22px;
        font-weight: 800;
        color: #2563eb;
    }

    .back-cart {
        display: inline-block;

        margin-top: 20px;

        color: #2563eb;
        text-decoration: none;

        font-weight: 600;
    }

    .back-cart:hover {
        text-decoration: underline;
    }

    /* RESPONSIVE */

    @media (max-width: 800px) {

        .checkout-section {
            padding: 40px 15px;
        }

        .checkout-header h1 {
            font-size: 30px;
        }

        .checkout-container {
            grid-template-columns: 1fr;
        }
    }
</style>

@endsection


@section('content')

<section class="checkout-section">

    <div class="checkout-header">

        <h1>
            Checkout
        </h1>

        <p>
            Lengkapi data pembeli untuk menyelesaikan pesanan.
        </p>

    </div>


    <div class="checkout-container">


        {{-- FORM PEMBELI --}}

        <div class="checkout-form">

            <h2>
                Data Pembeli
            </h2>


            <form
                action="{{ route('checkout.store') }}"
                method="POST"
            >

                @csrf


                {{-- NAMA --}}

                <div class="form-group">

                    <label for="customer_name">
                        Nama Lengkap
                    </label>

                    <input
                        type="text"
                        id="customer_name"
                        name="customer_name"
                        value="{{ old('customer_name') }}"
                        placeholder="Masukkan nama lengkap"
                        required
                    >

                    @error('customer_name')

                        <div class="error-message">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- EMAIL --}}

                <div class="form-group">

                    <label for="customer_email">
                        Email
                    </label>

                    <input
                        type="email"
                        id="customer_email"
                        name="customer_email"
                        value="{{ old('customer_email') }}"
                        placeholder="contoh@email.com"
                        required
                    >

                    @error('customer_email')

                        <div class="error-message">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- ALAMAT --}}

                <div class="form-group">

                    <label for="customer_address">
                        Alamat Pengiriman
                    </label>

                    <textarea
                        id="customer_address"
                        name="customer_address"
                        placeholder="Masukkan alamat lengkap"
                        required
                    >{{ old('customer_address') }}</textarea>

                    @error('customer_address')

                        <div class="error-message">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- BUTTON --}}

                <button
                    type="submit"
                    class="checkout-button"
                >
                    🛒 Buat Pesanan
                </button>

            </form>

        </div>


        {{-- RINGKASAN PESANAN --}}

        <div class="order-summary">

            <h2>
                Ringkasan Pesanan
            </h2>


            @foreach ($cart as $item)

                <div class="summary-item">

                    <div class="summary-item-name">
                        {{ $item['name'] }}
                    </div>

                    <div class="summary-item-info">
                        {{ $item['brand'] }}
                        ×
                        {{ $item['quantity'] }}
                    </div>

                    <div class="summary-item-price">
                        Rp
                        {{ number_format(
                            $item['price'] * $item['quantity'],
                            0,
                            ',',
                            '.'
                        ) }}
                    </div>

                </div>

            @endforeach


            {{-- TOTAL --}}

            <div class="summary-total">

                <div class="summary-total-label">
                    Total
                </div>

                <div class="summary-total-value">
                    Rp {{ number_format($total, 0, ',', '.') }}
                </div>

            </div>


            <a
                href="{{ route('cart.index') }}"
                class="back-cart"
            >
                ← Kembali ke Keranjang
            </a>

        </div>

    </div>

</section>

@endsection
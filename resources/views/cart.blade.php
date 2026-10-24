@extends('layouts.app')

@section('title', 'Keranjang - GowesBike')

@section('styles')

<style>
    .cart-section {
        max-width: 1000px;
        margin: 0 auto;
        padding: 60px 20px;
    }

    .cart-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .cart-header h1 {
        font-size: 36px;
        margin-bottom: 10px;
    }

    .cart-header p {
        color: #666;
    }

    .success-message {
        margin-bottom: 25px;
        padding: 15px 20px;
        background: #e8f8ed;
        border: 1px solid #a8dfb8;
        color: #176b2c;
        border-radius: 8px;
    }

    .error-message {
        margin-bottom: 25px;
        padding: 15px 20px;
        background: #ffe5e5;
        border: 1px solid #ffb5b5;
        color: #b00020;
        border-radius: 8px;
    }

    .cart-list {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .cart-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        padding: 25px;
        background: white;
        border: 1px solid #e5e5e5;
        border-radius: 12px;
    }

    .cart-item-info {
        flex: 1;
    }

    .cart-item-brand {
        font-size: 13px;
        color: #777;
        font-weight: bold;
        letter-spacing: 1px;
        margin-bottom: 5px;
    }

    .cart-item-name {
        font-size: 20px;
        margin-bottom: 8px;
    }

    .cart-item-price {
        color: #555;
    }

    /* QUANTITY */

    .cart-item-quantity {
        text-align: center;
        min-width: 150px;
    }

    .quantity-label {
        display: block;
        font-size: 12px;
        color: #777;
        margin-bottom: 8px;
    }

    .quantity-form {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
    }

    .quantity-button {
        width: 34px;
        height: 34px;

        border: 1px solid #ddd;
        background: white;

        border-radius: 7px;

        font-size: 18px;
        font-weight: bold;

        cursor: pointer;
    }

    .quantity-button:hover {
        background: #f1f1f1;
    }

    .quantity-input {
        width: 50px;
        height: 34px;

        text-align: center;

        border: 1px solid #ddd;
        border-radius: 7px;

        font-size: 15px;
        font-weight: 600;
    }

    .quantity-input::-webkit-inner-spin-button,
    .quantity-input::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .quantity-input {
        appearance: textfield;
        -moz-appearance: textfield;
    }

    .update-button {
        margin-top: 8px;

        border: none;
        background: transparent;

        color: #2563eb;

        font-size: 12px;
        font-weight: 600;

        cursor: pointer;
    }

    .update-button:hover {
        text-decoration: underline;
    }

    /* SUBTOTAL */

    .cart-item-subtotal {
        min-width: 180px;
        text-align: right;
    }

    .subtotal-label {
        display: block;
        font-size: 12px;
        color: #777;
        margin-bottom: 5px;
    }

    .subtotal-value {
        font-size: 18px;
        font-weight: bold;
    }

    /* DELETE */

    .delete-form {
        margin-top: 10px;
    }

    .delete-button {
        border: none;
        background: transparent;

        color: #dc2626;

        font-size: 13px;
        font-weight: 600;

        cursor: pointer;
    }

    .delete-button:hover {
        text-decoration: underline;
    }

    /* TOTAL */

    .cart-total {
        margin-top: 30px;
        padding: 25px;

        background: #f7f7f7;

        border-radius: 12px;

        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .cart-total-label {
        font-size: 20px;
        font-weight: 600;
    }

    .cart-total-value {
        font-size: 26px;
        font-weight: bold;
    }

    /* EMPTY CART */

    .empty-cart {
        text-align: center;

        padding: 70px 20px;

        background: #fafafa;

        border: 1px solid #eee;

        border-radius: 12px;
    }

    .empty-cart h2 {
        margin-bottom: 10px;
    }

    .empty-cart p {
        color: #666;
        margin-bottom: 25px;
    }

    .products-button {
        display: inline-block;

        padding: 12px 20px;

        background: #111;

        color: white;

        text-decoration: none;

        border-radius: 8px;

        font-weight: 600;
    }

    .products-button:hover {
        opacity: 0.85;
    }

    /* RESPONSIVE */

    @media (max-width: 700px) {

        .cart-section {
            padding: 40px 15px;
        }

        .cart-header h1 {
            font-size: 30px;
        }

        .cart-item {
            flex-direction: column;
            align-items: stretch;
        }

        .cart-item-quantity {
            text-align: left;
            min-width: auto;
        }

        .quantity-form {
            justify-content: flex-start;
        }

        .cart-item-subtotal {
            text-align: left;
            min-width: auto;
        }

        .cart-total {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }
        .checkout-action {
    margin-top: 20px;
    text-align: right;
}

.checkout-button {
    display: inline-block;

    padding: 14px 24px;

    background: #2563eb;
    color: white;

    text-decoration: none;

    border-radius: 8px;

    font-weight: 700;
}

.checkout-button:hover {
    background: #1d4ed8;
}
    }
</style>

@endsection


@section('content')

<section class="cart-section">

    <div class="cart-header">

        <h1>
            Keranjang Belanja
        </h1>

        <p>
            Produk yang Anda pilih akan muncul di sini.
        </p>

    </div>


    {{-- Pesan sukses --}}

    @if (session('success'))

        <div class="success-message">
            {{ session('success') }}
        </div>

    @endif


    {{-- Pesan error --}}

    @if (session('error'))

        <div class="error-message">
            {{ session('error') }}
        </div>

    @endif


    {{-- Jika keranjang kosong --}}

    @if (empty($cart))

        <div class="empty-cart">

            <h2>
                Keranjang masih kosong
            </h2>

            <p>
                Silakan pilih produk terlebih dahulu.
            </p>

            <a
                href="{{ route('products.index') }}"
                class="products-button"
            >
                Lihat Produk
            </a>

        </div>


    {{-- Jika ada produk --}}

    @else

        <div class="cart-list">

            @foreach ($cart as $id => $item)

                <div class="cart-item">

                    {{-- INFORMASI PRODUK --}}

                    <div class="cart-item-info">

                        <div class="cart-item-brand">
                            {{ $item['brand'] }}
                        </div>

                        <div class="cart-item-name">
                            {{ $item['name'] }}
                        </div>

                        <div class="cart-item-price">
                            Rp {{ number_format($item['price'], 0, ',', '.') }}
                            / produk
                        </div>

                    </div>


                    {{-- QUANTITY --}}

                    <div class="cart-item-quantity">

                        <span class="quantity-label">
                            Jumlah
                        </span>

                        <form
                            action="{{ route('cart.update', $id) }}"
                            method="POST"
                            class="quantity-form"
                        >

                            @csrf

                            @method('PUT')


                            {{-- Tombol minus --}}

                            <button
                                type="button"
                                class="quantity-button"
                                onclick="decreaseQuantity(this)"
                            >
                                −
                            </button>


                            {{-- Input quantity --}}

                            <input
                                type="number"
                                name="quantity"
                                value="{{ $item['quantity'] }}"
                                min="1"
                                class="quantity-input"
                            >


                            {{-- Tombol plus --}}

                            <button
                                type="button"
                                class="quantity-button"
                                onclick="increaseQuantity(this)"
                            >
                                +
                            </button>

                        </form>


                        <button
                            type="button"
                            class="update-button"
                            onclick="this.previousElementSibling.submit()"
                        >
                            Update jumlah
                        </button>

                    </div>


                    {{-- SUBTOTAL --}}

                    <div class="cart-item-subtotal">

                        <span class="subtotal-label">
                            Subtotal
                        </span>

                        <span class="subtotal-value">
                            Rp
                            {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                        </span>


                        {{-- HAPUS PRODUK --}}

                        <form
                            action="{{ route('cart.remove', $id) }}"
                            method="POST"
                            class="delete-form"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini dari keranjang?')"
                        >

                            @csrf

                            @method('DELETE')

                            <button
                                type="submit"
                                class="delete-button"
                            >
                                🗑️ Hapus
                            </button>

                        </form>

                    </div>

                </div>

            @endforeach

        </div>


        {{-- TOTAL --}}

       <div class="cart-total">

    <div class="cart-total-label">
        Total
    </div>

    <div class="cart-total-value">
        Rp {{ number_format($total, 0, ',', '.') }}
    </div>

</div>


{{-- CHECKOUT BUTTON --}}

<div class="checkout-action">

    <a
        href="{{ route('checkout') }}"
        class="checkout-button"
    >
        Lanjut ke Checkout →
    </a>

</div>

    @endif

</section>


<script>

    function increaseQuantity(button) {

        const input = button
            .parentElement
            .querySelector('.quantity-input');

        input.value = parseInt(input.value) + 1;
    }


    function decreaseQuantity(button) {

        const input = button
            .parentElement
            .querySelector('.quantity-input');

        const currentValue = parseInt(input.value);

        if (currentValue > 1) {

            input.value = currentValue - 1;

        }
    }

</script>

@endsection
@extends('layouts.app')

@section('title', $product['name'] . ' - GowesBike')

@section('styles')

<style>

    .detail-container {
        max-width: 1200px;
        margin: auto;
        padding: 70px 30px;
    }

    .back-link {
        display: inline-block;
        margin-bottom: 30px;
        color: #2563eb;
        text-decoration: none;
        font-weight: 600;
    }

    .product-detail {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 60px;
        align-items: start;
    }

    .product-photo {
        min-height: 500px;
        background: #e5e7eb;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .product-photo img {
        width: 100%;
        height: 500px;
        object-fit: cover;
        border-radius: 20px;
    }

    .placeholder-icon {
        font-size: 150px;
    }

    .product-info {
        padding-top: 10px;
    }

    .brand {
        color: #2563eb;
        font-size: 14px;
        font-weight: 700;
        margin-bottom: 12px;
    }

    .product-info h1 {
        font-size: 46px;
        line-height: 1.1;
        letter-spacing: -2px;
        margin-bottom: 20px;
    }

    .description {
        color: #6b7280;
        font-size: 17px;
        line-height: 1.7;
        margin-bottom: 25px;
    }

    .price {
        font-size: 28px;
        color: #2563eb;
        font-weight: 800;
        margin-bottom: 30px;
    }

    .add-cart {
        display: block;
        width: 100%;
        border: none;
        background: #2563eb;
        color: white;
        padding: 16px;
        border-radius: 10px;
        font-size: 16px;
        font-weight: 700;
        cursor: pointer;
        margin-bottom: 40px;
    }

    .add-cart:hover {
        background: #1d4ed8;
    }

    .specifications {
        border-top: 1px solid #e5e7eb;
    }

    .specifications h2 {
        font-size: 22px;
        margin: 25px 0 15px;
    }

    .spec-row {
        display: flex;
        justify-content: space-between;
        gap: 20px;
        padding: 14px 0;
        border-bottom: 1px solid #e5e7eb;
    }

    .spec-name {
        color: #6b7280;
    }

    .spec-value {
        font-weight: 600;
        text-align: right;
    }

    @media (max-width: 800px) {

        .product-detail {
            grid-template-columns: 1fr;
            gap: 30px;
        }

        .product-photo {
            min-height: 350px;
        }

        .product-photo img {
            height: 350px;
        }

        .product-info h1 {
            font-size: 36px;
        }

    }

</style>

@endsection


@section('content')

<div class="detail-container">

    <a href="{{ route('products.index') }}" class="back-link">
        ← Back to Products
    </a>


    <div class="product-detail">

        <!-- PRODUCT IMAGE -->

        <div class="product-photo">

            @if ($product['image'])

                <img
                    src="{{ asset('storage/' . $product['image']) }}"
                    alt="{{ $product['name'] }}"
                >

            @else

                <div class="placeholder-icon">
                    🚲
                </div>

            @endif

        </div>


        <!-- PRODUCT INFORMATION -->

        <div class="product-info">

            <div class="brand">
                {{ $product['brand'] }}
            </div>

            <h1>
                {{ $product['name'] }}
            </h1>

            <p class="description">
                {{ $product['description'] }}
            </p>

            <div class="price">
                Rp {{ number_format($product['price'], 0, ',', '.') }}
            </div>


            <!-- ADD TO CART -->

            <form
                action="{{ route('cart.add', $product['id']) }}"
                method="POST"
            >

                @csrf

                <button
                    type="submit"
                    class="add-cart"
                >
                    🛒 Add to Cart
                </button>

            </form>


            <!-- SPECIFICATIONS -->

            <div class="specifications">

                <h2>
                    Technical Specifications
                </h2>


                <div class="spec-row">

                    <span class="spec-name">
                        Groupset
                    </span>

                    <span class="spec-value">
                        {{ $product['groupset'] }}
                    </span>

                </div>


                <div class="spec-row">

                    <span class="spec-name">
                        Brakes
                    </span>

                    <span class="spec-value">
                        {{ $product['brakes'] }}
                    </span>

                </div>


                <div class="spec-row">

                    <span class="spec-name">
                        Wheelset
                    </span>

                    <span class="spec-value">
                        {{ $product['wheelset'] }}
                    </span>

                </div>


                <div class="spec-row">

                    <span class="spec-name">
                        Tires
                    </span>

                    <span class="spec-value">
                        {{ $product['tires'] }}
                    </span>

                </div>


                <div class="spec-row">

                    <span class="spec-name">
                        Crankset
                    </span>

                    <span class="spec-value">
                        {{ $product['crankset'] }}
                    </span>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
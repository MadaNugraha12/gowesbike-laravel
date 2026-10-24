@extends('layouts.app')

@section('title', 'GowesBike - Premium Road Bike Store')

@section('styles')

<style>
    .success-message {
        max-width: 1100px;
        margin: 30px auto 0;
        padding: 15px 20px;

        background: #e8f8ed;
        border: 1px solid #a8dfb8;
        color: #176b2c;

        border-radius: 8px;

        font-weight: 600;
    }

    /* HERO */

    .hero {
        min-height: 600px;

        display: flex;
        align-items: center;

        padding: 80px 7%;

        background: #f8fafc;
    }

    .hero-content {
        max-width: 700px;
    }

    .hero-label {
        color: #2563eb;

        font-size: 14px;
        font-weight: 700;

        letter-spacing: 2px;

        margin-bottom: 20px;
    }

    .hero h1 {
        font-size: 64px;
        line-height: 1.05;

        letter-spacing: -3px;

        margin-bottom: 25px;
    }

    .hero h1 span {
        color: #2563eb;
    }

    .hero p {
        max-width: 600px;

        color: #6b7280;

        font-size: 18px;
        line-height: 1.7;

        margin-bottom: 35px;
    }

    .hero-button {
        display: inline-block;

        padding: 14px 25px;

        background: #2563eb;
        color: white;

        text-decoration: none;

        border-radius: 8px;

        font-weight: 700;
    }

    .hero-button:hover {
        background: #1d4ed8;
    }


    /* FEATURES */

    .features {
        padding: 70px 7%;

        background: white;
    }

    .features-container {
        max-width: 1100px;

        margin: 0 auto;

        display: grid;

        grid-template-columns: repeat(3, 1fr);

        gap: 30px;
    }

    .feature {
        padding: 30px;

        border: 1px solid #e5e7eb;

        border-radius: 12px;

        background: white;
    }

    .feature-icon {
        font-size: 30px;

        margin-bottom: 15px;
    }

    .feature h3 {
        margin-bottom: 10px;
    }

    .feature p {
        color: #6b7280;

        line-height: 1.6;
    }


    /* PRODUCT CTA */

    .product-cta {
        padding: 90px 7%;

        text-align: center;

        background: #f1f5f9;
    }

    .product-cta h2 {
        font-size: 38px;

        margin-bottom: 15px;
    }

    .product-cta p {
        color: #6b7280;

        margin-bottom: 30px;
    }


    /* RESPONSIVE */

    @media (max-width: 800px) {

        .hero {
            padding: 60px 7%;
        }

        .hero h1 {
            font-size: 44px;
        }

        .features-container {
            grid-template-columns: 1fr;
        }

        .product-cta h2 {
            font-size: 30px;
        }
    }
</style>

@endsection


@section('content')


{{-- PESAN SUKSES --}}

@if (session('success'))

    <div class="success-message">
        {{ session('success') }}
    </div>

@endif


{{-- HERO --}}

<section class="hero">

    <div class="hero-content">

        <div class="hero-label">
            PREMIUM ROAD BIKE STORE
        </div>

        <h1>
            Ride Faster.
            <br>
            Ride <span>Further.</span>
        </h1>

        <p>
            Temukan road bike premium dengan performa tinggi
            untuk balapan, latihan, maupun perjalanan jarak jauh.
        </p>

        <a
            href="{{ route('products.index') }}"
            class="hero-button"
        >
            Lihat Produk
        </a>

    </div>

</section>


{{-- FEATURES --}}

<section class="features">

    <div class="features-container">


        <div class="feature">

            <div class="feature-icon">
                🚴
            </div>

            <h3>
                Premium Bikes
            </h3>

            <p>
                Koleksi road bike berkualitas dengan
                spesifikasi yang dirancang untuk performa.
            </p>

        </div>


        <div class="feature">

            <div class="feature-icon">
                ⚡
            </div>

            <h3>
                High Performance
            </h3>

            <p>
                Pilihan komponen dan groupset yang mendukung
                kecepatan serta efisiensi saat bersepeda.
            </p>

        </div>


        <div class="feature">

            <div class="feature-icon">
                🛒
            </div>

            <h3>
                Easy Shopping
            </h3>

            <p>
                Pilih produk, masukkan ke keranjang,
                dan lakukan checkout dengan mudah.
            </p>

        </div>


    </div>

</section>


{{-- PRODUCT CTA --}}

<section class="product-cta">

    <h2>
        Temukan Sepeda Impian Anda
    </h2>

    <p>
        Jelajahi koleksi road bike GowesBike sekarang.
    </p>

    <a
        href="{{ route('products.index') }}"
        class="hero-button"
    >
        Jelajahi Produk
    </a>

</section>


@endsection
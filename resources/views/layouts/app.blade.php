<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'GowesBike')
    </title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f8fafc;
            color: #111827;
        }

        /* =========================
           NAVBAR
        ========================= */

        nav {
            min-height: 72px;
            background: white;
            border-bottom: 1px solid #e5e7eb;

            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 0 7%;
            gap: 30px;
        }

        .logo {
            font-size: 24px;
            font-weight: 800;
            white-space: nowrap;
        }

        .logo span {
            color: #2563eb;
        }

        .nav-menu {
            display: flex;
            gap: 32px;
            list-style: none;
            align-items: center;
        }

        .nav-menu a {
            text-decoration: none;
            color: #374151;
            font-size: 15px;
        }

        .nav-menu a:hover {
            color: #2563eb;
        }

        /* =========================
           BAGIAN KANAN NAVBAR
        ========================= */

        .nav-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        /* Cart */

        .cart {
            background: #111827;
            color: white !important;

            padding: 10px 18px;
            border-radius: 8px;

            text-decoration: none;
            white-space: nowrap;
        }

        .cart:hover {
            background: #1f2937;
        }

        /* Login */

        .login-button {
            background: #2563eb;
            color: white !important;

            padding: 10px 18px;
            border-radius: 8px;

            text-decoration: none;
            white-space: nowrap;
        }

        .login-button:hover {
            background: #1d4ed8;
        }

        /* User */

        .user-info {
            display: flex;
            align-items: center;
            gap: 8px;

            padding: 7px 10px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;

            background: #f9fafb;
        }

        .user-name {
            font-size: 14px;
            font-weight: 600;
            color: #111827;
        }

        .user-role {
            font-size: 11px;
            color: #6b7280;
        }

        /* Logout */

        .logout-button {
            border: none;
            background: #dc2626;
            color: white;

            padding: 10px 16px;
            border-radius: 8px;

            font-size: 14px;
            cursor: pointer;
        }

        .logout-button:hover {
            background: #b91c1c;
        }

        /* =========================
           MAIN
        ========================= */

        main {
            min-height: calc(100vh - 72px);
        }

        /* =========================
           FOOTER
        ========================= */

        footer {
            background: #111827;
            color: white;

            padding: 40px 7%;

            display: flex;
            justify-content: space-between;
        }

        footer p {
            color: #9ca3af;
            margin-top: 8px;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 1000px) {

            nav {
                padding: 15px 5%;
                flex-wrap: wrap;
            }

            .nav-menu {
                order: 3;
                width: 100%;
                justify-content: center;
            }

        }

        @media (max-width: 800px) {

            nav {
                padding: 15px 5%;
            }

            .nav-menu {
                display: none;
            }

            .nav-right {
                margin-left: auto;
            }

            .user-info {
                display: none;
            }

            footer {
                flex-direction: column;
                gap: 20px;
            }

        }

        @media (max-width: 500px) {

            .logo {
                font-size: 20px;
            }

            .nav-right {
                gap: 6px;
            }

            .cart,
            .login-button,
            .logout-button {
                padding: 8px 12px;
                font-size: 13px;
            }

        }
    </style>

    @yield('styles')
</head>

<body>

    {{-- =========================
         NAVBAR
    ========================= --}}

    <nav>

        {{-- Logo --}}
        <div class="logo">
            Gowes<span>Bike</span>
        </div>


        {{-- Menu --}}
        <ul class="nav-menu">

            <li>
                <a href="{{ route('home') }}">
                    Home
                </a>
            </li>

            <li>
                <a href="{{ route('products.index') }}">
                    Products
                </a>
            </li>

            <li>
                <a href="{{ route('categories.index') }}">
                    Categories
                </a>
            </li>

            <li>
                <a href="#">
                    About
                </a>
            </li>

            <li>
                <a href="#">
                    Contact
                </a>
            </li>

        </ul>


        {{-- Bagian kanan navbar --}}
        <div class="nav-right">

            {{-- Cart --}}
            <a href="{{ route('cart.index') }}" class="cart">
                🛒 Cart ({{ collect(session('cart', []))->sum('quantity') }})
            </a>


            {{-- Jika sudah login --}}
            @auth

                {{-- Informasi user --}}
                <div class="user-info">

                    <div>
                        <div class="user-name">
                            {{ Auth::user()->name }}
                        </div>

                        <div class="user-role">
                            {{ ucfirst(Auth::user()->role) }}
                        </div>
                    </div>

                </div>


                {{-- Logout --}}
                <form action="{{ route('logout') }}" method="POST">

                    @csrf

                    <button
                        type="submit"
                        class="logout-button"
                    >
                        Logout
                    </button>

                </form>

            @else

                {{-- Jika belum login --}}
                <a
                    href="{{ route('login') }}"
                    class="login-button"
                >
                    Login
                </a>

            @endauth

        </div>

    </nav>


    {{-- =========================
         MAIN CONTENT
    ========================= --}}

    <main>

        @yield('content')

    </main>


    {{-- =========================
         FOOTER
    ========================= --}}

    <footer>

        <div>
            <strong>GowesBike</strong>

            <p>
                Premium Road Bike Store
            </p>
        </div>


        <div>
            <p>
                © 2026 GowesBike. All rights reserved.
            </p>
        </div>

    </footer>

</body>

</html>
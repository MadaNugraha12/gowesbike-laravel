@extends('layouts.app')

@section('title', 'Login - GowesBike')

@section('content')

<style>
    .login-container {
        min-height: 70vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 50px 20px;
        background: #f8fafc;
    }

    .login-card {
        width: 100%;
        max-width: 420px;
        background: white;
        padding: 35px;
        border-radius: 12px;
        border: 1px solid #e5e7eb;
    }

    .login-card h1 {
        margin-bottom: 8px;
    }

    .login-card > p {
        color: #6b7280;
        margin-bottom: 25px;
    }

    .form-group {
        margin-bottom: 18px;
    }

    .form-group label {
        display: block;
        margin-bottom: 7px;
        font-weight: 600;
    }

    .form-group input {
        width: 100%;
        padding: 12px;
        border: 1px solid #d1d5db;
        border-radius: 7px;
        font-size: 15px;
    }

    .error {
        color: #dc2626;
        font-size: 14px;
        margin-top: 5px;
    }

    .login-button {
        width: 100%;
        padding: 13px;
        border: none;
        border-radius: 7px;
        background: #2563eb;
        color: white;
        font-size: 15px;
        font-weight: 700;
        cursor: pointer;
    }

    .login-button:hover {
        background: #1d4ed8;
    }
</style>

<div class="login-container">

    <div class="login-card">

        <h1>Login</h1>

        <p>
            Masuk ke akun GowesBike Anda.
        </p>

        <form action="{{ route('login') }}" method="POST">

            @csrf

            <div class="form-group">

                <label for="email">
                    Email
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                >

                @error('email')
                    <div class="error">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            <div class="form-group">

                <label for="password">
                    Password
                </label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    required
                >

                @error('password')
                    <div class="error">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            <button
                type="submit"
                class="login-button"
            >
                Login
            </button>

        </form>

    </div>

</div>

@endsection

<!-- resources/views/auth/login.blade.php -->
@extends('layouts.app')

@section('content')
<div class="login-container">
    <h2 class="login-title">Connexion</h2>

    <form action="{{ route('user.seConnecter') }}" method="POST" class="login-form">
        @csrf

        <!-- Email -->
        <div class="form-group">
            <label for="email" class="form-label">Email:</label>
            <input type="email" name="email" value="{{ old('email') }}" required class="form-input">
            @error('email') <span class="error-message">{{ $message }}</span> @enderror
        </div>

        <!-- Password -->
        <div class="form-group">
            <label for="password" class="form-label">Mot de passe:</label>
            <input type="password" name="password" required class="form-input">
            @error('password') <span class="error-message">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="submit-button">Se connecter</button>
    </form>
</div>

<!-- Custom Styles for Login Page -->
<style>
    .login-container {
        max-width: 400px;
        margin: 0 auto;
        padding: 2rem;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .login-title {
        font-size: 1.8rem;
        margin-bottom: 1.5rem;
        color: #333;
    }

    .login-form {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        text-align: left;
    }

    .form-label {
        font-size: 1rem;
        color: #555;
    }

    .form-input {
        padding: 0.5rem;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 1rem;
    }

    .error-message {
        color: red;
        font-size: 0.9rem;
    }

    .submit-button {
        padding: 0.7rem;
        font-size: 1rem;
        color: #fff;
        background-color: #007bff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .submit-button:hover {
        background-color: #0056b3;
    }
</style>
@endsection

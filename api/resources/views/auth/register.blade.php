<!-- resources/views/auth/register.blade.php -->
@extends('layouts.app')

@section('content')
    <h2>Inscription</h2>
    
    <form action="{{ route('user.inscrire') }}" method="POST">
        @csrf

        <!-- Name -->
        <div>
            <label for="nom">Nom:</label>
            <input type="text" name="name" value="{{ old('name') }}" required>
            @error('name') <span>{{ $message }}</span> @enderror
        </div>

        <!-- Email -->
        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" value="{{ old('email') }}" required>
            @error('email') <span>{{ $message }}</span> @enderror
        </div>

        <!-- Password -->
        <div>
            <label for="password">Mot de passe:</label>
            <input type="password" name="password" required>
            @error('password') <span>{{ $message }}</span> @enderror
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation">Confirmez le mot de passe:</label>
            <input type="password" name="password_confirmation" required>
        </div>

        <!-- Role -->
        <div>
            <label for="role">Rôle:</label>
            <select name="role" required>
                <option value="organisateur">Organisateur</option>
                <option value="participant">Participant</option>
            </select>
            @error('role') <span>{{ $message }}</span> @enderror
        </div>

        <button type="submit">S'inscrire</button>
    </form>
@endsection

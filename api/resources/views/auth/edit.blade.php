@extends('dashboard.admin.dashboard')

@section('title', 'admis')

@section('content')
    <div class="container">
        <h2>Modifier le profil</h2>

        <form action="{{ route('user.modifierProfil') }}" method="POST" class="mt-4">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div class="mb-3">
                <label for="name" class="form-label">Nom:</label>
                <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" class="form-control"
                    required>
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" class="form-control"
                    required>
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="password mt-4">
                <input type="checkbox" name="showPassword" id="showPassword"> Update Password ??
                <div class="mt-4" id="divPassword">
                    <!-- Password (Optional) -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Nouveau mot de passe (facultatif):</label>
                        <input type="password" name="password" class="form-control">
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Password Confirmation -->
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirmez le mot de passe:</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Modifier le profil</button>
        </form>
    </div>



    <script>
        const checkbox = document.getElementById('showPassword');
        const divPassword = document.getElementById('divPassword');

        document.addEventListener('DOMContentLoaded', function() {
            checkbox.checked = false;
            divPassword.style.display = 'none'
        })

        checkbox.addEventListener('change', function() {
            if (this.checked) {
                divPassword.style.display = 'block'
            } else {
                divPassword.style.display = 'none'
            }
        })
    </script>
@endsection

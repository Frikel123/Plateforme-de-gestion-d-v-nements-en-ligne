<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
     // Show registration form
     public function showRegistrationForm()
     {
         return view('auth.register');
     }
 
     // Handle user registration
     public function sInscrire(Request $request)
     {
         // Validate the form input
         $request->validate([
             'name' => 'required|string|max:255',
             'email' => 'required|email|unique:users',
             'password' => 'required|string|min:8|confirmed',
             'role' => 'required|in:organisateur,participant',
         ]);
 
         // Create a new user in the database
         $user = User::create([
             'name' => $request->name,
             'email' => $request->email,
             'password' => Hash::make($request->password),  // Hash the password
             'role' => $request->role,
         ]);
 
         // Log the user in after registration
         Auth::login($user);
 
         // Redirect to a specific page with a success message
         return redirect('/dashboard')->with('success', 'Inscription réussie.');
     }
 
     // Show login form
     public function showLoginForm()
     {
         return view('auth.login');
     }
 
     // Handle user login
     public function seConnecter(Request $request)
     {
         // Validate login form input
         $credentials = $request->validate([
             'email' => 'required|email',
             'password' => 'required|string',
         ]);
 
         // Attempt to log in the user
         if (Auth::attempt($credentials)) {
             // Login successful, redirect to the dashboard
             return redirect()->intended('/dashboard')->with('success', 'Connexion réussie.');
         }
 
         // If login fails, redirect back with an error message
         return back()->withErrors([
             'email' => 'Les identifiants sont incorrects.',
         ]);
     }
 
     // Show profile edit form
public function editProfile()
{
    return view('auth.edit');
}

// Handle profile update
public function modifierProfil(Request $request)
{
    $user = Auth::user();

    // Validate input
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'password' => 'nullable|string|min:8|confirmed',
    ]);

    $user->name = $validated['name'];
    $user->email = $validated['email'];

    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    $user->save();

    return redirect()->route('dashboard')->with('success', 'Profil modifié avec succès.');
}

     public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/')->with('success', 'Déconnexion réussie.');
}
}

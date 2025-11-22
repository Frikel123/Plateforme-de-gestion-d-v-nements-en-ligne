<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Get the currently authenticated user
        return $user->role === 'organisateur' 
            ? view('dashboard.Admin.dashboard', compact('user'))
            : view('dashboard.Admin.app');

    }
    public function dashboard()
{
    return view('dashboard.dashboard');
}
   
 
   
  
    
    
}

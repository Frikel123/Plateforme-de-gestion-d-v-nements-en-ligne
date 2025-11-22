<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\isOrganisateur;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventCategoryController;






Route::get('/',[TemplateController::class,'index']);






// Route for registration form and submission
Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [UserController::class, 'sInscrire'])->name('user.inscrire');

// Route for login form and submission
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'seConnecter'])->name('user.seConnecter');


Route::post('/logout', [UserController::class, 'logout'])->name('user.logout');

// Route to modify profile (protected route, only accessible to authenticated users)

Route::middleware('auth')->group(function(){
    Route::get('/edit', [UserController::class, 'editProfile'])->name('auth.edit');
    
Route::put('/profile', [UserController::class, 'modifierProfil'])->name('user.modifierProfil');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard.dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
});


Route::middleware(isOrganisateur::class)->group(function(){
    Route::resource('Events', EventController::class);
    Route::resource('EventCategory', EventCategoryController::class);
    Route::post('/search', SearchController::class);

  
});
Route::post('/contact', [MessageController::class, 'store'])->name('contact.store');
Route::resource('/admin/Messages', MessageController::class);
Route::post('/admin/messages/replay', [MessageController::class, 'sendReplay']);
Route::post('/admin/messages/message/replay', [MessageController::class, 'sendReplayToSpecificContact']);
Route::get('/messages/markAsRead/{id}', [MessageController::class, 'markAsRead'])->name('messages.markAsRead');


Route::get('/payments', [PaymentController::class, 'index'])->name('payment.index');
Route::get('/checkout/{event}', [PaymentController::class, 'checkout'])->middleware('auth')->name('checkout');
Route::get('/success/{event}', [PaymentController::class, 'success'])->name('payment.success');
Route::get('/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');

?>
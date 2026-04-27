<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{HomeController, RoomController, ContactController, AdminController, CartController};
use App\Http\Controllers\Auth\{LoginController, RegisterController};

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shop', [RoomController::class, 'index'])->name('shop');
Route::get('/about', function() { return view('about'); })->name('about');
Route::get('/contacts', [ContactController::class, 'index'])->name('contacts');
Route::post('/contacts', [ContactController::class, 'send']);
Route::get('/room/{room}', [RoomController::class, 'show'])->name('room.show');
Route::get('/room/{room}/booking-form', [RoomController::class, 'bookingForm'])->name('room.booking.form');
Route::post('/room/{room}/book', [RoomController::class, 'book'])->name('room.book');

//корзина
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/cancel/{id}', [CartController::class, 'cancel'])->name('cart.cancel');

//auth
Route::get('/login', function() { return view('auth.login'); })->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', function() { return view('auth.register'); })->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/logout', function() { auth()->logout(); return redirect('/'); })->name('logout');

// админка
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::get('/admin/rooms', [AdminController::class, 'rooms'])->name('admin.rooms');
Route::get('/admin/bookings', [AdminController::class, 'bookings'])->name('admin.bookings'); 
Route::post('/admin/rooms', [AdminController::class, 'storeRoom'])->name('admin.rooms.store');
Route::delete('/admin/rooms/{room}', [AdminController::class, 'deleteRoom'])->name('admin.rooms.delete');
Route::post('/admin/bookings/{id}/delete', [AdminController::class, 'deleteBooking'])->name('admin.bookings.delete');
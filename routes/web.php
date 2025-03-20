<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Middleware\Authenticate;


Route::get('/', function () {
    return view('welcome');
});



Route::get('/register', function () { return view('register'); })->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', function () { return view('login'); })->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/chatbot', function () {
    return view('index');
})->middleware('auth')->name('chatbot');


// Route::post('/logout', function () {
//     Auth::logout();
//     return redirect()->route('login');
// })->name('logout');
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('login');
})->name('logout');

Route::get('/chatbot', [LoginController::class, 'dashboard'])->middleware('auth')->name('chatbot');


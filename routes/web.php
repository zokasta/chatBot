<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ChatBotController;
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


Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');


Route::get('/home', [LoginController::class, 'dashboard'])->middleware('auth')->name('chatbot');


// file upload route

Route::post('/upload-file', function (Request $request) {
    if ($request->hasFile('file')) {
        $file = $request->file('file');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('uploads', $filename, 'public'); // ✅ File store in `storage/app/public/uploads`

        return response()->json(['message' => 'File uploaded successfully!', 'filename' => $filename]);
    }

    return response()->json(['message' => 'No file uploaded!'], 400);
})->name('upload.file');



//for sending the data
Route::post('/send',[ChatBotController::class,'chat']);

Route::get('/chat', function(){
    return view('index');
})->name('chats');

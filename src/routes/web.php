<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth')->get('/dashboard', function () {
    return view('dashboard');
});
Route::get('/dashboard', function () {
    // pastikan user sudah login
    if (!session()->has('user')) {
        return redirect()->route('login');
    }
    return view('dashboard', [
        'user' => session('user')
    ]);
})->name('dashboard');


Route::post('/logout', function (Request $request) {
    $request->session()->flush(); // hapus semua session
    return redirect()->route('login');
})->name('logout');



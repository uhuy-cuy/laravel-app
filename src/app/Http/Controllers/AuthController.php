<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Kirim request ke API eksternal (XAMPP api.php)
        $response = Http::withHeaders([
            'Accept' => 'application/json'
        ])->post('http://host.docker.internal/db_latihan/api.php', [
            'email'    => $credentials['email'],
            'password' => $credentials['password'],
        ]);

        if ($response->failed()) {
            return back()->withErrors([
                'email' => 'API tidak bisa diakses: ' . $response->body(),
            ])->onlyInput('email');
        }

        $data = $response->json();

        // Kalau bukan array JSON valid
        if (!is_array($data)) {
            return back()->withErrors([
                'email' => 'API balas bukan JSON valid: ' . $response->body(),
            ])->onlyInput('email');
        }

        if (($data['status'] ?? '') === 'success') {
            $request->session()->put('user', $data['user']);
            $request->session()->put('token', $data['token']);

            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => $data['message'] ?? 'Login gagal',
        ])->onlyInput('email');
    }
}

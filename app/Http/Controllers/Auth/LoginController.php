<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $response = null;
        // ? lakukan proses otentikasi di sini
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            // ? jika otentikasi berhasil
            $response = [
                'status' => true,
                'code' => 200,
                'message' => 'Anda berhasil login sebagai user, mohon ditunggu sebentar.',
                'redirect' => route('dashboard'), // ? sesuaikan dengan rute yang sesuai
            ];
        } else {
            // ? jika otentikasi gagal
            $response = [
                'status' => false,
                'code' => 401,
                'message' => 'Email atau kata sandi salah',
            ];
        }
        // ? kembalikan nilai berupa json
        return response()->json($response);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/'); // ? sesuaikan dengan halaman setelah logout berhasil
    }
}
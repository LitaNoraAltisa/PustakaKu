<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    // Menampilkan halaman registrasi
    public function showRegister()
    {
        return view('auth.register');
    }

    // Menangani proses registrasi
    public function register(RegisterRequest $request)
    {
        $this->authService->register($request->validated());

        return redirect()->route('login')
            ->with('success', 'Registrasi berhasil. Silakan login dengan akun Anda.');
    }

    // Menampilkan halaman login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Menangani proses login
    public function login(LoginRequest $request)
    {
        if (!$this->authService->login($request->only('email', 'password'))) {
            return back()->withErrors([
                'email' => 'Email atau password salah.',
            ]);
        }
        $request->session()->regenerate();
        
        /** 
         * @var \App\Models\User $user
         *  */

        $user = Auth::user();

        if ($user && $user->isAdmin()) {
            return redirect()->route('admin.dashboard')
            ->with('success', 'Login berhasil. Selamat datang Admin!');
        }
        return redirect()->route('member.dashboard')
        ->with('success', 'Login berhasil. Selamat datang!');
    }

    // Menangani proses logout
    public function logout(Request $request)
    {
        $this->authService->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('landing')
            ->with('success', 'Anda telah berhasil logout.');
    }
}

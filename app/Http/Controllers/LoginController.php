<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function showLoginForm()
    {
        return view('auth.login.index');
    }

    public function login(Request $request)
    {
        $user = $this->user->whereEmail($request->email)->first();
        if (!$user) {
            return back()->with('error', 'User Tidak ada!');
        }
        if (!Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Periksa kembali Password Anda!');
        }

        if (Auth::attempt(["email" => $request->email, "password" => $request->password])) {
            $request->session()->regenerate();

                return redirect()->to('/dashboard-sentimentra')->with('success', 'Anda Berhasil Login. Selamat Datang, ' . Auth::user()->nama);
        }
        return back()->with('error', 'Gagal melakukan autentikasi');
    }

    // public function logout(Request $request)
    // {
    //     Auth::logout();
    //     $request->session()->invalidate();
    //     $request->session()->regenerateToken();

    //     return redirect('/login');
    // }
}

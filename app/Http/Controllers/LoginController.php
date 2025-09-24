<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengguna;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index() {
        return view('login');
    }

    public function authlogin(Request $request) {
        $request->validate([
            'name' => 'required|string',
            'password' => 'required|string',
        ]);

        $pengguna = Pengguna::where('email', $request->name)->orWhere('username', $request->name)->first();

        if ($pengguna && Hash::check($request->password, $pengguna->password)) {
            Session::put('nama', $pengguna->nama);
            Session::put('email', $pengguna->email);
            Session::put('username', $pengguna->username);
            Session::put('id', $pengguna->id_pengguna);
            Session::put('role', $pengguna->role);
            Session::put('logged_in', TRUE);

            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'name' => 'Data Login Salah',
        ])->onlyInput('name')->with('error', 'Data login salah');;
    }

    public function logout() {
        Session::flush();
        return redirect('/');
    }
}

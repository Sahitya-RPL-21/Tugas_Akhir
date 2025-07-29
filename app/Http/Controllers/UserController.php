<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // User login
    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        if (empty($username) && empty($password)) {
            return back()->withErrors(['login' => 'Username dan Password harus diisi.'])->withInput();
        }

        if (empty($username)) {
            return back()->withErrors(['login' => 'Username wajib diisi.'])->withInput();
        }

        if (empty($password)) {
            return back()->withErrors(['login' => 'Password wajib diisi.'])->withInput();
        }
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->role === 'admin') {
                return redirect()->route('homeadmin')->with('message', 'Login successful');
            } elseif (Auth::user()->role === 'kepala') {
                return redirect()->route('stokbarang')->with('message', 'Login successful');
            }
            return redirect()->route('home')->with('message', 'Login successful');
        }

        return back()->withErrors([
            'username' => 'Username dan Password tidak cocok.',
        ])->onlyInput('username');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'role' => 'required',
            'password' => 'required|string|min:5',
        ]);

        // Cek apakah username sudah ada
        if (User::where('username', $request->username)->exists()) {
            return back()->withErrors(['username' => 'Username sudah digunakan.'])->withInput();
        }

        User::create([
            'username' => $request->username,
            'role' => $request->role,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('homeadmin')->with('success', 'Registration successful');
    }
    public function updateAkunPengguna(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'username' => 'required|string|max:255',
            'role' => 'required',
            'password' => 'nullable|confirmed|min:5', // tambahkan validasi ini

        ]);

        if (User::where('username', $request->username)->where('id', '!=', $id)->exists()) {
            return back()->withErrors(['username' => 'Username sudah digunakan.'])->withInput();
        }

        $data = [
            'username' => $request->username,
            'role' => $request->role,
        ];

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);


        return redirect()->route('homeadmin')->with('success', 'Akun pengguna berhasil diperbarui');
    }

    public function tambahpenggunamodal()
    {
        return view('homeadmin');
    }

    

    public function tambahpengguna(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|unique:users,username',
            'password' => 'required|confirmed|min:5',
            'role' => 'required|in:user,kepala,admin',
        ]);

        User::create([
            'username' => $validated['username'],
            'password' => bcrypt($validated['password']),
            'role' => $validated['role'],
        ]);

        return redirect()->back()->with('success', 'Pengguna berhasil ditambahkan.');
    }
    public function hapusAkunPengguna($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('homeadmin')->with('success', 'Akun pengguna berhasil dihapus');
    }
}

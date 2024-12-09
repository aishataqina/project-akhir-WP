<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth/register');
    }

    public function registerSave(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed'
        ])->validate();

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => 'Admin'
        ]);

        return redirect()->route('login');
    }

    public function login()
    {
        return view('auth/login');
    }

    public function loginAction(Request $request)
    {
        Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ])->validate();

        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed')
            ]);
        }

        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        return redirect('/login');
    }

    public function profile(Request $request)
    {
        if ($request->isMethod('post')) {
            $validatedData = $request->validate([
                'phone' => 'nullable|string|max:15',
                'address' => 'nullable|string|max:255',
            ]);

            $user = Auth::user();

            if (!$user) {
                return redirect()->route('login')->with('error', 'You must be logged in to update the profile.');
            }

            if ($validatedData['phone'] !== $user->phone || $validatedData['address'] !== $user->address) {
                $user->phone = $validatedData['phone'] ?? $user->phone;
                $user->address = $validatedData['address'] ?? $user->address;
                $user->save(); // Save if changes are made
            }

            return redirect()->route('profile')->with('success', 'Profile updated successfully!');
        }

        return view('profile');
    }

    public function formUser(Request $request)
    {
        return view('backend.v_user.form', [
            'judul' => 'Form Laporan User',
        ]);
    }

    public function cetakUser(Request $request)
    {
        // Menambahkan aturan validasi
        $request->validate([
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
        ], [
            'tanggal_awal.required' => 'Tanggal Awal harus diisi.',
            'tanggal_akhir.required' => 'Tanggal Akhir harus diisi.',
            'tanggal_akhir.after_or_equal' => 'Tanggal Akhir harus lebih besar atau sama dengan Tanggal Awal.',
        ]);

        $tanggalAwal = $request->input('tanggal_awal');
        $tanggalAkhir = $request->input('tanggal_akhir');

        $query = User::whereBetween('created_at', [$tanggalAwal, $tanggalAkhir])
            ->orderBy('id', 'desc');
        $user = $query->get();

        return view('backend.v_user.cetak', [
            'judul' => 'Laporan User',
            'tanggalAwal' => $tanggalAwal,
            'tanggalAkhir' => $tanggalAkhir,
            'cetak' => $user
        ]);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ManajemenAdminController extends Controller
{
    // 1. List Semua Admin
    public function index()
    {
        // Hanya ambil user dengan role 'admin'
        $admins = User::where('role', 'admin')->latest()->get();
        return view('admin.manajemen_admin.index', compact('admins'));
    }

    // 2. Form Tambah Admin
    public function create()
    {
        return view('admin.manajemen_admin.create');
    }

    // 3. Proses Simpan Admin Baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:users,username',
            'password' => 'required|min:6',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 'admin', // HARDCODE ROLE ADMIN
            'gaji_pokok' => 0, // Admin biasanya tidak masuk penggajian sistem ini
            'tunjangan_tetap' => 0,
        ];

        // Simpan Foto ke Database (Base64)
        if ($request->hasFile('foto_profil')) {
            $file = $request->file('foto_profil');
            $base64 = base64_encode(file_get_contents($file));
            $data['foto_profil'] = 'data:' . $file->getMimeType() . ';base64,' . $base64;
        }

        User::create($data);

        return redirect()->route('admin.users.index')->with('success', 'Admin baru berhasil ditambahkan.');
    }

    // 4. Form Edit Admin
    public function edit($id)
    {
        $admin = User::findOrFail($id);
        return view('admin.manajemen_admin.edit', compact('admin'));
    }

    // 5. Update Data Admin
    public function update(Request $request, $id)
    {
        $admin = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:users,username,'.$id,
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'username' => $request->username,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // Update Foto (Base64)
        if ($request->hasFile('foto_profil')) {
            $file = $request->file('foto_profil');
            $base64 = base64_encode(file_get_contents($file));
            $data['foto_profil'] = 'data:' . $file->getMimeType() . ';base64,' . $base64;
        }

        $admin->update($data);

        return redirect()->route('admin.users.index')->with('success', 'Data admin diperbarui.');
    }

    // 6. Hapus Admin
    public function destroy($id)
    {
        // Cegah Admin menghapus dirinya sendiri
        if (Auth::id() == $id) {
            return back()->with('error', 'Anda tidak bisa menghapus akun sendiri!');
        }

        $admin = User::findOrFail($id);
        $admin->delete();

        return redirect()->route('admin.users.index')->with('success', 'Admin berhasil dihapus.');
    }
}

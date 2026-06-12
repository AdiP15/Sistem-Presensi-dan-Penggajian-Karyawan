<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class KaryawanController extends Controller
{
    public function index()
    {
        $karyawans = User::where('role', 'karyawan')->latest()->get();
        return view('admin.karyawan.index', compact('karyawans'));
    }

    public function create()
    {
        return view('admin.karyawan.create');
    }

    // SIMPAN DATA BARU
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:users,username',
            'password' => 'required|min:6',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'alamat' => 'nullable|string',
            'no_telp' => 'nullable|string|max:20',
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
        ]);

        $data = [
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 'karyawan',
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'jenis_kelamin' => $request->jenis_kelamin,
        ];

        // LOGIKA BARU: Convert Gambar ke Base64 (Database)
        if ($request->hasFile('foto_profil')) {
            $file = $request->file('foto_profil');
            // Ubah file jadi string base64
            $base64 = base64_encode(file_get_contents($file));
            // Tambahkan prefix data image agar bisa dibaca browser
            $data['foto_profil'] = 'data:' . $file->getMimeType() . ';base64,' . $base64;
        }

        User::create($data);

        return redirect()->route('admin.karyawan.index')->with('success', 'Karyawan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $karyawan = User::findOrFail($id);
        return view('admin.karyawan.edit', compact('karyawan'));
    }

    // UPDATE DATA
    public function update(Request $request, $id)
    {
        $karyawan = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:users,username,'.$id,
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'alamat' => 'nullable|string',
            'no_telp' => 'nullable|string|max:20',
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
        ]);

        $data = [
            'name' => $request->name,
            'username' => $request->username,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'jenis_kelamin' => $request->jenis_kelamin,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // LOGIKA BARU: Update Foto Base64
        if ($request->hasFile('foto_profil')) {
            $file = $request->file('foto_profil');
            $base64 = base64_encode(file_get_contents($file));
            $data['foto_profil'] = 'data:' . $file->getMimeType() . ';base64,' . $base64;
        }

        $karyawan->update($data);

        return redirect()->route('admin.karyawan.index')->with('success', 'Data karyawan diperbarui');
    }

    public function destroy($id)
    {
        $karyawan = User::findOrFail($id);
        $karyawan->delete(); // Tidak perlu hapus file, karena tersimpan di DB
        return redirect()->route('admin.karyawan.index')->with('success', 'Karyawan dihapus');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Menampilkan daftar semua user.
     */
    public function index()
    {
        // Ambil data user terbaru, 10 per halaman, lalu kirim ke view
        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Menampilkan form untuk membuat user baru.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Menyimpan user baru ke dalam database.
     */
    public function store(StoreUserRequest $request)
    {
        // Validasi otomatis dilakukan oleh StoreUserRequest
        $validated = $request->validated();
        
        // Enkripsi (hash) password sebelum disimpan
        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        // Arahkan kembali ke halaman index dengan pesan sukses
        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan.');
    }

    /**
     * Menampilkan data user spesifik (biasanya dialihkan ke form edit).
     */
    public function show(User $user)
    {
        return redirect()->route('admin.users.edit', $user);
    }

    /**
     * Menampilkan form untuk mengedit data user.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Memperbarui data user di dalam database.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        // Validasi otomatis dilakukan oleh UpdateUserRequest
        $validated = $request->validated();

        // Cek jika ada input password baru, jika ada, hash password baru
        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            // Jika tidak ada password baru, hapus key 'password' agar tidak menimpa password lama
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('admin.users.index')->with('success', 'Data user berhasil diperbarui.');
    }

    /**
     * Menghapus data user dari database.
     */
    public function destroy(User $user)
    {
        // Pengaman agar admin tidak bisa menghapus akunnya sendiri
        if (Auth::id() == $user->id) {
            return redirect()->route('admin.users.index')->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus.');
    }
}
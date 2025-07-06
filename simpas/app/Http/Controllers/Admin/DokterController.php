<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use App\Models\User;
use App\Models\Poli;
use App\Http\Requests\StoreDokterRequest;
use App\Http\Requests\UpdateDokterRequest;

class DokterController extends Controller
{
    public function index()
    {
        $dokters = Dokter::with('user')->latest()->paginate(10);
        return view('admin.dokter.index', compact('dokters'));
    }

    public function create()
    {
        // Ambil user dengan role 'dokter' yang BELUM memiliki profil di tabel dokters
        $users = User::where('role', 'dokter')->whereDoesntHave('dokter')->get();
        return view('admin.dokter.create', compact('users'));
    }

    public function store(StoreDokterRequest $request)
    {
        $validated = $request->validated();
        
        // Ambil nama dari user yang dipilih untuk di-denormalisasi ke tabel dokter
        $user = User::find($validated['user_id']);
        $validated['nama_dokter'] = $user->name;

        Dokter::create($validated);

        return redirect()->route('admin.dokter.index')->with('success', 'Data dokter berhasil ditambahkan.');
    }

    public function edit(Dokter $dokter)
    {
        return view('admin.dokter.edit', compact('dokter'));
    }

    public function update(UpdateDokterRequest $request, Dokter $dokter)
    {
        $validated = $request->validated();
        $dokter->update($validated);

        return redirect()->route('admin.dokter.index')->with('success', 'Data dokter berhasil diperbarui.');
    }

    public function destroy(Dokter $dokter)
    {
        $dokter->delete();
        return redirect()->route('admin.dokter.index')->with('success', 'Data dokter berhasil dihapus.');
    }

    public function getDokterByPoli(Poli $poli)
    {
        // Cari dokter yang memiliki spesialisasi sama dengan nama poli
        $dokters = Dokter::where('spesialisasi', $poli->nama_poli)->with('user')->get();
        return response()->json($dokters);
    }
}
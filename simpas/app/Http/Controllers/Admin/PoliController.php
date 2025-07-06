<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Poli;
use Illuminate\Http\Request;

class PoliController extends Controller
{
    /**
     * Menampilkan daftar semua poli.
     */
    public function index()
    {
        $polis = Poli::latest()->paginate(10);
        return view('admin.poli.index', compact('polis'));
    }

    /**
     * Menampilkan form untuk membuat poli baru.
     */
    public function create()
    {
        return view('admin.poli.create');
    }

    /**
     * Menyimpan poli baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate(['nama_poli' => 'required|string|max:255|unique:polis']);
        Poli::create($request->all());
        return redirect()->route('admin.poli.index')->with('success', 'Poli baru berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit poli.
     */
    public function edit(Poli $poli)
    {
        return view('admin.poli.edit', compact('poli'));
    }

    /**
     * Memperbarui data poli di database.
     */
    public function update(Request $request, Poli $poli)
    {
        $request->validate(['nama_poli' => 'required|string|max:255|unique:polis,nama_poli,' . $poli->id]);
        $poli->update($request->all());
        return redirect()->route('admin.poli.index')->with('success', 'Data poli berhasil diperbarui.');
    }

    /**
     * Menghapus data poli dari database.
     */
    public function destroy(Poli $poli)
    {
        $poli->delete();
        return redirect()->route('admin.poli.index')->with('success', 'Data poli berhasil dihapus.');
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\hutang;
use App\Models\penitipan;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class hutangcontroller extends Controller
{
    public function index(): View
    {
        $title = 'Hutang';
        $hutang = hutang::with('penitipan')->get();
        return view('hutang.index', compact('hutang', 'title'));
    }

    public function create(): View
    {
        $title = 'Tambah Hutang';
        $penitipan = penitipan::all();
        return view('hutang.create', compact('penitipan', 'title'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'penitipan_id' => 'required|exists:penitipans,id',
            'jumlah_hutang' => 'required|numeric|min:0',
            'jumlah_bayar' => 'required|numeric|min:0',
            'tanggal' => 'required|date',
        ]);

        // Buat hutang baru
        hutang::create([
            'penitipan_id' => $request->penitipan_id,
            'jumlah_hutang' => $request->jumlah_hutang,
            'jumlah_bayar' => $request->jumlah_bayar,
            'tanggal' => $request->tanggal,
            'status' => $request->jumlah_hutang <= $request->jumlah_bayar ? 'lunas' : 'belum_lunas', // Atur status
        ]);

        return redirect()->route('hutang.index')->with('success', 'Data hutang berhasil ditambahkan');
    }

    public function edit(hutang $hutang): View
    {
        $title = 'Edit Hutang';
        $penitipan = penitipan::all();
        return view('hutang.edit', compact('hutang', 'penitipan', 'title'));
    }

    public function update(Request $request, hutang $hutang): RedirectResponse
{
    $request->validate([
        'penitipan_id' => 'required|exists:penitipans,id',
        'jumlah_hutang' => 'required|numeric|min:0',
        'jumlah_bayar' => 'required|numeric|min:0',
        'tanggal' => 'required|date',
    ]);

    // Hitung sisa hutang
    $sisaHutang = $hutang->jumlah_hutang - $request->jumlah_bayar;

    // Tentukan status berdasarkan sisa hutang
    $status = $sisaHutang <= 0 ? 'lunas' : 'belum_lunas';

    // Update data hutang
    $hutang->update([
        'penitipan_id' => $request->penitipan_id,
        'jumlah_hutang' => $request->jumlah_hutang,
        'jumlah_bayar' => $request->jumlah_bayar,
        'tanggal' => $request->tanggal,
        'status' => $status, // Perbarui status secara manual
    ]);

    return redirect()->route('hutang.index')->with('success', 'Data hutang berhasil diubah');
}


    public function destroy(hutang $hutang): RedirectResponse
    {
        $hutang->delete();
        return redirect()->route('hutang.index')->with('success', 'Data hutang berhasil dihapus');
    }
}

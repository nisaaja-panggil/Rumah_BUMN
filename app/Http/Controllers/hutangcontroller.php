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
        $title = 'Hutang'; // Menambahkan variabel title
        $hutang = hutang::with('penitipan')->get();
        return view('hutang.index', compact('hutang', 'title')); // Menyertakan title dalam compact
    }

    public function create(): View
    {
        $title = 'Tambah Hutang'; // Menambahkan variabel title
        $penitipan = penitipan::all(); // Untuk memilih penitipan yang ada
        return view('hutang.create', compact('penitipan', 'title')); // Menyertakan title dalam compact
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'penitipan_id' => 'required|exists:penitipans,id',
            'jumlah_hutang' => 'required|numeric|min:0',
            'jumlah_bayar' => 'required|numeric|min:0',
            'tanggal' => 'required|date',
        ]);

        hutang::create([
            'penitipan_id' => $request->penitipan_id,
            'jumlah_hutang' => $request->jumlah_hutang,
            'jumlah_bayar' => $request->jumlah_bayar,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->route('hutang.index')->with('success', 'Data hutang berhasil ditambahkan');
    }

    public function edit(hutang $hutang): View
    {
        $title = 'Edit Hutang'; // Menambahkan variabel title
        $penitipan = penitipan::all();
        return view('hutang.edit', compact('hutang', 'penitipan', 'title')); // Menyertakan title dalam compact
    }

    public function update(Request $request, hutang $hutang): RedirectResponse
{
    $request->validate([
        'penitipan_id' => 'required|exists:penitipans,id',
        'jumlah_hutang' => 'required|numeric|min:0',
        'jumlah_bayar' => 'required|numeric|min:0',
        'tanggal' => 'required|date',
    ]);

    // Hitung sisa hutang setelah pembayaran
    $sisaHutang = $hutang->jumlah_hutang - $request->jumlah_bayar;

    $hutang->update([
        'penitipan_id' => $request->penitipan_id,
        'jumlah_hutang' => $sisaHutang < 0 ? 0 : $sisaHutang, // Pastikan jumlah hutang tidak negatif
        'jumlah_bayar' => $request->jumlah_bayar,
        'tanggal' => $request->tanggal,
    ]);

    return redirect()->route('hutang.index')->with('success', 'Data hutang berhasil diubah');
}

    public function destroy(hutang $hutang): RedirectResponse
    {
        $hutang->delete();
        return redirect()->route('hutang.index')->with('success', 'Data hutang berhasil dihapus');
    }
}

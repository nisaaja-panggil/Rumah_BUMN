<?php

namespace App\Http\Controllers;

use App\Models\penjualan;
use Illuminate\Http\Request;
use App\Models\kasn;
use App\Models\hutang;
use illuminate\Http\RedirectResponse;
use Illuminate\View\View;
class kascontroller extends Controller
{
    //
    public function index()
    {
        $totalArusMasuk = kasn::where('arus', 'masuk')->sum('total');
        $totalArusKeluar = kasn::where('arus', 'keluar')->sum('total');
    
        return view('kas.index', [
            "title" => "Data Kas",
            "dataMasuk" => kasn::where('arus', 'masuk')->get(),
            "dataKeluar" => kasn::where('arus', 'keluar')->get(),
            "totalArusMasuk" => $totalArusMasuk,
            "totalArusKeluar" => $totalArusKeluar,
        ]);

    }
    public function create()
{
    $penjualan = penjualan::whereDoesntHave('kasn')->get();
    return view('kas.create', compact('penjualan'))->with(["title"=>"Tambah Data Kas"]);
}
public function store(Request $request)
{
    $validasi = $request->validate([
        "penjualan_id" => "required",
        "arus" => "required",
    ]);

    $existingData = kasn::where('penjualan_id', $request->penjualan_id)->first();
    if ($existingData) {
        return redirect()->back()->withErrors(['penjualan_id' => 'Customer ini sudah ada di data kas.']);
    }

    $validasi['tanggal'] = now();
    $validasi['total'] = penjualan::find($request->penjualan_id)->total;

    kasn::create($validasi);

    // Jika arus adalah 'keluar', kita buat entri baru untuk kas keluar.
    if ($validasi['arus'] == 'keluar') {
        kasn::create([
            'penjualan_id' => null, // Tidak terkait dengan penjualan
            'hutang_id' => null, // Terkait dengan hutang (jika ada)
            'arus' => 'keluar',
            'total' => $validasi['total'],
            'tanggal' => now(),
        ]);
    }

    return redirect()->route('kas.index')->with('success', 'Data kas berhasil ditambahkan');
}

}
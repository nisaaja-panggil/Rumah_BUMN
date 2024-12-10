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
    
        return view('kas.index', [
            "title" => "Data Kas",
            "data" => kasn::all(),
            "totalArusMasuk" => $totalArusMasuk,
        ]);
    }
    public function create()
{
    $penjualan = penjualan::whereDoesntHave('kasn')->get();
    return view('kas.create', compact('penjualan'))->with(["title"=>"Tambah Data Kas"]);
}
    public function store(Request $request){
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
    
        return redirect()->route('kas.index')->with('success', 'Data kas berhasil ditambahkan');}
}
<?php

namespace App\Http\Controllers;

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
        return view('kasn.tabel', [
            "title" => "kasn",
            "data" => kasn::all()
        ]);
    }
    public function create():View{
        return view('kasn.tambah')->with(["title"=>"tambah data kasn"]);
    }
    public function store(Request $request): RedirectResponse
{ 
    $request->validate([
        "nama_umkm" => "required",
        "merek" => "required",
        "jumlah_titip" => "required|numeric|min:1",
        "harga_satuan" => "required|numeric|min:0",
        "harga_bayar" => "required|numeric|min:0",
        "status"=>"nullable",
        "tanggal" => "required|date",
    ]);

    // Simpan data kasn
    $kasn = kasn::create($request->all());

    $statuskasn = $kasn->status;

    // Simpan data hutang
    hutang::create([
        
        'kasn_id' => $kasn->id,
        'jumlah_hutang' => $request->harga_bayar, // jumlah_hutang disamakan dengan harga_bayar
        'tanggal' => $request->tanggal,
        'status' => $statuskasn,
    ]);

    return redirect()->route('kasn.index')->with('success', 'Data kasn dan hutang berhasil ditambahkan');
}



    public function edit(kasn $kasn): View {
    return view('kasn.edit', compact('kasn'))->with(["title"=>"ubah data kasn"]);
}

public function update(Request $request, kasn $kasn): RedirectResponse {
    $request->validate([
        "nama_umkm"=>"required",
            "merek"=>"required",
            "jumlah_titip"=>"required",
            "harga_satuan"=>"required",
            "harga_bayar"=>"required",
            "status"=>"nullable",
    ]);
    $kasn->update($request->all());
    return redirect()->route('kasn.index')->with('updated', 'data umkm berhasil di ubah');
}

    public function destroy($id){
        kasn::where('id',$id)->Delete();
        return redirect()->route(('kasn.index'))->with('success', 'produk berhasil dihapus');;
    }
}


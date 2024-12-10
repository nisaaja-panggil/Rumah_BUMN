<?php

namespace App\Livewire;

use App\Models\detail_penjualan;
use App\Models\penjualan;
use App\Models\produk;
use App\Models\kasn;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class Orders extends Component
{

    public $total;
    public $penjualan_id;
    public $produk_id;
    public $qty = 1;
    public $uang = 0; // Tambahkan properti uang
    public $kembali = 0;
    public $diskon = 0;  // Tambahkan properti untuk diskon
public $totalSetelahDiskon = 0; // Tambahkan properti untuk total setelah diskon

    public function render()
{
    
    $penjualan = penjualan::select('*')->where('user_id', '=', Auth::user()->id)->orderBy('id', 'desc')->first();
    
    $this->total = $penjualan->total ?? 0; // Pastikan ada nilai default
        $this->totalSetelahDiskon = $this->total - $this->diskon; // Menghitung total setelah diskon
    $this->kembali = $this->uang - $this->totalSetelahDiskon;

        return view('livewire.orders')
            ->with("data", $penjualan)
            ->with("dataproduct", produk::where('stok', '>', '0')->get())
            ->with("datadetail_penjualan", detail_penjualan::where('penjualan_id', '=', $penjualan->id)->get());
    
            
}
public function updatedUang($value)
{
    $this->kembali = $value - $this->total;
}

public function store()
{
    $this->validate([
        'produk_id' => 'required'
    ]);
    
    // Ambil data penjualan terbaru
    $penjualan = penjualan::select('*')->where('user_id', '=', Auth::user()->id)->orderBy('id', 'desc')->first();
    $this->penjualan_id = $penjualan->id;
    
    // Ambil data produk berdasarkan produk_id, menggunakan first() bukan get()
    $produk = produk::where('id', '=', $this->produk_id)->first(); // Menggunakan first() untuk mendapatkan objek produk
    if (!$produk) {
        session()->flash('error', 'Produk tidak ditemukan');
        return;
    }
    
    $harga = $produk->price;
    
    // Cek apakah stok mencukupi
    if ($produk->stok < $this->qty) {
        session()->flash('error', 'Stok tidak mencukupi');
        return;
    }
    
    // Menyimpan detail penjualan
    detail_penjualan::create([
        'penjualan_id' => $this->penjualan_id,
        'produk_id' => $this->produk_id,
        'qty' => $this->qty,
        'price' => $harga
    ]);
    
    // Mengupdate total penjualan
    $total = $penjualan->total;
    $total = $total + ($harga * $this->qty);
    penjualan::where('id', '=', $this->penjualan_id)->update([
        'total' => $total
    ]);
   
    
    // Mengurangi stok produk setelah transaksi
    $stok = $produk->stok - $this->qty; // Mengurangi stok berdasarkan kuantitas
    produk::where('id', '=', $this->produk_id)->update([
        'stok' => $stok
    ]);
    
    // Reset input form
    $this->produk_id = NULL;
    $this->qty = 1;
}

    public function delete($detail_penjualan_id)
    {
        $detail_penjualan = detail_penjualan::find($detail_penjualan_id);
        $detail_penjualan->delete();

        //update total
        $detail_penjualan = detail_penjualan::select('*')->where('penjualan_id', '=', $this->penjualan_id)->get();
        $total = 0;
        foreach ($detail_penjualan as $od) {
            $total += $od->qty * $od->price;
        }

        try {
            penjualan::where('id', '=', $this->penjualan_id)->update([
                'total' => $total
            ]);
        } catch (Exception $e) {
            dd($e);
        }
    }
public function receipt($id){
    $detail_penjualan=detail_penjualan::select('*')->where('penjualan_id','=',$id)->get();
    foreach($detail_penjualan as $od){
        $stoklama=produk::select('stok')->where('id','=',$od->produk_id)->sum('stok');
        $stok=$stoklama-$od->qty;  
        try{
        produk::where('id','=',$od->produk_id)->update([
            'stok'=>$stok
        ]);
        } catch (Exception $e){
            dd($e);
        }
    }
    return Redirect::Route('cetakReceipt')->with(['id'=>$id]);
}
public function riwayat()
{
    $title = 'Riwayat Penjualan';

    // Mengambil riwayat penjualan dengan detail produk
    $riwayatPenjualan = penjualan::with(['detail_penjualan.produk']) // Mengambil detail penjualan dan produk
        ->orderBy('created_at', 'desc') // Mengurutkan berdasarkan waktu penjualan
        ->get();

    // Mengirim data ke view riwayat-penjualan.blade.php
    return view('livewire.riwayat-penjualan', compact('title', 'riwayatPenjualan'));
}
}
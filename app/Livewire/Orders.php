<?php

namespace App\Livewire;

use App\Models\detail_penjualan;
use App\Models\penjualan;
use App\Models\produk;
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
    public $uang;
  
    public $kembali;

    public function render()
{
    $penjualan = penjualan::select('*')->where('user_id', '=', Auth::user()->id)->orderBy('id', 'desc')->first();
    
    $this->total = $penjualan->total;
        $this->kembali = $this->uang - $this->total;
        return view('livewire.orders')
            ->with("data", $penjualan)
            ->with("dataproduct", produk::where('stok', '<', '0')->get())
            ->with("datadetail_penjualan", detail_penjualan::where('penjualan_id', '=', $penjualan->id)->get());
    
}

    public function store()
    {
        $this->validate([

            'produk_id' => 'required'
        ]);
        $penjualan = Penjualan::where('user_id', '=', Auth::user()->id)->orderBy('id', 'desc')->first();

if ($penjualan) {
    $detail_penjualan = detail_penjualan::where('penjualan_id', '=', $penjualan->id)
        ->orderBy('id', 'desc')
        ->first();
    $this->total = $detail_penjualan->total ?? 0;
}
        $this->penjualan_id = $penjualan->id;
        $produk = produk::where('id', '=', $this->produk_id)->get();
        $harga = $produk[0]->price;
        detail_penjualan::create([
            'penjualan_id' => $this->penjualan_id,
            'produk_id' => $this->produk_id,
            'qty' => $this->qty,
            'price' => $harga
        ]);


        $total = $penjualan->total;
        $total = $total + ($harga * $this->qty);
        penjualan::where('id', '=', $this->penjualan_id)->update([
            'total' => $total
        ]);
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

}
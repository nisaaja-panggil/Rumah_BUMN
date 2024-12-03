<?php
namespace App\Livewire;


use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\penjualan;

class Penjualans extends Component
{
    public $nama_customer;

    public function render()
    {
        return view('livewire.penjualans');
    }

    public function store()
{
    // Validasi input
    $this->validate([
        'nama_customer' => 'required|string|max:255',
    ]);

    // Buat data transaksi baru di tabel penjualans
    $penjualan = Penjualan::create([
        'invoice' => $this->generateInvoice(),
        'user_id' => Auth::id(),
        'nama_customer' => $this->nama_customer, // Tambahkan nama_customer
        'total' => 0, // Default total awal
    ]);

    // Redirect ke halaman order setelah menyimpan
    return redirect()->route('orders.show', ['id' => $penjualan->id])
    ->with('success', 'Transaksi berhasil dibuat!');
}

    // Fungsi untuk menghasilkan nomor invoice
    private function generateInvoice()
    {
        $lastInvoice = Penjualan::latest('id')->first();
        $lastNumber = $lastInvoice ? intval(substr($lastInvoice->invoice, 4)) : 0;
        return 'INV-' . str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
    }
} 
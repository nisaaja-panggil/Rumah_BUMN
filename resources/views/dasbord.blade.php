@extends('layout.template')

@section('judulh1', 'Dashboard')

@section('konten')
<div class="row">
    <!-- Section Profil -->
    <div class="col-md-12">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title">Selamat Datang di Rumah BUMN Aceh Tamiang</h3>
            </div>
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-4 text-center">
                        <img src="{{ asset('dist/img/bu.jpg') }}" alt="Rumah BUMN Aceh Tamiang" class="img-fluid rounded-circle shadow-sm" style="max-height: 200px;">
                    </div>
                    <div class="col-md-8">
                        <h5>Sejarah Singkat</h5>
                        <p>
                            Rumah BUMN didirikan oleh Kementerian BUMN bersama perusahaan milik negara sebagai rumah bersama untuk berkumpul, belajar, dan membina para pelaku UKM menjadi UKM Indonesia yang berkualitas.
                        </p>
                        <h5>Visi dan Misi</h5>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check-circle text-success"></i> Peningkatan Kompetensi</li>
                            <li><i class="fas fa-check-circle text-success"></i> Peningkatan Akses Pemasaran</li>
                            <li><i class="fas fa-check-circle text-success"></i> Kemudahan Akses Permodalan</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section Kontak -->
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-secondary text-white">
                <h5 class="card-title mb-0">Kontak Informasi</h5>
            </div>
            <div class="card-body">
                <ul class="list-unstyled">
                    <li><strong>Alamat:</strong> Jl. Rantau, Bukit Tempurung, Kota Kuala Simpang</li>
                    <li><strong>Telepon:</strong> 0823-2000-3866</li>
                    <li><strong>Email:</strong> <a href="mailto:rkbacehtamiang@gmail.com">rkbacehtamiang@gmail.com</a></li>
                    <li><strong>Instagram:</strong> <a href="https://www.instagram.com/rumahbumnacehtamiang" target="_blank">@rumahbumnacehtamiang</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Section Petunjuk Penggunaan -->
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-info text-white">
                <h5 class="card-title mb-0">Petunjuk Penggunaan</h5>
            </div>
            <div class="card-body">
                <p>Gunakan menu navigasi untuk:</p>
                <ul>
                    <li>Melihat daftar produk umkm</li>
                    <li>Melakukan transaksi penjualan</li>
                    <li>Melihat riwayat penjualan dan kas</li>
                    <li>Melihat data hutang dan penitipan</li>
                </ul>
                <p>Hubungi admin jika memerlukan bantuan lebih lanjut.</p>
            </div>
        </div>
    </div>
</div>
@endsection

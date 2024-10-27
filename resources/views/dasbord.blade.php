@extends('layout.template')

@section('judulh1', 'Dashboard Penjualan UMKM')

@section('konten')

<!-- Ringkasan Penjualan -->
<div class="row justify-content-center text-center mb-4">
    <div class="col-md-3">
        <div class="small-box bg-info p-3">
            <div class="inner">
                <h4>Total Penjualan</h4>
                <h3>Rp. {{ number_format(15000000, 0, ',', '.') }}</h3>
            </div>
            <div class="icon">
                <i class="fas fa-shopping-cart"></i>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="small-box bg-success p-3">
            <div class="inner">
                <h4>Total Produk Terjual</h4>
                <h3>120</h3>
            </div>
            <div class="icon">
                <i class="fas fa-box"></i>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="small-box bg-warning p-3">
            <div class="inner">
                <h4>Total Pelanggan</h4>
                <h3>85</h3>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>
</div>

<!-- Grafik Penjualan -->
<div class="row mt-5">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Grafik Penjualan</h3>
            </div>
            <div class="card-body">
                <canvas id="salesChart" style="height: 300px;"></canvas>
            </div>
        </div>
    </div>
</div>

@endsection

@section('tambahanJS')
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
<script>
    var ctx = document.getElementById('salesChart').getContext('2d');
    var salesChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['2024-01-01', '2024-01-02', '2024-01-03'],
            datasets: [{
                label: 'Total Penjualan',
                data: [1500000, 2000000, 1700000],
                borderColor: 'rgba(60,141,188,1)',
                backgroundColor: 'rgba(60,141,188,0.5)',
                fill: true
            }]
        },
        options: {
            maintainAspectRatio: false,
            responsive: true,
            scales: {
                x: {
                    display: true,
                    title: {
                        display: true,
                        text: 'Tanggal'
                    }
                },
                y: {
                    display: true,
                    title: {
                        display: true,
                        text: 'Jumlah Penjualan (Rp)'
                    }
                }
            }
        }
    });
</script>
@endsection

@extends('layout.template')
@section('tambahanCSS')
<!-- DataTables -->
<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<!-- Toastr -->
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
@endsection
@section('judulh1','Admin - kas')
@section('konten')
<div class="col-md-12">
    <div class="card card-info">
        <div class="card-header">
            <h2 class="card-title">Data kas</h2>
            <a type="button" class="btn btn-success float-right" href="{{ route('kas.create') }}">
                <i class=" fas fa-plus"></i>Tambah kas
            </a>
        </div>
        <!-- /.card-header -->

        <div class="card-body">
            <!-- Tambahkan total arus masuk di sini -->
            <div class="col-md-12">
                <h4>Total Arus Masuk: @money($totalArusMasuk )</h4>
                <h4>Total Arus Keluar: @money($totalArusKeluar)</h4>
            
                <!-- Tabel Arus Masuk -->
                <h5>Arus Masuk</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>nama customer</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataMasuk as $item)
                            <tr>
                                <td>{{ $item->tanggal }}</td>
                                <td>{{ $item->penjualan->nama_customer }}</td>
                                <td>{{ $item->penjualan->total }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            
                <!-- Tabel Arus Keluar -->
                <h5>Arus Keluar</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Hutang ID</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataKeluar as $item)
                            <tr>
                                <td>{{ $item->tanggal }}</td>
                                <td>{{ $item->hutang->penitipan_id }}</td>
                                <td>{{ $item->total }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
@endsection

@section('tambahanJS')
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@endsection

@section('tambahScript')
<script>
    document.getElementById('penjualan_id').addEventListener('change', function () {
        const selectedOption = this.options[this.selectedIndex];
        const totalPesanan = selectedOption.getAttribute('data-total');
        document.getElementById('total_pesanan').value = totalPesanan || '0';
    });

    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "responsive": true,
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });

    @if($message = Session::get('success'))
    toastr.success("{{ $message }}");
    @endif
    @if($message = Session::get('updated'))
    toastr.warning("{{ $message }}");
    @endif
</script>
@endsection

@extends('layout.template')

@section('tambahanCSS')
<!-- DataTables -->
<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<!-- Toastr -->
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
@endsection

@section('judulh1','Admin - Hutang')

@section('konten')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Hutang</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="hutangTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama UMKM</th>
                                <th>Jumlah Hutang</th>
                                <th>Jumlah Bayar</th>
                                <th>Sisa Hutang</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($hutang as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->penitipan->nama_umkm ?? '-' }}</td>
                                <td>Rp {{ number_format($item->jumlah_hutang, 2) }}</td>
                                <td>Rp {{ number_format($item->jumlah_bayar, 2) }}</td>
                                <td>Rp {{ number_format($item->sisa_hutang, 2) }}</td>
                                <td>{{ $item->status }}</td>
                                <td>{{ $item->tanggal }}</td>
                                <td>
                                    <a href="{{ route('hutang.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('hutang.destroy', $item->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
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
$(function() {
    $("#example1").DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "responsive": true,
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
});

@if($message = Session::get('success'))
toastr.success("{{ $message}}");
@endif
@if($message = Session::get('updated'))
toastr.warning("{{ $message}}");
@endif
</script>
@endsection

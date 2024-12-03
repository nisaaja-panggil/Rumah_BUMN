<div>
    {{-- Be like water. --}}
    <div class="row">
        <div class="d-flex aligns-items-center justify-content-center">
        <div class="col-6">
            <div class="card ">
                <div class="card-header">
                    <h5 class="card-title">Invoice</h5>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form wire:submit.prevent="store" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama_customer">Nama Customer</label>
                        <input type="text" class="form-control" id="nama_customer" wire:model.defer="nama_customer" placeholder="Nama Lengkap">
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-success btn-sm">Submit</button>
                </div>
            </form>
            </div>
        </div>
        </div>
        </div>            
</div>
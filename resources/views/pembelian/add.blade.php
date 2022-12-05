@extends('pembelian.layout')

@section('content')

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
        @foreach($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach
        </ul>
    </div>
@endif

<div class="card mt-4">
	<div class="card-body">

        <h5 class="card-title fw-bolder mb-3">Tambah Pembelian</h5>

		<form method="post" action="{{ route('pembelian.store') }}">
			@csrf
            <div class="mb-3">
                <label for="id_pembeli" class="form-label">ID Pembeli</label>
                <input type="text" class="form-control" id="id_pembeli" name="id_pembeli">
            </div>
			<div class="mb-3">
                <label for="id_motor" class="form-label">ID motor</label>
                <input type="text" class="form-control" id="id_motor" name="id_motor">
            </div>
            <div class="mb-3">
                <label for="jumlah_pembelian" class="form-label">Jumlah Pembelian</label>
                <input type="text" class="form-control" id="jumlah_pembelian" name="jumlah_pembelian">
            </div>
            <div class="mb-3">
                <label for="total_harga" class="form-label">Total Harga</label>
                <input type="total_harga" class="form-control" id="total_harga" name="total_harga">
            </div>
			<div class="text-center">
				<input type="submit" class="btn btn-primary" value="Tambah" />
			</div>
		</form>
	</div>
</div>

@stop
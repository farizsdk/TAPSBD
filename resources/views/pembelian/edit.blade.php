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

        <h5 class="card-title fw-bolder mb-3">Ubah Data Pembelian</h5>

		<form method="post" action="{{ route('pembelian.update', $data->id_pembeli) }}">
			@csrf
            <div class="mb-3">
                <label for="id_pembeli" class="form-label">ID Pembeli</label>
                <input type="text" class="form-control" id="id_pembeli" name="id_pembeli" value="{{ $data->id_pembeli }}">
            </div>
			<div class="mb-3">
                <label for="id_album" class="form-label">ID Album</label>
                <input type="text" class="form-control" id="id_album" name="id_album" value="{{ $data->id_album }}">
            </div>
            <div class="mb-3">
                <label for="jumlah_pembelian" class="form-label">Jumlah Pembelian</label>
                <input type="text" class="form-control" id="jumlah_pembelian" name="jumlah_pembelian" value="{{ $data->jumlah_pembelian }}">
            </div>
            <div class="mb-3">
                <label for="total_harga" class="form-label">Total Harga</label>
                <input type="total_harga" class="form-control" id="total_harga" name="total_harga">
            </div>
			<div class="text-center">
				<input type="submit" class="btn btn-primary" value="Ubah" />
			</div>
		</form>
	</div>
</div>

@stop
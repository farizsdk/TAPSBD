@extends('motor.layout')

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

        <h5 class="card-title fw-bolder mb-3">Ubah Data motor</h5>

		<form method="post" action="{{ route('motor.update', $data->id_motor) }}">
			@csrf
            <div class="mb-3">
                <label for="id_motor" class="form-label">ID motor</label>
                <input type="text" class="form-control" id="id_motor" name="id_motor" value="{{ $data->id_motor }}">
            </div>
			<div class="mb-3">
                <label for="nama_motor" class="form-label">Nama motor</label>
                <input type="text" class="form-control" id="nama_motor" name="nama_motor" value="{{ $data->nama_motor }}">
            </div>
            <div class="mb-3">
                <label for="harga_motor" class="form-label">Harga</label>
                <input type="text" class="form-control" id="harga_motor" name="harga_motor" value="{{ $data->harga_motor }}">
            </div>
            <div class="mb-3">
                <label for="stok_motor" class="form-label">Stok</label>
                <input type="stok_motor" class="form-control" id="stok_motor" name="stok_motor">
            </div>
            <div class="mb-3">
                <label for="id_merk" class="form-label">ID merk</label>
                <input type="id_merk" class="form-control" id="id_merk" name="id_merk">
            </div>
			<div class="text-center">
				<input type="submit" class="btn btn-primary" value="Ubah" />
			</div>
		</form>
	</div>
</div>

@stop
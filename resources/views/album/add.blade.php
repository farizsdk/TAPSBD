@extends('album.layout')

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

        <h5 class="card-title fw-bolder mb-3">Tambah Album</h5>

		<form method="post" action="{{ route('album.store') }}">
			@csrf
            <div class="mb-3">
                <label for="id_album" class="form-label">ID Album</label>
                <input type="text" class="form-control" id="id_album" name="id_album">
            </div>
			<div class="mb-3">
                <label for="nama_album" class="form-label">Nama Album</label>
                <input type="text" class="form-control" id="nama_album" name="nama_album">
            </div>
            <div class="mb-3">
                <label for="harga_album" class="form-label">Harga</label>
                <input type="text" class="form-control" id="harga_album" name="harga_album">
            </div>
            <div class="mb-3">
                <label for="stok_album" class="form-label">Stok</label>
                <input type="stok_album" class="form-control" id="stok_album" name="stok_album">
            </div>
            <div class="mb-3">
                <label for="id_penyanyi" class="form-label">ID Penyanyi</label>
                <input type="id_penyanyi" class="form-control" id="id_penyanyi" name="id_penyanyi">
            </div>
			<div class="text-center">
				<input type="submit" class="btn btn-primary" value="Tambah" />
			</div>
		</form>
	</div>
</div>

@stop
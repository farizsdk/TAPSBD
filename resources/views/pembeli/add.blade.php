@extends('pembeli.layout')

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

        <h5 class="card-title fw-bolder mb-3">Tambah Pembeli</h5>

		<form method="post" action="{{ route('pembeli.store') }}">
			@csrf
            <div class="mb-3">
                <label for="id_pembeli" class="form-label">ID Pembeli</label>
                <input type="text" class="form-control" id="id_pembeli" name="id_pembeli">
            </div>
			<div class="mb-3">
                <label for="nama_pembeli" class="form-label">Nama Pembeli</label>
                <input type="text" class="form-control" id="nama_pembeli" name="nama_pembeli">
            </div>
            <div class="mb-3">
                <label for="username_pembeli" class="form-label">Username</label>
                <input type="text" class="form-control" id="username_pembeli" name="username_pembeli">
            </div>
            <div class="mb-3">
                <label for="pass_pembeli" class="form-label">Password</label>
                <input type="pass_pembeli" class="form-control" id="pass_pembeli" name="pass_pembeli">
            </div>
			<div class="text-center">
				<input type="submit" class="btn btn-primary" value="Tambah" />
			</div>
		</form>
	</div>
</div>

@stop
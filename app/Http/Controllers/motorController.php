<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class motorController extends Controller
{
    public function index(Request $request) {
        $datas = DB::select('SELECT motor.id_motor,  motor.nama_motor, motor.harga_motor, motor.stok_motor,
        merk.id_merk, merk.nama_merk
        FROM motor 
        LEFT JOIN merk 
        ON motor.id_merk = merk.id_merk WHERE motor.deleted = 0');

        return view('motor.index')
            ->with('datas', $datas);
    }

    public function create() {
        return view('motor.add');
    }

    public function store(Request $request) {
        $request->validate([
            'id_motor' => 'required',
            'nama_motor' => 'required',
            'harga_motor' => 'required',
            'stok_motor' => 'required',
            'id_merk' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::insert('INSERT INTO motor(id_motor, nama_motor, harga_motor, stok_motor, id_merk) 
        VALUES (:id_motor, :nama_motor, :harga_motor, :stok_motor, :id_merk)',
        [
            'id_motor' => $request->id_motor,
            'nama_motor' => $request->nama_motor,
            'harga_motor' => $request->harga_motor,
            'stok_motor' => $request->stok_motor,
            'id_merk' => $request->id_merk,
        ]
        );

        // Menggunakan laravel eloquent
        // Pembeli::create([
        //     'id_pembeli' => $request->id_pembeli,
        //     'nama_pembeli' => $request->nama_pembeli,
        //     'username_pembeli' => $request->username_pembeli,
        //     'pass_pembeli' => Hash::make($request->pass_pembeli),
        // ]);

        return redirect()->route('motor.index')->with('success', 'Data motor berhasil disimpan');
    }

    public function edit($id) {
        $data = DB::table('motor')->where('id_motor', $id)->first();

        return view('motor.edit')->with('data', $data);
    }

    public function update($id, Request $request) {
        $request->validate([
            'id_motor' => 'required',
            'nama_motor' => 'required',
            'harga_motor' => 'required',
            'stok_motor' => 'required',
            'id_merk' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update('UPDATE motor SET id_motor = :id_motor, nama_motor = :nama_motor, harga_motor = :harga_motor, stok_motor = :stok_motor, id_merk = :id_merk WHERE id_motor = :id',
        [
            'id' => $id,
            'id_motor' => $request->id_motor,
            'nama_motor' => $request->nama_motor,
            'harga_motor' => $request->harga_motor,
            'stok_motor' => $request->stok_motor,
            'id_merk' => $request->id_merk,
        ]
        );

        // Menggunakan laravel eloquent
        // Pembeli::where('id_pembeli', $id)->update([
        //     'id_pembeli' => $request->id_pembeli,
        //     'nama_pembeli' => $request->nama_pembeli,
        //     'username_pembeli' => $request->username_pembeli,
        //     'pass_pembeli' => Hash::make($request->pass_pembeli),
        // ]);

        return redirect()->route('motor.index')->with('success', 'Data motor berhasil diubah');
    }

    public function delete($id) {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::delete('DELETE FROM motor WHERE id_motor = :id_motor', ['id_motor' => $id]);

        // Menggunakan laravel eloquent
        // Pembeli::where('id_pembeli', $id)->delete();

        return redirect()->route('motor.index')->with('success', 'Data motor berhasil dihapus');
    }

    public function softdelete($id) {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update('UPDATE motor SET deleted = 1 WHERE id_motor = :id_motor', ['id_motor' => $id]);

        // Menggunakan laravel eloquent
        // Pembeli::where('id_pembeli', $id)->delete();

        return redirect()->route('motor.index')->with('success', 'Data motor berhasil disembunyikan');
    }

}

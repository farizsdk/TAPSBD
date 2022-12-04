<?php

namespace App\Http\Controllers;

use App\Models\Pembeli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PembeliController extends Controller
{
    public function index() {
        $datas = DB::select('select * from pembeli WHERE pembeli.deleted = 0');

        return view('pembeli.index')
            ->with('datas', $datas);
    }

    public function create() {
        return view('pembeli.add');
    }

    public function store(Request $request) {
        $request->validate([
            'id_pembeli' => 'required',
            'nama_pembeli' => 'required',
            'username_pembeli' => 'required',
            'pass_pembeli' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::insert('INSERT INTO pembeli(id_pembeli, nama_pembeli, username_pembeli, pass_pembeli) 
        VALUES (:id_pembeli, :nama_pembeli, :username_pembeli, :pass_pembeli)',
        [
            'id_pembeli' => $request->id_pembeli,
            'nama_pembeli' => $request->nama_pembeli,
            'username_pembeli' => $request->username_pembeli,
            'pass_pembeli' => $request->pass_pembeli,
        ]
        );

        // Menggunakan laravel eloquent
        // Pembeli::create([
        //     'id_pembeli' => $request->id_pembeli,
        //     'nama_pembeli' => $request->nama_pembeli,
        //     'username_pembeli' => $request->username_pembeli,
        //     'pass_pembeli' => Hash::make($request->pass_pembeli),
        // ]);

        return redirect()->route('pembeli.index')->with('success', 'Data Pembeli berhasil disimpan');
    }

    public function edit($id) {
        $data = DB::table('pembeli')->where('id_pembeli', $id)->first();

        return view('pembeli.edit')->with('data', $data);
    }

    public function update($id, Request $request) {
        $request->validate([
            'id_pembeli' => 'required',
            'nama_pembeli' => 'required',
            'username_pembeli' => 'required',
            'pass_pembeli' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update('UPDATE pembeli SET id_pembeli = :id_pembeli, nama_pembeli = :nama_pembeli, username_pembeli = :username_pembeli, pass_pembeli = :pass_pembeli WHERE id_pembeli = :id',
        [
            'id' => $id,
            'id_pembeli' => $request->id_pembeli,
            'nama_pembeli' => $request->nama_pembeli,
            'username_pembeli' => $request->username_pembeli,
            'pass_pembeli' => $request->pass_pembeli,
        ]
        );

        // Menggunakan laravel eloquent
        // Pembeli::where('id_pembeli', $id)->update([
        //     'id_pembeli' => $request->id_pembeli,
        //     'nama_pembeli' => $request->nama_pembeli,
        //     'username_pembeli' => $request->username_pembeli,
        //     'pass_pembeli' => Hash::make($request->pass_pembeli),
        // ]);

        return redirect()->route('pembeli.index')->with('success', 'Data Pembeli berhasil diubah');
    }

    public function delete($id) {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::delete('DELETE FROM pembeli WHERE id_pembeli = :id_pembeli', ['id_pembeli' => $id]);

        // Menggunakan laravel eloquent
        // Pembeli::where('id_pembeli', $id)->delete();

        return redirect()->route('pembeli.index')->with('success', 'Data Pembeli berhasil dihapus');
    }

    public function softdelete($id) {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update('UPDATE pembeli SET deleted = 1 WHERE id_pembeli = :id_pembeli', ['id_pembeli' => $id]);

        // Menggunakan laravel eloquent
        // Pembeli::where('id_pembeli', $id)->delete();

        return redirect()->route('pembeli.index')->with('success', 'Data Pembeli berhasil disembunyikan');
    }

}
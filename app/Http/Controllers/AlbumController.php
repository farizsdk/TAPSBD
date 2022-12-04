<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AlbumController extends Controller
{
    public function index(Request $request) {
        $datas = DB::select('SELECT album.id_album,  album.nama_album, album.harga_album, album.stok_album,
        penyanyi.id_penyanyi, penyanyi.nama_penyanyi
        FROM album 
        LEFT JOIN penyanyi 
        ON album.id_penyanyi = penyanyi.id_penyanyi WHERE album.deleted = 0');

        return view('album.index')
            ->with('datas', $datas);
    }

    public function create() {
        return view('album.add');
    }

    public function store(Request $request) {
        $request->validate([
            'id_album' => 'required',
            'nama_album' => 'required',
            'harga_album' => 'required',
            'stok_album' => 'required',
            'id_penyanyi' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::insert('INSERT INTO album(id_album, nama_album, harga_album, stok_album, id_penyanyi) 
        VALUES (:id_album, :nama_album, :harga_album, :stok_album, :id_penyanyi)',
        [
            'id_album' => $request->id_album,
            'nama_album' => $request->nama_album,
            'harga_album' => $request->harga_album,
            'stok_album' => $request->stok_album,
            'id_penyanyi' => $request->id_penyanyi,
        ]
        );

        // Menggunakan laravel eloquent
        // Pembeli::create([
        //     'id_pembeli' => $request->id_pembeli,
        //     'nama_pembeli' => $request->nama_pembeli,
        //     'username_pembeli' => $request->username_pembeli,
        //     'pass_pembeli' => Hash::make($request->pass_pembeli),
        // ]);

        return redirect()->route('album.index')->with('success', 'Data Album berhasil disimpan');
    }

    public function edit($id) {
        $data = DB::table('album')->where('id_album', $id)->first();

        return view('album.edit')->with('data', $data);
    }

    public function update($id, Request $request) {
        $request->validate([
            'id_album' => 'required',
            'nama_album' => 'required',
            'harga_album' => 'required',
            'stok_album' => 'required',
            'id_penyanyi' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update('UPDATE album SET id_album = :id_album, nama_album = :nama_album, harga_album = :harga_album, stok_album = :stok_album, id_penyanyi = :id_penyanyi WHERE id_album = :id',
        [
            'id' => $id,
            'id_album' => $request->id_album,
            'nama_album' => $request->nama_album,
            'harga_album' => $request->harga_album,
            'stok_album' => $request->stok_album,
            'id_penyanyi' => $request->id_penyanyi,
        ]
        );

        // Menggunakan laravel eloquent
        // Pembeli::where('id_pembeli', $id)->update([
        //     'id_pembeli' => $request->id_pembeli,
        //     'nama_pembeli' => $request->nama_pembeli,
        //     'username_pembeli' => $request->username_pembeli,
        //     'pass_pembeli' => Hash::make($request->pass_pembeli),
        // ]);

        return redirect()->route('album.index')->with('success', 'Data Album berhasil diubah');
    }

    public function delete($id) {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::delete('DELETE FROM album WHERE id_album = :id_album', ['id_album' => $id]);

        // Menggunakan laravel eloquent
        // Pembeli::where('id_pembeli', $id)->delete();

        return redirect()->route('album.index')->with('success', 'Data Album berhasil dihapus');
    }

    public function softdelete($id) {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update('UPDATE album SET deleted = 1 WHERE id_album = :id_album', ['id_album' => $id]);

        // Menggunakan laravel eloquent
        // Pembeli::where('id_pembeli', $id)->delete();

        return redirect()->route('album.index')->with('success', 'Data Album berhasil disembunyikan');
    }

}

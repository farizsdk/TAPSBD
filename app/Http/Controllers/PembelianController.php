<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PembelianController extends Controller
{
    public function index(Request $request) {
        if($request->has('search')){

            $search = $request->search;

            $datas = DB::select("SELECT pembelian.id_pembeli, pembelian.id_motor, pembelian.jumlah_pembelian, pembelian.total_harga, 
            pembeli.id_pembeli, pembeli.nama_pembeli, 
            motor.id_motor, motor.nama_motor 
            FROM pembelian LEFT JOIN pembeli 
            ON pembelian.id_pembeli = pembeli.id_pembeli 
            LEFT JOIN motor 
            ON motor.id_motor = pembelian.id_motor
            WHERE pembeli.nama_pembeli LIKE :search",
            
            [
                "search" => '%'.$search.'%'
            ]
            
        );
    
            return view('pembelian.index', ['datas'=> $datas]);
        }
       else{
             $datas = DB::select('SELECT pembelian.id_pembeli, pembelian.id_motor, pembelian.jumlah_pembelian, pembelian.total_harga, 
            pembeli.id_pembeli, pembeli.nama_pembeli, 
            motor.id_motor, motor.nama_motor 
            FROM pembelian LEFT JOIN pembeli 
            ON pembelian.id_pembeli = pembeli.id_pembeli 
            LEFT JOIN motor 
            ON motor.id_motor = pembelian.id_motor');

            return view('pembelian.index')
            ->with('datas', $datas);
       }
    }

    public function create() {
        return view('pembelian.add');
    }

    public function store(Request $request) {
        $request->validate([

            'id_pembeli' => 'required',
            'id_motor' => 'required',
            'jumlah_pembelian' => 'required',
            'total_harga' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::insert('INSERT INTO pembelian(id_pembeli, id_motor, jumlah_pembelian, total_harga) 
        VALUES (:id_pembeli, :id_motor, :jumlah_pembelian, :total_harga)',
        [
            'id_pembeli' => $request->id_pembeli,
            'id_motor' => $request->id_motor,
            'jumlah_pembelian' => $request->jumlah_pembelian,
            'total_harga' => $request->total_harga,
        ]
        );

        // Menggunakan laravel eloquent
        // Pembeli::create([
        //     'id_pembeli' => $request->id_pembeli,
        //     'nama_pembeli' => $request->nama_pembeli,
        //     'username_pembeli' => $request->username_pembeli,
        //     'pass_pembeli' => Hash::make($request->pass_pembeli),
        // ]);

        return redirect()->route('pembelian.index')->with('success', 'Data Pembelian berhasil disimpan');
    }

    public function edit($id) {
        $data = DB::table('pembelian')->where('id_pembeli', $id)->first();

        return view('pembelian.edit')->with('data', $data);
    }

    public function update($id, Request $request) {
        $request->validate([
            'id_pembeli' => 'required',
            'id_motor' => 'required',
            'jumlah_pembelian' => 'required',
            'total_harga' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update('UPDATE pembelian SET id_pembeli = :id_pembeli, id_motor = :id_motor, jumlah_pembelian = :jumlah_pembelian, total_harga = :total_harga WHERE id_pembeli = :id',
        [
            'id' => $id,
            'id_pembeli' => $request->id_pembeli,
            'id_motor' => $request->id_motor,
            'jumlah_pembelian' => $request->jumlah_pembelian,
            'total_harga' => $request->total_harga,
        ]
        );

        // Menggunakan laravel eloquent
        // Pembeli::where('id_pembeli', $id)->update([
        //     'id_pembeli' => $request->id_pembeli,
        //     'nama_pembeli' => $request->nama_pembeli,
        //     'username_pembeli' => $request->username_pembeli,
        //     'pass_pembeli' => Hash::make($request->pass_pembeli),
        // ]);

        return redirect()->route('pembelian.index')->with('success', 'Data Pembelian berhasil diubah');
    }

    public function delete($id) {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::delete('DELETE FROM pembelian WHERE id_pembeli = :id_pembeli', ['id_pembeli' => $id]);

        // Menggunakan laravel eloquent
        // Pembeli::where('id_pembeli', $id)->delete();

        return redirect()->route('pembelian.index')->with('success', 'Data Pembelian berhasil dihapus');
    }

}

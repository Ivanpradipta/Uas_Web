<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use DB;
use Validator;

class TransaksiController extends Controller
{
    /**
    * index
    *
    * @return void
    */
    public function index()
    {
        $transaksi = Transaksi::all();

        if(count($transaksi) > 0){
            return response()->json([
                'message' => 'Retrieve All Success',
                'data' => $transaksi
            ], 200);
        }

        return response()->json([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    public function store(Request $request)     
    {         
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'nama_penerima' => 'required',
            'nomor_telepon' => 'required',
            'kota_kecamatan' => 'required',
            'alamat' => 'required',
            'catatan' => 'required',
        ]);

        $transaksi = Transaksi::create($storeData);
        return response()->json([
            'message' => 'Add Transaksi Success',
            'data' => $transaksi
        ], 200);
    }

 
    public function show($id)
    {
        $transaksi = Transaksi::find($id);

        if(!is_null($transaksi)){
            return response()->json([
                'message' => 'Retrieve Transaksi Success',
                'data' => $transaksi
            ], 200);
        }

        return response()->json([
            'message' => 'Transaksi Not Found'
        ], 404);
    }

    public function update(Request $request, $id)
    {
        $transaksi = Transaksi::find($id);
        if(is_null($transaksi)){
            return response()->json([
                'message' => 'Transaksi Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'nama_penerima' => 'required',
            'nomor_telepon' => 'required',
            'kota_kecamatan' => 'required',
            'alamat' => 'required',
            'catatan' => 'required',
        ]);

        if($validate->fails())
            return response()->json(['message' => $validate->errors()], 400);

        $transaksi->nama_penerima = $updateData['nama_penerima'];
        $transaksi->nomor_telepon = $updateData['nomor_telepon'];
        $transaksi->kota_kecamatan = $updateData['kota_kecamatan'];
        $transaksi->alamat = $updateData['alamat'];
        $transaksi->catatan = $updateData['catatan'];

        if($transaksi->save()){
            return response()->json([
                'message' => 'Update Transaksi Success',
                'data' => $transaksi
            ], 200);
        }

        return response()->json([
            'message' => 'Update Transaksi Failed',
            'data' => null
        ], 400);
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::find($id);

        if(is_null($transaksi)){
            return response()->json([
                'message' => 'Transaksi Not Found',
                'data' => null
            ], 404);
        }

        if($transaksi->delete()){
            return response()->json([
                'message' => 'Delete Transaksi Success',
                'data' => $transaksi
            ], 200);
        }

        return response()->json([
            'messsage' => 'Delete Transaksi Failed',
            'data' => null
        ], 400);
    }

}

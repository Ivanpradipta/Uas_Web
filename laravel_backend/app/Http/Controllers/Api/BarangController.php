<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use DB;
use Validator;

class BarangController extends Controller
{
    /**
    * index
    *
    * @return void
    */
    public function index()
    {
        $barang = Barang::all();

        if(count($barang) > 0){
            return response()->json([
                'message' => 'Retrieve All Success',
                'data' => $barang
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
            'nama_barang' => 'required',
            'nama_kategori' => 'required',
            'jumlah_barang' => 'required|numeric',
            'harga_barang' => 'required|numeric',
        ]);

        $barang = Barang::create($storeData);
        return response()->json([
            'message' => 'Add Barang Success',
            'data' => $barang
        ], 200);
    }

 
    public function show($id)
    {
        $barang = Barang::find($id);

        if(!is_null($barang)){
            return response()->json([
                'message' => 'Retrieve Barang Success',
                'data' => $barang
            ], 200);
        }

        return response()->json([
            'message' => 'Barang Not Found'
        ], 404);
    }

    public function update(Request $request, $id)
    {
        $barang = Barang::find($id);
        if(is_null($barang)){
            return response()->json([
                'message' => 'Barang Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'nama_barang' => 'required',
            'nama_kategori' => 'required',
            'jumlah_barang' => 'required|numeric',
            'harga_barang' => 'required|numeric',
        ]);

        if($validate->fails())
            return response()->json(['message' => $validate->errors()], 400);

        $barang->nama_barang = $updateData['nama_barang'];
        $barang->nama_kategori = $updateData['nama_kategori'];
        $barang->jumlah_barang = $updateData['jumlah_barang'];
        $barang->harga_barang = $updateData['harga_barang'];

        if($barang->save()){
            return response()->json([
                'message' => 'Update Barang Success',
                'data' => $barang
            ], 200);
        }

        return response()->json([
            'message' => 'Update Barang Failed',
            'data' => null
        ], 400);
    }

    public function destroy($id)
    {
        $barang = Barang::find($id);

        if(is_null($barang)){
            return response()->json([
                'message' => 'Barang Not Found',
                'data' => null
            ], 404);
        }

        if($barang->delete()){
            return response()->json([
                'message' => 'Delete Barang Success',
                'data' => $barang
            ], 200);
        }

        return response()->json([
            'messsage' => 'Delete Barang Failed',
            'data' => null
        ], 400);
    }

}

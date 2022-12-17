<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kritik;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use DB;
use Validator;

class KritikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kritik = Kritik::all();

        if(count($kritik) > 0){
            return response()->json([
                'message' => 'Retrieve All Success',
                'data' => $kritik
            ], 200);
        }

        return response()->json([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'kritik' => 'required',
            'saran' => 'required',
            'nama' => 'required',
            'email' => 'required',
        ]);

        $kritik = Kritik::create($storeData);
        return response()->json([
            'message' => 'Add Kritik Success',
            'data' => $kritik
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kritik = Kritik::find($id);

        if(!is_null($kritik)){
            return response()->json([
                'message' => 'Retrieve Kritik Success',
                'data' => $kritik
            ], 200);
        }

        return response()->json([
            'message' => 'Kritik Not Found'
        ], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $kritik = Kritik::find($id);
        if(is_null($kritik)){
            return response()->json([
                'message' => 'Kritik Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'kritik' => 'required',
            'saran' => 'required',
            'nama' => 'required',
            'email' => 'required',
        ]);

        if($validate->fails())
            return response()->json(['message' => $validate->errors()], 400);

        $kritik->kritik = $updateData['kritik'];
        $kritik->saran = $updateData['saran'];
        $kritik->nama = $updateData['nama'];
        $kritik->email = $updateData['email'];

        if($kritik->save()){
            return response()->json([
                'message' => 'Update Kritik Success',
                'data' => $kritik
            ], 200);
        }

        return response()->json([
            'message' => 'Update Kritik Failed',
            'data' => null
        ], 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kritik = Kritik::find($id);

        if(is_null($kritik)){
            return response()->json([
                'message' => 'Kritik Not Found',
                'data' => null
            ], 404);
        }

        if($barang->delete()){
            return response()->json([
                'message' => 'Delete Kritik Success',
                'data' => $kritik
            ], 200);
        }

        return response()->json([
            'messsage' => 'Delete Kritik Failed',
            'data' => null
        ], 400);
    }
}

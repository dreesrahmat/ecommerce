<?php

namespace App\Http\Controllers\Api;

use App\Models\Testimoni;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class TestimoniController extends Controller
{
    function __construct()
    {
        // $this->middleware('auth:api', ['except' => 'index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Testimoni::all();

        return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nama_testimoni' => 'required|unique:testimoni|max:255',
            'deskripsi' => 'required|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(
                $validator->errors(),
                422
            );
        }

        $data = $request->all();

        if ($request->hasFile('image')) {

            $image = $request->file('image');

            $nama_gambar = time() . rand(1,9) . '.' . $image->getClientOriginalExtension();

            $image->move('testimoni', $nama_gambar);

            $data['image'] = $nama_gambar;
        }

        $testimoni = Testimoni::create($data);

        return response()->json([
            'success' => true,
            'data' => $testimoni,
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Testimoni $testimoni)
    {
        return response()->json([
            'data' => $testimoni
        ],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Testimoni $testimoni)
    {
        $validator = Validator::make($request->all(),[
            'nama_testimoni' => 'required|max:255',
            'deskripsi' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(
                $validator->errors(),
                422
            );
        }

        $data = $request->all();

        if ($request->hasFile('image')) {

            File::delete('testimoni/' . $testimoni->image);

            $image = $request->file('image');

            $nama_gambar = time() . rand(1,9) . '.' . $image->getClientOriginalExtension();

            $image->move('testimoni', $nama_gambar);

            $data['image'] = $nama_gambar;
        }
        else {
            unset($data['image']);
        }

        $testimoni->update($data);

        return response()->json([
            'success' => true,
            'data' => $testimoni,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Testimoni $testimoni)
    {
        if (!$testimoni) {
            return response()->json([
                'error' => 'Data tidak ditemukan',
            ], 422);
        }
        File::delete('testimoni/' . $testimoni->image);
        $data = $testimoni->delete();

        return response()->json([
            'data' => $data,
            'message' => 'Data Berhasil Dihapus'
        ], 200);
    }
}

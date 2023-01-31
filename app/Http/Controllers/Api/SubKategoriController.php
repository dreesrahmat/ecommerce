<?php

namespace App\Http\Controllers\Api;

use App\Models\SubKategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class SubKategoriController extends Controller
{
    function __construct()
    {
        // $this->middleware('auth:api')->only(['store', 'update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = SubKategori::with('kategori')->get();

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
            'kategori_id' => 'required',
            'nama_subkategori' => 'required|unique:subkategori|max:255',
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

            $image->move('subkategori', $nama_gambar);

            $data['image'] = $nama_gambar;
        }

        $subkategori = SubKategori::create($data);

        return response()->json([
            'success' => true,
            'data' => $subkategori,
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(SubKategori $subkategori)
    {
        return response()->json([
            'data' => $subkategori
        ],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubKategori $subkategori)
    {
        $validator = Validator::make($request->all(),[
            'kategori_id' => 'required',
            'nama_subkategori' => 'required|unique:kategori|max:255',
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

            File::delete('subkategori/' . $subkategori->image);

            $image = $request->file('image');

            $nama_gambar = time() . rand(1,9) . '.' . $image->getClientOriginalExtension();

            $image->move('subkategori', $nama_gambar);

            $data['image'] = $nama_gambar;
        }
        else {
            unset($data['image']);
        }

        $subkategori->update($data);

        return response()->json([
            'success' => true,
            'data' => $subkategori,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubKategori $subkategori)
    {
        if (!$subkategori) {
            return response()->json([
                'error' => 'Data tidak ditemukan',
            ], 422);
        }
        File::delete('subkategori/' . $subkategori->image);
        $data = $subkategori->delete();

        return response()->json([
            'data' => $data,
            'message' => 'Data Berhasil Dihapus'
        ], 200);
    }
}

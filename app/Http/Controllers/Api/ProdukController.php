<?php

namespace App\Http\Controllers\Api;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProdukController extends Controller
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
        $data = Produk::with(['kategori', 'subkategori'])->get();

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
            'subkategori_id' => 'required',
            'nama_produk' => 'required|unique:produk|max:255',
            'deskripsi' => 'required|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'harga' => 'required',
            'diskon' => 'required',
            'bahan' => 'required',
            'tags' => 'required',
            'sku' => 'required',
            'ukuran' => 'required',
            'warna' => 'required',
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

            $image->move('produk', $nama_gambar);

            $data['image'] = $nama_gambar;
        }

        $produk = Produk::create($data);

        return response()->json([
            'success' => true,
            'data' => $produk,
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Produk $produk)
    {
        return response()->json([
            'success' => true,
            'data' => $produk
        ],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produk $produk)
    {
        $validator = Validator::make($request->all(),[
            'kategori_id' => 'required',
            'subkategori_id' => 'required',
            'nama_produk' => 'required|max:255',
            'deskripsi' => 'required|max:255',
            'harga' => 'required',
            'diskon' => 'required',
            'bahan' => 'required',
            'tags' => 'required',
            'sku' => 'required',
            'ukuran' => 'required',
            'warna' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(
                $validator->errors(),
                422
            );
        }

        $data = $request->all();

        if ($request->hasFile('image')) {

            File::delete('produk/' . $produk->image);

            $image = $request->file('image');

            $nama_gambar = time() . rand(1,9) . '.' . $image->getClientOriginalExtension();

            $image->move('produk', $nama_gambar);

            $data['image'] = $nama_gambar;
        }
        else {
            unset($data['image']);
        }

        $produk->update($data);

        return response()->json([
            'success' => true,
            'data' => $produk,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produk $produk)
    {
        if (!$produk) {
            return response()->json([
                'error' => 'Data tidak ditemukan',
            ], 422);
        }
        File::delete('produk/' . $produk->image);
        $data = $produk->delete();

        return response()->json([
            'data' => $data,
            'message' => 'Data Berhasil Dihapus'
        ], 200);
    }
}

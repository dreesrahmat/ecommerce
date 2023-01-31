<?php

namespace App\Http\Controllers\Api;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class SliderController extends Controller
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
        $data = Slider::all();

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
            'nama_slider' => 'required|unique:slider|max:255',
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

            $image->move('slider', $nama_gambar);

            $data['image'] = $nama_gambar;
        }

        $slider = Slider::create($data);

        return response()->json([
            'success' => true,
            'data' => $slider,
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        return response()->json([
            'data' => $slider
        ],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
        $validator = Validator::make($request->all(),[
            'nama_slider' => 'required|unique:slider|max:255',
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

            File::delete('slider/' . $slider->image);

            $image = $request->file('image');

            $nama_gambar = time() . rand(1,9) . '.' . $image->getClientOriginalExtension();

            $image->move('slider', $nama_gambar);

            $data['image'] = $nama_gambar;
        }
        else {
            unset($data['image']);
        }

        $slider->update($data);

        return response()->json([
            'success' => true,
            'data' => $slider,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        if (!$slider) {
            return response()->json([
                'error' => 'Data tidak ditemukan',
            ], 422);
        }
        File::delete('slider/' . $slider->image);
        $data = $slider->delete();

        return response()->json([
            'data' => $data,
            'message' => 'Data Berhasil Dihapus'
        ], 200);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
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
        $data = Order::with('member')->get();

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
            'member_id' => 'required',
            'invoice' => 'required',
            'grand_total' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(
                $validator->errors(),
                422
            );
        }

        $data = $request->all();

        $order = Order::create($data);

        for ($i=0; $i < count($data['produk_id']); $i++) {
            OrderDetail::create([
                'order_id' => $order['id'],
                'produk_id' => $data['produk_id'][$i],
                'jumlah' => $data['jumlah'][$i],
                'ukuran' => $data['ukuran'][$i],
                'warna' => $data['warna'][$i],
                'total' => $data['total'][$i],
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => $order,
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return response()->json([
            'success' => true,
            'data' => $order
        ],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $validator = Validator::make($request->all(),[
            'member_id' => 'required',
            'invoice' => 'required',
            'grand_total' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(
                $validator->errors(),
                422
            );
        }

        $data = $request->all();

        $order->update($data);

        OrderDetail::where('order_id', $order['id'])->delete();

        for ($i=0; $i < count($data['produk_id']); $i++) {
            OrderDetail::create([
                'order_id' => $order['id'],
                'produk_id' => $data['produk_id'][$i],
                'jumlah' => $data['jumlah'][$i],
                'ukuran' => $data['ukuran'][$i],
                'warna' => $data['warna'][$i],
                'total' => $data['total'][$i],
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => $order,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        if (!$order) {
            return response()->json([
                'error' => 'Data tidak ditemukan',
            ], 422);
        }

        $data = $order->delete();

        return response()->json([
            'data' => $data,
            'message' => 'Data Berhasil Dihapus'
        ], 200);
    }

    public function ubah_status(Request $request, Order $order)
    {
        $order->update([
            'status' => $request->status,
        ]);

        return response()->json([
            'message' => 'success',
            'data' => $order,
        ], 200);
    }

    public function baru()
    {
        $data = Order::with('member')->where('status', 'Baru')->get();

        return response()->json($data, 200);
    }

    public function pesanan_dikonfirmasi()
    {
        $data = Order::with('member')->where('status', 'Dikonfirmasi')->get();

        return response()->json($data, 200);
    }

    public function pesanan_dikemas()
    {
        $data = Order::with('member')->where('status', 'Dikemas')->get();

        return response()->json($data, 200);
    }

    public function pesanan_dikirim()
    {
        $data = Order::with('member')->where('status', 'Dikirim')->get();

        return response()->json($data, 200);
    }

    public function pesanan_diterima()
    {
        $data = Order::with('member')->where('status', 'Diterima')->get();

        return response()->json($data, 200);
    }

    public function pesanan_selesai()
    {
        $data = Order::with('member')->where('status', 'Selesai')->get();

        return response()->json($data, 200);
    }
}

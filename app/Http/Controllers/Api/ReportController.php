<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    function __construct()
    {
        // $this->middleware('auth:api', ['except' => 'index']);
    }

    public function index(Request $request)
    {
        $report = DB::table('order_detail')
                ->join('produk', 'produk.id', '=', 'order_detail.produk_id')
                ->select(DB::raw('
                    nama_produk,
                    count(*) as jumlah_dibeli,
                    harga,
                    SUM(total) as pendapatan,
                    SUM(jumlah) as total_qty
                    '))
                ->whereRaw("date(order_detail.created_at) >= '$request->dari' ")
                ->whereRaw("date(order_detail.created_at) <= '$request->sampai' ")
                ->groupBy('produk_id', 'nama_produk', 'harga')
                ->get();
        
        return response()->json([
            'data' => $report
        ], 200);
    }
}

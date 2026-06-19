<?php

namespace App\Http\Controllers;

use App\Models\BigPackStore;
use App\Models\Product;
use App\Models\SetProduct;
use App\Models\StockLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BigStockController extends Controller
{
    public function index(Request $request)
    {
        $exists = SetProduct::where('set_prd_id', $request->input('set_prd_id'))->first();

        if (!$exists) {
            return response()->json([
                'success' => false,
                'message' => 'not successful',
                'data' => 0,
            ], 200);
        }

        $setProduct = DB::table('set_prd')
            ->leftJoin('products', 'products.po_code', '=', 'set_prd.set_prd')
            ->select(
                'set_prd.set_prd_id',
                'set_prd.set_prd_sub',
                'set_prd.set_prd',
                'set_prd.pack_std',
                'set_prd.set_prd_exp',
                'products.po_name',
                'products.image'
            )
            ->where('set_prd.set_prd_id', $request->input('set_prd_id'))
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'successful',
            'data' => $setProduct,
        ], 200);
    }

    public function store(Request $request)
    {
        $exists = BigPackStore::where('set_prd_id', $request->input('set_prd_id_val'))->first();

        if ($exists) {
            return 9;
        }

        $bigPackStore = BigPackStore::create([
            'set_prd_id' => $request->input('set_prd_id_val'),
            'set_prd' => $request->input('set_prd_val'),
            'set_prd_name' => $request->input('set_prd_name_val'),
            'set_prd_sub' => $request->input('set_prd_sub_val'),
            'set_real_stock' => $request->input('realval_stocking'),
            'remark' => $request->input('big_pack_remark'),
        ]);

        $setProductUpdated = SetProduct::where('set_prd_id', $request->input('set_prd_id_val'))
            ->where('pack_std', 1)
            ->update(['pack_std' => 3]);

        $stockQty = explode('/', $request->input('realval_stocking'))[0];

        $stockLog = StockLog::create([
            'pd_code' => $request->input('set_prd_val'),
            'qty' => $stockQty,
            'log_state' => 0,
            'admin_name' => Auth::user()->name,
            'remark' => $request->input('big_pack_remark'),
            'log_etc' => 'big_pack_stock_cut',
        ]);

        $product = Product::where('po_code', $request->input('set_prd_val'))->first();
        $productUpdated = Product::where('po_code', $request->input('set_prd_val'))->update([
            'po_pack_stock' => (int) $product->po_pack_stock - $stockQty,
            'po_prestock' => (int) $product->po_prestock - $stockQty,
            'po_sell_qty' => (int) $product->po_sell_qty + $stockQty,
        ]);

        return $bigPackStore && $setProductUpdated && $stockLog && $productUpdated ? 0 : 1;
    }
}

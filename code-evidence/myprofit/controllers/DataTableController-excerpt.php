<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;

class DataTableController extends Controller
{
    public function customerlist(Request $request)
    {
        $data_date = explode(' - ', $request->date_t);
        $start = date('Y-m-d 00:00:00', strtotime($data_date[0]));
        $end = date('Y-m-d 23:59:59', strtotime($data_date[1]));

        $data = DB::table('customer_list')
            ->select(
                'id',
                'tel',
                'icon',
                'address',
                'pd_list',
                'cus_sendType',
                'cod',
                'admin_n',
                'post_code',
                'date_create',
                DB::raw('(CASE WHEN customer_list.wait_tel = 0 THEN "valid" ELSE "waiting_phone" END) AS wait_tel'),
                DB::raw('(CASE
                    WHEN customer_list.cus_status = 0 THEN "pending"
                    WHEN customer_list.cus_status = 1 THEN "packed"
                    WHEN customer_list.cus_status = 2 THEN "shipped"
                    WHEN customer_list.cus_status = 3 THEN "received"
                    WHEN customer_list.cus_status = 8 THEN "returned"
                    WHEN customer_list.cus_status = 9 THEN "cancelled"
                    ELSE "unknown"
                END) AS cus_status')
            )
            ->whereBetween('date_create', [$start, $end])
            ->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                if ($row->cus_status !== 'pending') {
                    return '';
                }

                return '<a data-toggle="modal" class="edit_custo" style="cursor: pointer">
                    <i class="la la-edit edit ic_newtal"></i>
                </a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function packingTable(Request $request)
    {
        $data_date = explode(' - ', $request->date_t);
        $start = date('Y-m-d 00:00:00', strtotime($data_date[0]));
        $end = date('Y-m-d 23:59:59', strtotime($data_date[1]));

        $data = DB::table('set_packstate')
            ->join('customer_list', 'customer_list.post_code', '=', 'set_packstate.packstate_ems')
            ->select(
                'set_packstate.id as runno',
                'customer_list.post_code as post_code',
                DB::raw('(CASE WHEN set_packstate.pack_state = 0 THEN "complete" ELSE "mismatch" END) AS pack_state'),
                'set_packstate.pack_station as pack_station',
                'customer_list.address as address',
                'customer_list.cod as cod',
                'customer_list.admin_n as admin_n',
                'set_packstate.date as date',
                'set_packstate.time as time'
            )
            ->orderBy('set_packstate.id', 'desc')
            ->whereBetween('set_packstate.created_at', [$start, $end])
            ->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
    }
}

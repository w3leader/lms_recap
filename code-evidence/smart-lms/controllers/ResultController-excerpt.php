<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Score;
use Illuminate\Http\Request;
use DataTables;

class ResultController extends Controller
{
    public static function result_feed()
    {
        $data = Exam::all();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('pass', function ($row) {
                return Score::where('exam_id', $row->id)
                    ->where('score_passed', 1)
                    ->count();
            })
            ->addColumn('no-pass', function ($row) {
                return Score::where('exam_id', $row->id)
                    ->where('score_passed', 2)
                    ->count();
            })
            ->addColumn('action', function ($row) {
                $count = Score::where('exam_id', $row->id)->count();

                if ($count === 0) {
                    return '<span class="btn col-white btn-default"><i class="zmdi zmdi-search zmd-fw"></i></span>';
                }

                return '<a href="' . route('admin.result-detail', $row->id) . '" class="btn col-white btn-info">
                    <i class="zmdi zmdi-search zmd-fw"></i>
                </a>';
            })
            ->rawColumns(['pass', 'no-pass', 'action'])
            ->make(true);
    }

    public static function result_anly_feed()
    {
        $data = Exam::all();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('pass', function ($row) {
                return Score::where('exam_id', $row->id)->where('score_passed', 1)->count();
            })
            ->addColumn('no-pass', function ($row) {
                return Score::where('exam_id', $row->id)->where('score_passed', 2)->count();
            })
            ->addColumn('max', function ($row) {
                return Score::where('exam_id', $row->id)->max('score_point');
            })
            ->addColumn('min', function ($row) {
                return Score::where('exam_id', $row->id)->min('score_point');
            })
            ->addColumn('avg', function ($row) {
                return number_format(Score::where('exam_id', $row->id)->avg('score_point'), 2);
            })
            ->rawColumns(['pass', 'no-pass', 'max', 'min', 'avg'])
            ->make(true);
    }

    public function result_listing($detailid)
    {
        $data_ds = Score::where('exam_id', $detailid)->get()->toArray();

        if (!$data_ds) {
            return view('errors.404');
        }

        return view('admin.result.result-detail', [
            'detail_id' => $detailid,
            'detail_data' => $data_ds,
        ]);
    }
}

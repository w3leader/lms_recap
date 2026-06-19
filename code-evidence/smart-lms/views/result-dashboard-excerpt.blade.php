@extends('admin.layouts.master')
@section('title', 'Result Dashboard')
@section('content')
    @php
        $user_all = DB::table('users')->get()->count();
        $countExam = Exam::all()->count();
        $countQueat = Question::all()->count();
        $countCqueat = CquestionController::all()->count();
        $successUsers = DB::table('score')
            ->where('score_passed', 1)
            ->select('user_id', DB::raw('COUNT(*) as count'))
            ->groupBy('user_id')
            ->havingRaw('COUNT(*) =' . $countExam)
            ->get()
            ->toArray();
        $success_user_count = count($successUsers);
        $suc_per = ($success_user_count / $user_all) * 100;
    @endphp

    <div class="card widget_2 big_icon success">
        <div class="body">
            <h6>Passed all exam sets</h6>
            <h2>{{ $success_user_count }}<small class="info">/ {{ $user_all }} users</small></h2>
            <small>{{ number_format($suc_per, 2) }}% of all users</small>
            <div class="progress">
                <div class="progress-bar l-amber" role="progressbar" style="width: {{ $suc_per }}%;"></div>
            </div>
        </div>
    </div>

    <table id="result_list_anly" class="table display table-bordered table-hover responsive nowrap" width="100%">
        <thead>
        <tr>
            <th>No.</th>
            <th class="text-left">Exam</th>
            <th class="text-left">Pass</th>
            <th class="text-left">No Pass</th>
            <th class="text-center">Max</th>
            <th class="text-center">Min</th>
            <th class="text-center">Average</th>
        </tr>
        </thead>
    </table>

    <script src="{{ asset('assets/admin/ajax/dataResult.js') }}"></script>
    <script src="{{ asset('assets/bundles/datatablescripts.bundle.js') }}"></script>
@stop

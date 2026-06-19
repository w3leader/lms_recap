<?php

namespace App\Http\Controllers\personal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\Score;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ExaminationController extends Controller
{
    public function exam_start(Request $request)
    {
        $ex_id = $request->segment(2);
        $ex = Exam::where('id', $ex_id)->get()->toArray()[0];
        $qs = Question::where('q_cate', $ex['q_cate'])
            ->inRandomOrder()
            ->limit($ex['e_q_qty'])
            ->get()
            ->toArray();

        $cho_array = [];
        foreach ($qs as $data_q) {
            $data_q['q_choice'] = json_decode($data_q['q_choice'], true);
            shuffle($data_q['q_choice']);
            $data_q['option'] = '';
            $cho_array[] = $data_q;
        }

        Session::put('quest', $cho_array);
        Session::put('exam_id', $ex_id);

        return redirect('/exam-start/' . $ex_id . '/1');
    }

    public function select_option(Request $request)
    {
        Session::put('quest.' . $request->numm . '.option', $request->opt_t);
        return 1;
    }

    public function exam_result()
    {
        if (!Session::has('quest')) {
            return redirect('/examination');
        }

        $session_data = Session::get('quest');
        $exam_id = Session::get('exam_id');
        $exam_data = Exam::where('id', $exam_id)->get()->toArray()[0];
        $score = Score::where('user_id', Auth::user()->id)
            ->where('exam_id', $exam_id)
            ->first();

        $score_tr = 0;
        $as_logs = [];

        foreach ($session_data as $data_sc) {
            $as_logs[] = [$data_sc['option'], $data_sc['q_answer']];
            if ((int) $data_sc['option'] === (int) $data_sc['q_answer']) {
                $score_tr++;
            }
        }

        $q_qty = $exam_data['e_q_qty'];
        $cri_score = ($score_tr / $q_qty) * 100;
        $passed = $exam_data['e_criteria'] <= $cri_score ? 1 : 2;
        $as_log = json_encode($as_logs);

        if ($score) {
            $sc_qty = $score->score_qty + 1;
            $payload = [
                'score_qty' => $sc_qty,
                'updated_at' => date("Y-m-d H:i:s"),
            ];

            if ($score_tr >= $score->score_point) {
                $payload += [
                    'score_point' => $score_tr,
                    'score_passed' => $passed,
                    'score_log' => $as_log,
                ];
            }

            $score->update($payload);
        } else {
            Score::insert([
                'user_id' => Auth::user()->id,
                'exam_id' => $exam_id,
                'score_point' => $score_tr,
                'score_passed' => $passed,
                'score_qty' => 1,
                'score_log' => $as_log,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ]);
        }

        Session::forget('quest');
        Session::forget('exam_id');

        return view('personal.exam.exam_result', [
            'data_result' => $session_data,
            'exam_id' => $exam_id,
            'score_point' => $score_tr,
            'score_passed' => $passed,
            'q_qty' => $q_qty,
        ]);
    }
}

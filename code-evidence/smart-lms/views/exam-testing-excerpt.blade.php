@extends('personal.layouts.exam')
@section('title', 'Exam Room')
@section('content')
    @php
        $session_data = Session::get('quest');
        $question_count = count($session_data);
        $question = $session_data[$page - 1];
        $choice_labels = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J'];
    @endphp

    <ul class="d-inline-block m-0 p-0">
        @for ($index = 1; $index <= $question_count; $index++)
            @php
                $option = Session::get('quest.' . ($index - 1) . '.option');
            @endphp
            <li class="d-inline-block">
                <a href="{{ '/exam-start/' . $exam_id . '/' . $index }}"
                   class="btn @if($index == $page) btn-warning @endif @if($option != '') btn-success @else btn-default @endif">
                    {{ $index }}
                </a>
            </li>
        @endfor
    </ul>

    <p>{{ $page }} ) {!! $question['q_question'] !!}</p>

    @if($question['q_image'])
        <div class="text-center w-100">
            <img src="{{ $question['q_image'] }}" class="w-75 m-t-10 m-b-10" />
        </div>
    @endif

    <form name="choice_form">
        @csrf
        @foreach($question['q_choice'] as $choice_index => $choice)
            <div class="radio d-block m-r-20">
                <input type="radio"
                       name="q_choice"
                       id="{{ $choice['key'] }}"
                       value="{{ $choice['key'] }}"
                       @if($question['option'] == $choice['key']) checked aria-checked="true" @endif>
                <label for="{{ $choice['key'] }}">
                    {{ $choice_labels[$choice_index] }} ) {{ $choice['val'] }}
                </label>
            </div>
        @endforeach
    </form>

    <script>
        $(document).ready(function () {
            $("input[name='q_choice']").change(function () {
                $.ajax({
                    url: "/select-option",
                    type: "post",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "numm": "{{ $page - 1 }}",
                        "opt_t": $(this).val()
                    }
                });
            });
        });
    </script>
@stop

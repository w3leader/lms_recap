@extends('layouts.dashboard')
@section('pageTitle', 'Report')
@section('content')
    @if(isset($_GET['search-datetime']))
        <script>
            $('document').ready(function () {
                $.ajax({
                    url: 'report-datetime',
                    type: 'POST',
                    data: {
                        "_token": '{{ csrf_token() }}',
                        "date": '{{ $_GET["search-datetime"] }}'
                    },
                    datatype: 'json',
                    success: function (data) {
                        var wait = 0;
                        var success = 0;
                        var failed = 0;

                        $.each(data, function (_index, value) {
                            if (value.state === 0) {
                                wait += value.state_count;
                            } else if (value.state === 1 || value.state === 2) {
                                success += value.state_count;
                            } else {
                                failed += value.state_count;
                            }
                        });

                        new Chart(document.getElementById("pie-chart").getContext('2d'), {
                            type: 'pie',
                            data: {
                                labels: ["Waiting", "Paid", "Failed"],
                                datasets: [{
                                    backgroundColor: ["#08a6c3", "#5cb85c", "#d9534f"],
                                    borderColor: ["#fff", "#fff", "#fff"],
                                    borderWidth: 10,
                                    data: [wait, success, failed]
                                }]
                            }
                        });
                    }
                });
            });
        </script>
    @endif

    <canvas id="pie-chart"></canvas>
@endsection

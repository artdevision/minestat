@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Rig {!! $rig->hostname !!} {!! $field !!} Chart</h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <div id="chart" style="height: 600px"></div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var plot = null;
        $(function() {
            $("<div id='tooltip'></div>").css({
                position: "absolute",
                display: "none",
                border: "1px solid #fdd",
                padding: "2px",
                "background-color": "#fee",
                opacity: 0.80
            }).appendTo("body");

            $.ajax({
                url: '{!! route('cabinet.chart.dataset', ['id' => $rig->getKey(), 'field' => $field]) !!}',
                type: "GET",
                dataType: "json",
                success: function (series) {
                    plot = $.plot("#chart", series, {
                        series: {
                            lines: {
                                show: true,
                                lineWidth: 2
                            },
                            points: {
                                show: false
                            }
                        },
                        xaxis: {
                            mode: "time",
                            timezone: "browser",
                            timeBase: "milliseconds"
                        },
                        zoom: {
                            interactive: false
                        },
                        grid: {
                            hoverable: true
                        },
                        pan: {
                            interactive: true
                        },
                        legend: {
                            position: "nw",
                            show: true
                        }
                    });

                }
            });
            $("#chart").bind("plothover", function (event, pos, item) {
                if (item) {
                    var x = item.datapoint[0].toFixed(2),
                        y = item.datapoint[1].toFixed(2);

                    $("#tooltip").html(item.series.label + "-<b>" + y + "</b>")
                        .css({top: item.pageY+5, left: item.pageX+5})
                        .fadeIn(200);
                } else {
                    $("#tooltip").hide();
                }

            });

            $("#chart").bind("plothovercleanup", function (event, pos, item) {
                $("#tooltip").hide();
            });
        });
    </script>
@endsection

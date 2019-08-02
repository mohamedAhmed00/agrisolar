@extends('base::layouts.master')
@section('content')
    <section class="content-title">
        <h1>
            All Heads For : {{ $pump->model }}
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('_admin_/base') }}"><i class="fa fa-home"></i>Dashboard</a></li>
            <li><a href="{{ url('_admin_/pumps') }}"><i class="fa fa-power-off"></i>Pumps</a></li>
            <li class="active">Height</li>
        </ol>
    </section>
    <style>
        table span {
            font-size: 10px;
        }

        table * {
            text-align: center;
        }
        table
        {
            font-size: 12px;
        }
    </style>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title col-xs-6">Heads</h3>
                        @can('create', Modules\Pumps\Entities\HeightPumps::class)
                            <h3 class="col-xs-6 text-right"><a
                                    href="{{ url('_admin_/pumps/add/height/add/'.$pump->id) }}"
                                    class="btn btn-primary btn-sm"><i class="fa fa-plus text-capitalize"> Create
                                        New </i></a></h3>
                        @endcan
                    </div>
                    <div class="box-body">
                        <table id="payments" class="table responsive">
                            <thead>
                            <tr>
                                <th class="text-center">Head <br><br> <span></span></th>
                                <th class="text-center">C5 <br><br> <span></span></th>
                                <th class="text-center">C4 <br><br> <span></span></th>
                                <th class="text-center">C3 <br><br> <span></span></th>
                                <th class="text-center">C2 <br><br> <span></span></th>
                                <th class="text-center">C1 <br><br> <span></span></th>
                                <th class="text-center">C0 <br><br> <span></span></th>
                                <th class="text-center">Q Min <br> <span> ( Calc. )</span></th>
                                <th class="text-center">Q Max <br> <span> ( Calc. )</span></th>
                                <th class="text-center">P Min <br><br> <span></span></th>
                                <th class="text-center">P Max <br><br> <span></span></th>
                                @can('view', Modules\Pumps\Entities\HeightPumps::class)
                                    <th class="text-center">Graph <br><br> <span></span></th>
                                @endcan
                                @can('update', Modules\Pumps\Entities\HeightPumps::class)
                                    <th class="text-center">Edit <br><br> <span></span></th>
                                @endcan
                                @can('delete', Modules\Pumps\Entities\HeightPumps::class)
                                    <th class="text-center">Delete <br><br> <span></span></th>
                                @endcan
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($heightPumps as $heightPump)
                                <tr>
                                    @can('update', Modules\Pumps\Entities\HeightPumps::class)
                                        <td class="text-center"><a
                                                href="{{ route('pump.edit',$heightPump->id) }}">{{ $heightPump->head }}</a>
                                        </td>
                                    @elsecan
                                        <td class="text-center">{{ $heightPump->head }}</td>
                                    @endcan
                                    <td class="text-center">{{ $heightPump->c5 }}</td>
                                    <td class="text-center">{{ $heightPump->c4 }}</td>
                                    <td class="text-center">{{ $heightPump->c3 }}</td>
                                    <td class="text-center">{{ $heightPump->c2 }}</td>
                                    <td class="text-center">{{ $heightPump->c1 }}</td>
                                    <td class="text-center">{{ $heightPump->c0 }}</td>
                                    <td class="text-center">{{ $heightPump->q_min }}</td>
                                    <td class="text-center">{{ $heightPump->q_max }}</td>
                                    <td class="text-center">{{ $heightPump->p_min }}</td>
                                    <td class="text-center">{{ $heightPump->p_max }}</td>
                                   @can('view', Modules\Pumps\Entities\HeightPumps::class)
                                        <td class="text-center">
                                            <button type="button" class="btn btn-primary btn-sm"
                                                    onclick="showGraph('{{ $heightPump->points }}')"><i
                                                    class="fa fa-gratipay text-capitalize"> View </i></button>
                                        </td>
                                    @endcan
                                    @can('update', Modules\Pumps\Entities\HeightPumps::class)
                                        <td class="text-center"><a
                                                href="{{ route('HeightPumps.edit',[$heightPump->id,$pump->id]) }}"
                                                class="btn btn-success btn-sm"><i
                                                    class="fa fa-edit text-capitalize"> Edit </i></a></td>
                                    @endcan
                                    @can('delete', Modules\Pumps\Entities\HeightPumps::class)
                                        <td class="text-center">
                                            <div class="slab">
                                                <div class="controls">
                                                    <button class="btn btn-danger btn-sm remove"><i
                                                            class="fa fa-times"></i></button>
                                                    <div class="confirm">
                                                        <p>
                                                            Are you sure?
                                                        </p>
                                                        <button class="btn btn-primary btn-sm keep-button">No</button>
                                                        <a href="{{ route('HeightPumps.delete',$heightPump->id) }}"
                                                           class="btn btn-danger btn-sm"><i
                                                                class="fa fa-remove text-capitalize"> Yes </i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    @endcan
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div id="container" style="height: 500px;width: 900px"></div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/echarts.min.js"></script>
    <script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts-gl/echarts-gl.min.js"></script>
    <script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts-stat/ecStat.min.js"></script>
    <script>
        function showGraph(collection) {
            $('.bs-example-modal-lg').modal('show');
            let dom = document.getElementById("container");
            let myChart = echarts.init(dom);
            let app = {};

            let points = JSON.parse("[" + collection + "]")[0];
            let array = [];

            for (let i = 0; i < points.length; i++) {
                array.push([points[i][0], points[i][1]]);
            }
            let data = array;



            option = null;


            var grids = [];
            var xAxes = [];
            var yAxes = [];
            var series = [];
            var titles = [];
            var count = 0;


            grids.push({
                show: true,
                borderWidth: 0,
                backgroundColor: '#fff',
                shadowColor: 'rgba(0, 0, 0, 0.3)',
                shadowBlur: 2
            });
            xAxes.push({
                type: 'value',
                show: true,

                gridIndex: count
            });
            yAxes.push({
                type: 'value',
                show: true,

                gridIndex: count
            });
            series.push({
                name: name,
                type: 'line',
                xAxisIndex: count,
                yAxisIndex: count,
                data: data,
                showSymbol: false,
                animationEasing: name,
                animationDuration: 1000
            });
            titles.push({
                textAlign: 'center',
                text: name,
                textStyle: {
                    fontSize: 12,
                    fontWeight: 'normal'
                }
            });
            count++;


            option = {
                title: titles.concat([{
                    text: 'Different Easing Functions',
                    top: 'bottom',
                    left: 'center'
                }]),
                grid: grids,
                xAxis: xAxes,
                yAxis: yAxes,
                series: series
            };
            if (option && typeof option === "object") {
                myChart.setOption(option, true);
            }


            /*
            var myRegression = ecStat.regression('exponential', data);

            myRegression.points.sort(function(a, b) {
                return a[0] - b[0];
            });

            option = {
                title: {
                    text: '1981 - 1998 gross domestic product GDP (trillion yuan)',
                    subtext: 'By ecStat.regression',
                    sublink: 'https://github.com/ecomfe/echarts-stat',
                    left: 'center'
                },
                tooltip: {
                    trigger: 'axis',
                    axisPointer: {
                        type: 'cross'
                    }
                },
                xAxis: {
                    type: 'value',
                    splitLine: {
                        lineStyle: {
                            type: 'dashed'
                        }
                    },
                    splitNumber: 20
                },
                yAxis: {
                    type: 'value',
                    splitLine: {
                        lineStyle: {
                            type: 'dashed'
                        }
                    }
                },
                series: [{
                    name: 'scatter',
                    type: 'scatter',
                    label: {
                        emphasis: {
                            show: true,
                            position: 'left',
                            textStyle: {
                                color: 'blue',
                                fontSize: 16
                            }
                        }
                    },
                    data: data
                }, {
                    name: 'line',
                    type: 'line',
                    showSymbol: false,
                    smooth: true,
                    data: myRegression.points,
                    markPoint: {
                        itemStyle: {
                            normal: {
                                color: 'transparent'
                            }
                        },
                        label: {
                            normal: {
                                show: true,
                                position: 'left',
                                formatter: myRegression.expression,
                                textStyle: {
                                    color: '#333',
                                    fontSize: 14
                                }
                            }
                        },
                        data: [{
                            coord: myRegression.points[myRegression.points.length - 1]
                        }]
                    }
                }]
            };
            ;
            if (option && typeof option === "object") {
                myChart.setOption(option, true);
            }
            */
        }


    </script>

    <span class="return-up"><i class="fa fa-chevron-up"></i></span>
@stop

{{--$points = [[0, 1], [1, 4], [2, 9], [3, 16]];--}}

{{--// Input as a callback function--}}
{{--$f⟮x⟯ = function ($x) {--}}
{{--return $x**2 + 2 * $x + 1;--}}
{{--};--}}
{{--list($start, $end, $n) = [0, 3, 4];--}}

{{--// Lagrange Polynomial--}}
{{--// Returns a function p(x) of x--}}
{{--$p = Interpolation\LagrangePolynomial::interpolate($points);--}}

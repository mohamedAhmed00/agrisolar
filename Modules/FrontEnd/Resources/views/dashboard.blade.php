@extends('frontend::layouts.master')
@section('content')
    @php
        $admin = getAdmin();
        $data = getHomeCounts();
    @endphp
    <style>
        .sidebar {
            padding-top: 10px;
        }

        .sidebar label {
            color: #FFF;
            font-size: 12px;
        }

        .sidebar h3 {
            color: #FFF;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .d-none {
            display: none;
        }
        #buttons {
            padding: 20px;
        }
        .btn-selected
        {
            background: #37474F !important;
            color: #FFF !important;
        }
    </style>
    <aside class="sidebar-left">
        <section class="sidebar">
            <h3 class="text-center">Search</h3>
            <div class='col-md-12 text select_type_item'>
                <form action="{{ url('search') }}" method="get">
                    <div class='form-group'>
                        <label for="exampleInputWater">Water Amount ( m<sup>3</sup>/hr )</label>
                        <input type="number" name="water_amount" class="form-control" id="exampleInputWater"
                               placeholder="Water Amount" step=".1"
                               value="{{ !empty($inputs['water_amount'])? $inputs['water_amount'] : '' }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputHead">Dynamic Head ( m )</label>
                        <input type="number" name="dynamic_head" class="form-control" id="exampleInputHead"
                               placeholder="Dynamic Head" step=".1"
                               value="{{ empty(old('dynamic_head'))? !empty($inputs['dynamic_head'])? $inputs['dynamic_head'] : '' : old('dynamic_head') }}">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputCableLength">Cable Length</label>
                        <input type="number" name="cable_length" class="form-control" id="exampleInputCableLength"
                               placeholder="Cable Length" step=".1"
                               value="{{ empty(old('cable_length'))? !empty($inputs['cable_length'])? $inputs['cable_length'] : '' : old('cable_length') }}">
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlLocation">Select Location</label>
                        <select class="form-control" name="location" id="exampleFormControlLocation">
                            <option value="">Choose city</option>
                            @foreach($cities as $city)
                                <option
                                    value="{{ $city->id }}" {{ (!empty($inputs['location']) and ($inputs['location'] == $city->id)) ? 'selected' : '' }}>{{ $city->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlMountingStructure">Mounting Structure</label>
                        <select class="form-control" name="mounting_structure"
                                id="exampleFormControlMountingStructure">
                            <option
                                value="Fixed" {{ empty(old('mounting_structure'))? !empty($inputs['mounting_structure']) and $inputs['mounting_structure'] == 'Fixed' ? 'selected' : '' : 'selected' }}>
                                Fixed
                            </option>
                            <option
                                value="Tracking" {{ empty(old('mounting_structure'))? !empty($inputs['mounting_structure']) and $inputs['mounting_structure'] == 'Tracking' ? 'selected' : '' : 'selected' }}>
                                Tracking
                            </option>
                        </select>
                    </div>
                    <div class="form-group" id="module-name">
                        <label for="exampleFormControlSelectExistingOne">Select Existing One</label>
                        <select class="form-control" name="module_name" id="exampleFormControlSelectExistingOne">
                            <option value="pump 1">pump 1</option>
                            <option value="pump 2">pump 2</option>
                            <option value="pump 3">pump 3</option>
                            <option value="pump 4">pump 4</option>
                            <option value="pump 5">pump 5</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-microsoft btn-block mb-3" id="add-module">Enter New
                            Modules
                        </button>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-microsoft btn-block mb-3 d-none" id="exist-module">Enter
                            Exist Modules
                        </button>
                    </div>
                    <div class="mt-3 d-none" id="module-config">
                        <div class="form-group">
                            <label for="exampleInputOpenCircuitVoltage">Open Circuit Voltage ( VOC )</label>
                            <input type="number" value="{{ old('voc') }}" step=".1" name="voc" class="form-control"
                                   id="exampleInputOpenCircuitVoltage"
                                   placeholder="Open Circuit Voltage">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputVoltageAtMaxPowerpoint">Voltage At Max Power point ( VMPP
                                )</label>
                            <input type="number" name="vmpp" class="form-control"
                                   id="exampleInputVoltageAtMaxPowerpoint" step=".1" value="{{ old('vmpp') }}"
                                   placeholder="Voltage At Max Power point">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPowerMax">Power Max ( P )</label>
                            <input type="number" name="power_max" step=".1" class="form-control"
                                   id="exampleInputPowerMax" value="{{ old('power_max') }}"
                                   placeholder="Power Max">
                        </div>
                    </div>

                    <div class="form-group">
                        <input class="btn btn-primary btn-block mb-3 text-capitalize btn-lg" type="submit"
                               name="search" value="search">
                    </div>
                </form>
            </div>
        </section>
    </aside>
    <div class="content-wrapper">
        <header>
            <div class="container-fluid ">
                <div class="row" id="buttons">
                    <div class="col-sm-3">
                        <span>Pump Systems</span>
                        <select class="form-control">
                            <option></option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <span>PV Generator</span>
                        <input type="number" id="pv_generator" step=".1" class="form-control" placeholder="">
                    </div>
                    <div class="col-sm-3">
                        <span>PM Mounts</span>
                        <select class="form-control">
                            <option></option>
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <span>Cable</span>
                        <input type="number" class="form-control" placeholder="">
                    </div>
                    <div class="col-sm-1">
                        <br>
                        <button id="search" class="btn btn-primary">Search</button>
                    </div>
                </div>
                <div class="row" style="padding: 10px 30px">
                    @if(!empty($pumps))
                        <table class="table">
                            <h3 class="text-center" style="padding-bottom: 20px">Matches Pumps</h3>
                            <thead>
                            <tr>
                                <th></th>
                                <th scope="col">Module</th>
                                <th scope="col">Motor</th>
                                <th scope="col">Stages</th>
                                <th scope="col">Q Min</th>
                                <th scope="col">Q Max</th>
                                <th scope="col">H Min</th>
                                <th scope="col">H Max</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($pumps as $pump)
                                <tr>
                                    <td><input type="radio" name="select" class="select" value="{{ $pump->id }}"></td>
                                    <td>{{ $pump->model }}</td>
                                    <td>{{ $pump->motor }}</td>
                                    <td>{{ $pump->stages }}</td>
                                    <td>{{ $pump->q_min }}</td>
                                    <td>{{ $pump->q_max }}</td>
                                    <td>{{ $pump->h_min }}</td>
                                    <td>{{ $pump->h_max }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @elseif(!empty($pumps) AND count($pumps) == 0)
                        <h2 class="text-center">no pump matches your inputs</h2>
                    @else
                        <h2 class="text-capitalize text-center">no pump matches your inputs</h2>

                    @endif
                </div>
            </div>

        </header>
        <section>
            <div class="container-fluid">
                <div class="row">
                    <section class="col-xs-12">
                        <div id="chartContainer" style=" width: 100%;"></div>
                        <div id="month" style=" width: 100%;"></div>
                        <div style="display: none" id="btn">
                            <h4 class="text-center col-sm-2"><a class="btn btn-selected select_month" data-content="january">january</a></h4>
                            <h4 class="text-center col-sm-2"><a class="btn btn-primary select_month" data-content="february">february</a></h4>
                            <h4 class="text-center col-sm-2"><a class="btn btn-primary select_month" data-content="march">march</a></h4>
                            <h4 class="text-center col-sm-2"><a class="btn btn-primary select_month" data-content="april">april</a></h4>
                            <h4 class="text-center col-sm-2"><a class="btn btn-primary select_month" data-content="may">may</a></h4>
                            <h4 class="text-center col-sm-2"><a class="btn btn-primary select_month" data-content="june">june</a></h4>
                            <h4 class="text-center col-sm-2"><a class="btn btn-primary select_month" data-content="july">july</a></h4>
                            <h4 class="text-center col-sm-2"><a class="btn btn-primary select_month" data-content="august">august</a></h4>
                            <h4 class="text-center col-sm-2"><a class="btn btn-primary select_month" data-content="september">september</a></h4>
                            <h4 class="text-center col-sm-2"><a class="btn btn-primary select_month" data-content="october">october</a></h4>
                            <h4 class="text-center col-sm-2"><a class="btn btn-primary select_month" data-content="november">november</a></h4>
                            <h4 class="text-center col-sm-2"><a class="btn btn-primary select_month" data-content="december">december</a></h4>
                        </div>
                    </section>
                </div>
            </div>
        </section>
    </div>
    <footer class="main-footer">
        <strong>Copyright &copy; reserved at {{ date('Y',time()) }} to <a href="http://www.nevdia.com">nevdia.com</a>.</strong>
        <div class="pull-right hidden-xs"></div>
    </footer>
@stop

@section('view_chart')

    <script>

        function chart(data) {
            let array = [];

            for (let i = 0; i < data.length; i++) {
                array[i] = {label:data[i][0],y:data[i][1]};
            }

            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                exportEnabled: true,
                theme: "light1", // "light1", "light2", "dark1", "dark2"
                title: {
                    text: "Water Amount Per Month"
                },
                data: [{
                    type: "column", //change type to bar, line, area, pie, etc
                    //indexLabel: "{y}", //Shows y value on all Data Points
                    indexLabelFontColor: "#5A5757",
                    indexLabelPlacement: "outside",
                    legendMarkerColor: "grey",
                    color: ["#37474F"],
                    dataPoints: array
                }]
            });
            chart.render();
            $('#chartContainer').css({'height':'400px'});
        };

        function chartForMonth(data) {
            let array = [];
            for (let i = 0; i < data.length; i++) {
                array[i] = {label:data[i][0],y:data[i][1]};
            }
            var chart = new CanvasJS.Chart("month", {
                animationEnabled: true,
                exportEnabled: true,
                theme: "light1", // "light1", "light2", "dark1", "dark2"
                title: {
                    text: "Water Amount Per Year"
                },
                data: [{
                    type: "column", //change type to bar, line, area, pie, etc
                    //indexLabel: "{y}", //Shows y value on all Data Points
                    indexLabelFontColor: "#5A5757",
                    indexLabelPlacement: "outside",
                    legendMarkerColor: "grey",
                    color: ["#37474F"],
                    dataPoints: array
                }]
            });
            chart.render();
            $('#month').css({'height':'400px'});
        };

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(".select").change(function () {
            if (this.checked) {
                $.ajax({
                    type: 'POST',
                    url: 'pump/data',
                    data: {
                        'id': $(this).val(),
                        'water_amount': $("#exampleInputWater").val(),
                        'dynamic_head': $("#exampleInputHead").val(),
                        'cable_length': $("#exampleInputCableLength").val(),
                        'location': $("#exampleFormControlLocation").val(),
                        'mounting_structure': $("#exampleFormControlMountingStructure").val()
                    },
                    success: function (res) {
                        if (res.chart) {
                            chart(res.chart);
                            chartForMonth(res.month);
                            $("#btn").css({'display':'block'});
                            $("#pv_generator").val(res.head);
                        } else {
                            alert(res.error);
                        }
                    }
                });
            }
        });

        $("#search").click(function () {
            let PVGenerator = $("#pv_generator").val();
            let id = $('.select[type=radio]').val();
            if (PVGenerator && id) {
                $.ajax({
                    type: 'POST',
                    url: 'pump/search',
                    data: {
                        'id': $('.select[type=radio]').val(),
                        'water_amount': $("#exampleInputWater").val(),
                        'dynamic_head': $("#exampleInputHead").val(),
                        'cable_length': $("#exampleInputCableLength").val(),
                        'location': $("#exampleFormControlLocation").val(),
                        'mounting_structure': $("#exampleFormControlMountingStructure").val(),
                        'head': PVGenerator
                    },
                    success: function (res) {
                        if (res.chart) {
                            chart(res.chart.year);
                            console.log(res.chart.month.points);
                            chartForMonth(res.chart.month.points);

                        } else {
                            alert(res.error);
                        }
                    }
                });
            } else {
                alert("pv generator is empty and you must select pump")
            }
        });
        $(".select_month").click(function () {
            let PVGenerator = $("#pv_generator").val();
            let id = $('.select[type=radio]').val();
            let element = $(this);
            let month = element.attr('data-content');
            if (PVGenerator && id) {
                $.ajax({
                    type: 'POST',
                    url: 'pump/search/monthChart',
                    data: {
                        'id': $('.select[type=radio]').val(),
                        'water_amount': $("#exampleInputWater").val(),
                        'dynamic_head': $("#exampleInputHead").val(),
                        'cable_length': $("#exampleInputCableLength").val(),
                        'location': $("#exampleFormControlLocation").val(),
                        'mounting_structure': $("#exampleFormControlMountingStructure").val(),
                        'head': PVGenerator,
                        'month': month,
                    },
                    success: function (res) {
                        if (res.chart) {
                            chartForMonth(res.chart.points);
                            $('.select_month').removeClass('btn-selected');
                            $('.select_month').addClass('btn-primary');
                            element.removeClass('btn-primary');
                            element.addClass('btn-selected');
                        } else {
                            alert(res.error);
                        }
                    }
                });
            } else {
                alert("pv generator is empty , you must select pump and month")
            }

        });
    </script>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $("#add-module").on('click', function () {
                $("#module-name").addClass('d-none');
                $("#module-config").removeClass('d-none');
                $("#exist-module").removeClass('d-none');
                $('#add-module').addClass('d-none');
                $('input[name=module_name]').val("");
            });
            $('#exist-module').on('click', function () {
                $("#module-name").removeClass('d-none');
                $("#module-config").addClass('d-none');
                $("#exist-module").addClass('d-none');
                $('#add-module').removeClass('d-none');
                $('input[name=voc]').val("");
                $('input[name=vmpp]').val("");
                $('input[name=power_max]').val("");
            });
        });
    </script>
@endsection


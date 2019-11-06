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
            font-size: 11px;
        }

        .sidebar h3 {
            color: #FFF;
            margin-top: 5px;
            margin-bottom: 10px;
            font-weight: bold;
            font-size: 18px;
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
        .sidebar .form-group {
            margin-bottom: 5px !important;
        }
        .sidebar .form-control{
            height: 28px;
        }
        .select-options{
            height: 32px !important;
        }
        .table th{
            font-size: 12px;
        }
        .table td{
            font-size: 11px;
            text-align: center;
        }
        .btn-pvg{
            padding: 9px 7px;
        }
        .pdf {
            display: none;
            padding-top: 20px;
        }
        .pdf h3 {
            color:#000;
            font-weight: bold;
            font-size: 15px;
        }
        .collection_pvg{
            display: none;
        }
        table > thead:first-child > tr:first-child > th{
            text-align: center;
        }
        #btn h4{
            overflow: hidden;
        }

        #btn h4 .btn{
            min-width: 100%;
            padding:10px;
            font-size: 12px;
        }
        .table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th{
            padding: 4px 8px;
        }
        .pvg-input,.pv_span {
            height: 20px;
            font-size: 10px;
            padding: 3px 10px;
        }
        .btn-pvg{
            min-width: 13%;
            float: left;
            height: 20px;
            font-size: 10px;
            padding-top: 5px;
            float: left
        }
        .select_water_amount{
            display: none;
        }
    </style>
    <aside class="sidebar-left">
        <section class="sidebar">
            <h3 class="text-center">Search</h3>
            <div class='col-md-12 text select_type_item'>
                <form action="{{ url('search') }}" method="get">
                    <div class='form-group water_amount'>
                        <label for="exampleInputWater">Water Amount ( m<sup>3</sup>/day )</label>
                        <input type="number" name="water_amount" class="form-control" id="exampleInputWater"
                               placeholder="Water Amount" step=".1"
                               value="{{ !empty($inputs['water_amount'])? $inputs['water_amount'] : '' }}">
                    </div>
                    <div class="form-group select_water_amount">
                        <label for="select_existing_pump">Select Existing Pump</label>
                        <select class="form-control select-options" name="select_existing_pump"
                                id="select_existing_pump">
                            <option></option>
                            @foreach($existingPumps as $existingPump)
                                <option value="{{ $existingPump->id }}">{{ $existingPump->model }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class='form-group'>
                        <input type="checkbox" name="select_pump" class="select_pump" checked="">

                        <label for="select_pump">Select Existing Pump</label>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputHead">Total Dynamic Head ( m )</label>
                        <input type="number" name="dynamic_head" class="form-control" id="exampleInputHead"
                               placeholder="Dynamic Head" step=".1"
                               value="{{ empty(old('dynamic_head'))? !empty($inputs['dynamic_head'])? $inputs['dynamic_head'] : '' : old('dynamic_head') }}">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputCableLength">Cable Length ( m )</label>
                        <input type="number" name="cable_length" class="form-control" id="exampleInputCableLength"
                               placeholder="Cable Length" step=".1"
                               value="{{ empty(old('cable_length'))? !empty($inputs['cable_length'])? $inputs['cable_length'] : '' : old('cable_length') }}">
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlLocation">Select Location</label>
                        <select class="form-control select-options" name="location" id="exampleFormControlLocation">
                            <option value="">Choose city</option>
                            @foreach($cities as $city)
                                <option
                                    value="{{ $city->id }}" {{ (!empty($inputs['location']) and ($inputs['location'] == $city->id)) ? 'selected' : '' }}>{{ $city->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlMountingStructure">Select Mounting Structure Type</label>
                        <select class="form-control select-options" name="mounting_structure"
                                id="exampleFormControlMountingStructure">
                            <option></option>
                            <option
                                value="Fixed" {{ empty(old('mounting_structure'))? ( !empty($inputs['mounting_structure']) and $inputs['mounting_structure'] == 'Fixed' ) ? 'selected' : '' : 'selected' }}>
                                Fixed
                            </option>
                            <option
                                value="Tracking" {{ empty(old('mounting_structure'))? ( !empty($inputs['mounting_structure']) and $inputs['mounting_structure'] == 'Tracking' ) ? 'selected' : '' : 'selected' }}>
                                Tracking
                            </option>
                        </select>
                    </div>
                    <div class="form-group" id="module-name">
                        <label for="exampleFormControlSelectExistingOne">Select Module</label>
                        <select class="form-control select-options" name="module" id="exampleFormControlSelectExistingOne">
                            <option></option>
                            <option value="no" {{ empty(old('module'))? (!empty($inputs['module']) AND  ($inputs['module'] == 'no' ) )? 'selected' : '' : ''}} id="add-module" >Enter New Modules</option>
                            @foreach($modules as $module)
                                <option value="{{$module->id}}" {{ empty(old('module'))? (!empty($inputs['module']) AND  ($inputs['module'] == $module->id ) )? 'selected' : '' : ''}} class="options">{{$module->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mt-3 {{ empty(old('module'))? (!empty($inputs['module']) AND  $inputs['module'] == 'no' )? '' : 'd-none' : 'd-none' }}" id="module-config">
                        <div class="form-group">
                            <label for="exampleInputName">Module Name</label>
                            <input type="text" value="{{ empty(old('module_name'))? !empty($inputs['module_name'])? $inputs['module_name'] : '' : old('module_name') }}" name="module_name" class="form-control" id="exampleInputName" placeholder="Module Name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputOpenCircuitVoltage">Open Circuit Voltage ( VOC )</label>
                            <input type="number" value="{{ empty(old('voc'))? !empty($inputs['voc'])? $inputs['voc'] : '' : old('voc') }}" step=".1" name="voc" class="form-control"
                                   id="exampleInputOpenCircuitVoltage"
                                   placeholder="Open Circuit Voltage">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputVoltageAtMaxPowerpoint">Voltage At Max Power point ( VMPP
                                )</label>
                            <input type="number" name="vmpp" class="form-control"
                                   id="exampleInputVoltageAtMaxPowerpoint" step=".1" value="{{ empty(old('vmpp'))? !empty($inputs['vmpp'])? $inputs['vmpp'] : '' : old('vmpp') }}"
                                   placeholder="Voltage At Max Power point">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPowerMax">Power Max ( P )</label>
                            <input type="number" name="power_max" step=".1" class="form-control"
                                   id="exampleInputPowerMax" value="{{ empty(old('power_max'))? !empty($inputs['power_max'])? $inputs['power_max'] : '' : old('power_max') }}"
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
    <div class="content-wrapper" @if(empty($pumps))  style="background: url('{{ asset('agrisolar/img/bg.jpeg') }}'); background-size: 100% 100%;" @endif>
        <header>
            <div class="container-fluid " >
{{--                <div class="row" id="buttons">--}}
{{--                    <div class="col-sm-2">--}}
{{--                        <span>Pump Systems</span>--}}
{{--                        <select class="form-control">--}}
{{--                            <option></option>--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                    <div class="col-sm-3">--}}
{{--                        <span>PV Generator</span>--}}
{{--                        <br>--}}
{{--                        <button class="btn btn-primary btn-pvg" data-html="-" style="min-width: 20%;float: left">-</button>--}}
{{--                        <input type="text" id="pv_generator" step=".1" data-html="" class="form-control" placeholder="" style="width: 60%;float: left">--}}
{{--                        <button class="btn btn-primary btn-pvg" data-html="+" style="min-width: 20%;float: left">+</button>--}}
{{--                    </div>--}}
{{--                    <div class="col-sm-2">--}}
{{--                        <span>PM Mounts</span>--}}
{{--                        <select class="form-control">--}}
{{--                            <option></option>--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                    <div class="col-sm-2">--}}
{{--                        <span>Cable</span>--}}
{{--                        <input type="number" class="form-control" placeholder="">--}}
{{--                    </div>--}}
{{--                    <div class="col-sm-1">--}}
{{--                        <br>--}}
{{--                        <button id="search" class="btn btn-primary">Search</button>--}}
{{--                    </div>--}}
{{--                    <div class="col-sm-3">--}}
{{--                        <br>--}}
{{--                        <a id="PDF" href="" class="btn btn-primary hidden">Generate PDF</a>--}}
{{--                    </div>--}}

{{--                </div>--}}
            </div>

        </header>
        <section>
            <div class="container-fluid">
                <div class="row">
                    <section class="col-xs-9">
                        @if(!empty($pumps) AND !$pumps->isEmpty())
                            <table class="table">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th scope="col">Module</th>
                                    <th scope="col">Power Hp</th>
                                    <th scope="col">Stages</th>
                                    <th scope="col">PV Generator</th>
                                    <th scope="col">Cable</th>
                                    <th scope="col">Output</th>
                                    <th scope="col">Efficiency</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($pumps as $pump)
                                    <tr>
                                        <td><input type="radio" name="select" class="select" value="{{ $pump->id }}"></td>
                                        <td>{{ $pump->model }}</td>
                                        <td>{{ $pump->motor }}</td>
                                        <td>{{ $pump->stages }}</td>
                                        <td style="width: 300px">
                                            <div class="collection_{{ $pump->id }} collection_pvg">
                                                <button class="btn btn-primary btn-pvg" data-html="-">-</button>
                                                <input type="text" id="pv_generator_{{$pump->id}}" class="form-control pvg-input pv_generator" placeholder="" style="width: 74%;float: left">
                                                <button class="btn btn-primary btn-pvg" data-html="+" >+</button>
                                            </div>
                                            <div>
                                                <span id="pv_span_{{$pump->id}}" class="form-control pv_span ">{{ $pump->pvgen }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            {{ !empty($pump->length)? $pump->length : 0 }}
                                        </td>
                                        <td id="output_{{$pump->id}}">{{ $pump->output }} m <sup> 3 </sup></td>
                                        <td id="eff_{{$pump->id}}">{{ $pump->eff }}  m <sup> 3 </sup> / KWp</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        @elseif(empty($pump) AND !empty(request('search')))
                            <h2 class="text-center">no pump matches your inputs</h2>

                        @else

{{--                            <h2 class="text-capitalize text-center">no pump matches your inputs</h2>--}}

                        @endif

                        <div id="chartContainer" style="height: 250px; width: 100%;"></div>
                        <div id="month" style="height: 250px; width: 100%;"></div>
                            <div style="display: none" id="btn">
                                <div class="col-xs-11">
                                    <h4 class="text-center col-sm-1"><a class="btn btn-selected select_month" data-content="january">jan</a></h4>
                                    <h4 class="text-center col-sm-1"><a class="btn btn-primary select_month" data-content="february">feb</a></h4>
                                    <h4 class="text-center col-sm-1"><a class="btn btn-primary select_month" data-content="march">march</a></h4>
                                    <h4 class="text-center col-sm-1"><a class="btn btn-primary select_month" data-content="april">april</a></h4>
                                    <h4 class="text-center col-sm-1"><a class="btn btn-primary select_month" data-content="may">may</a></h4>
                                    <h4 class="text-center col-sm-1"><a class="btn btn-primary select_month" data-content="june">june</a></h4>
                                    <h4 class="text-center col-sm-1"><a class="btn btn-primary select_month" data-content="july">july</a></h4>
                                    <h4 class="text-center col-sm-1"><a class="btn btn-primary select_month" data-content="august">aug</a></h4>
                                    <h4 class="text-center col-sm-1"><a class="btn btn-primary select_month" data-content="september">sep</a></h4>
                                    <h4 class="text-center col-sm-1"><a class="btn btn-primary select_month" data-content="october">oct</a></h4>
                                    <h4 class="text-center col-sm-1"><a class="btn btn-primary select_month" data-content="november">nov</a></h4>
                                    <h4 class="text-center col-sm-1"><a class="btn btn-primary select_month" data-content="december">dec</a></h4>
                                </div>
                                <div class="col-xs-1" style="padding: 0">
                                    <h4 class="text-center col-sm-6" style="padding: 0"><a class="btn btn-primary select_month" data-content="avg">avg</a></h4>
                                </div>



                            </div>
                    </section>
                    <section class="col-xs-3 pdf">
                        <h3>select Months that appeare in pdf</h3>
                        <form action="{{ url('getPDF') }}" method="get">
                            <div class='form-group'>
                                <label for="january">january</label>
                                <input type="checkbox" name="month[]"  id="january" value="january">
                            </div>
                            <div class='form-group'>
                                <label for="february">february</label>
                                <input type="checkbox" name="month[]"  id="february" value="february">
                            </div>
                            <div class='form-group'>
                                <label for="march">march</label>
                                <input type="checkbox" name="month[]"  id="march" value="march">
                            </div>

                            <div class='form-group'>
                                <label for="april">april</label>
                                <input type="checkbox" name="month[]"  id="april" value="april">
                            </div>

                            <div class='form-group'>
                                <label for="may">may</label>
                                <input type="checkbox" name="month[]"  id="may" value="may">
                            </div>
                            <div class='form-group'>
                                <label for="july">july</label>
                                <input type="checkbox" name="month[]"  id="july" value="july">
                            </div>
                            <div class='form-group'>
                                <label for="august">august</label>
                                <input type="checkbox" name="month[]"  id="august" value="august">
                            </div>
                            <div class='form-group'>
                                <label for="september">september</label>
                                <input type="checkbox" name="month[]"  id="september" value="september">
                            </div>
                            <div class='form-group'>
                                <label for="october">october</label>
                                <input type="checkbox" name="month[]"  id="october" value="october">
                            </div>

                            <div class='form-group'>
                                <label for="november">november</label>
                                <input type="checkbox" name="month[]"  id="november" value="november">
                            </div>
                            <div class='form-group'>
                                <label for="december">december</label>
                                <input type="checkbox" name="month[]"  id="december" value="december">
                            </div>

                            <input type="hidden" name="id" id="pdf_id" value="">
                            <input type="hidden" name="water_amount" id="pdf_water_amount" value="">
                            <input type="hidden" name="dynamic_head" id="pdf_dynamic_head" value="">
                            <input type="hidden" name="cable_length" id="pdf_cable_length" value="">
                            <input type="hidden" name="location" id="pdf_location" value="">
                            <input type="hidden" name="mounting_structure" id="pdf_mounting_structure" value="">
                            <input type="hidden" name="pvg" id="pdf_pvg" value="">
                            <input type="hidden" name="module" id="pdf_module" value="">

                            <div class="form-group">
                                <input class="btn btn-primary btn-block mb-3 text-capitalize btn-lg" type="submit"
                                       name="search" value="pdf">
                            </div>
                        </form>

                    </section>


                </div>
            </div>
        </section>
    </div>
    <footer class="main-footer">
        <strong>Copyright &copy; reserved at {{ date('Y',time()) }} to <a href="http://www.nevdia.com">nevdia.com</a>.</strong>
        <div class="pull-right hidden-xs"></div>
    </footer>
    <input type="hidden" value="{{url('/')}}" id="url">
@stop

@section('view_chart')

    <script>
        $(document).ready(function () {
            $(".select").attr('checked',false);
            $(".select_pump").attr('checked',false);
            $(".pv_generator").val('');
        });
        function chart(data) {
            let array = [];

            for (let i = 0; i < data.length; i++) {
                array[i] = {label:data[i][0],y:data[i][1]};
            }

            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                exportEnabled: true,
                dataPointWidth: 40,
                theme: "light1", // "light1", "light2", "dark1", "dark2"
                title: {
                    text: "Water Amount Per Year"
                },
                data: [{
                    type: "column", //change type to bar, line, area, pie, etc
                    indexLabel: "{y}", //Shows y value on all Data Points
                    indexLabelFontColor: "#5A5757",
                    indexLabelPlacement: "outside",
                    legendMarkerColor: "grey",
                    color: ["#29b6f6"],
                    dataPoints: array
                }]
            });
            chart.render();
            // $('#chartContainer').css({'height':'400px'});
        };

        function chartForMonth(data) {
            let array = [];
            for (let i = 0; i < data.length; i++) {
                array[i] = {label:data[i][0],y:data[i][1]};
            }
            var chart = new CanvasJS.Chart("month", {
                animationEnabled: true,
                exportEnabled: true,
                dataPointWidth: 40,

                theme: "light1", // "light1", "light2", "dark1", "dark2"
                title: {
                    text: "Water Amount Per Month"
                },
                data: [{
                    type: "column", //change type to bar, line, area, pie, etc
                    indexLabel: "{y}", //Shows y value on all Data Points
                    indexLabelFontColor: "#5A5757",
                    indexLabelPlacement: "outside",
                    legendMarkerColor: "grey",
                    color: ["#29b6f6"],
                    dataPoints: array
                }]
            });
            chart.render();
            // $('#month').css({'height':'400px'});
        };

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(".select").change(function () {
            if (this.checked) {
                let id = $(this).val();
                $('.select_month').removeClass('btn-selected');
                $('.select_month').addClass('btn-primary');
                $('.select_month').first().removeClass('btn-primary');
                $('.select_month').first().addClass('btn-selected');
                $('.pv_span').css({'display': 'block'});
                $(`#pv_span_${id}`).css({'display': 'none'});

                $("#PDF").attr('href',`${$("#url").val()}/getPDF?id=${$(this).val()}&${window.location.href.split('search?')[1]}`);
                $('#PDF').removeClass('hidden');
                let module = {};
                let module_check = $("#exampleFormControlSelectExistingOne").val();
                if(module_check == 'no'){
                    module= {
                        'vmpp':$("#exampleInputVoltageAtMaxPowerpoint").val(),
                        'power_max':$("#exampleInputPowerMax").val(),
                        'module_name':$("#exampleInputName").val(),
                        'voc':$("#exampleInputOpenCircuitVoltage").val(),
                    }
                } else {
                     module = {'id':$("#exampleFormControlSelectExistingOne").val()};
                }

                $.ajax({
                    type: 'POST',
                    url: 'pump/data',
                    data: {
                        'id': $(this).val(),
                        'water_amount': $("#exampleInputWater").val(),
                        'dynamic_head': $("#exampleInputHead").val(),
                        'cable_length': $("#exampleInputCableLength").val(),
                        'location': $("#exampleFormControlLocation").val(),
                        'mounting_structure': $("#exampleFormControlMountingStructure").val(),
                        "module": JSON.stringify(module)
                    },
                    success: function (res) {
                        if (res.chart) {
                            chart(res.chart);
                            chartForMonth(res.month);
                            let pvg = res.pvgen_array;
                            $("#btn").css({'display':'block'});
                            $(`#pv_generator_${id}`).val($(`#pv_span_${id}`).html());
                            $(`#output_${id}`).html(res.avg + " m <sup> 3 </sup>");
                            $(`#eff_${id}`).html(Math.round(res.avg / pvg.pvgen) + " m <sup> 3 </sup> / KWp " );
                            $(`#pv_generator_${id}`).attr('data-html',pvg.pvgen);
                            $('.pdf').css({'display':'block'});
                            $('#pdf_id').val(id);
                            $('#pdf_water_amount').val($("#exampleInputWater").val());
                            $('#pdf_dynamic_head').val($("#exampleInputHead").val());
                            $('#pdf_cable_length').val($("#exampleInputCableLength").val());
                            $('#pdf_location').val($("#exampleFormControlLocation").val());
                            $('#pdf_mounting_structure').val($("#exampleFormControlMountingStructure").val());
                            $('#pdf_pvg').val($(`#pv_generator_${id}`).val());
                            $('#pdf_module').val( JSON.stringify(module));

                            $('.collection_pvg').css({'display': 'none'});
                            $(`.collection_${id}`).css({'display': 'block'});
                        } else {
                            alert(res.error);
                        }
                    }
                });
            }
        });

        $(".btn-pvg").click(function () {
            let id = $('.select[type=radio]:checked').val();
            let type = $(this).attr('data-html');
            let PVGenerator = $(`#pv_span_${id}`).html();
            if (PVGenerator && id) {
                $.ajax({
                    type: 'POST',
                    url: 'pump/search',
                    data: {
                        'id': id,
                        'water_amount': $("#exampleInputWater").val(),
                        'dynamic_head': $("#exampleInputHead").val(),
                        'cable_length': $("#exampleInputCableLength").val(),
                        'location': $("#exampleFormControlLocation").val(),
                        'mounting_structure': $("#exampleFormControlMountingStructure").val(),
                        'head': PVGenerator,
                        'type': type == '-' ? 'before' : 'after'
                    },
                    success: function (res) {
                        if (res.chart) {
                            let pvg = res.pvgen_array;
                            chart(res.chart.year);
                            chartForMonth(res.chart.month.points);
                            $('.pv_span').html(pvg.string);

                            $('.select_month').removeClass('btn-selected');
                            $('.select_month').addClass('btn-primary');
                            $('.select_month').first().addClass('btn-selected');
                            $(`#pv_generator_${id}`).val(pvg.string);
                            $(`#pv_generator_${id}`).attr('data-html',pvg.pvgen);
                            $(`#output_${id}`).html(res.avg + " m <sup> 3 </sup>");
                            $(`#eff_${id}`).html(Math.round(res.avg / pvg.pvgen) + " m <sup> 3 </sup> / KWp " );
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
            let id = $('.select[type=radio]:checked').val();
            let PVGenerator = $(`#pv_generator_${id}`).val();
            let element = $(this);
            let month = element.attr('data-content');
            if (PVGenerator && id) {
                $.ajax({
                    type: 'POST',
                    url: 'pump/search/monthChart',
                    data: {
                        'id': id,
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
                            chartForMonth(res.chart);
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

        $("#PDF").click(function () {
            $.ajax({
                type: 'POST',
                url: 'getPdf',
                data: {
                    'id': $(".select:checked").val(),
                    'water_amount': $("#exampleInputWater").val(),
                    'dynamic_head': $("#exampleInputHead").val(),
                    'cable_length': $("#exampleInputCableLength").val(),
                    'location': $("#exampleFormControlLocation").val(),
                    'mounting_structure': $("#exampleFormControlMountingStructure").val()
                },
                success: function (res) {
                    let url = $("#url").val();
                    $("#PDF").attr('href',`${url}/${res}`);
                    $("#download").removeClass('hidden');
                }
            });
        });
    </script>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('#exampleFormControlSelectExistingOne').change(function () {
                if($(this).val() == 'no'){
                    // $("#module-name").addClass('d-none');
                    $("#module-config").removeClass('d-none');
                    $("#exist-module").removeClass('d-none');
                    // $('#add-module').addClass('d-none');
                    $('input[name=module_name]').val("");
                } else{
                    // $("#module-name").removeClass('d-none');
                    $("#module-config").addClass('d-none');
                    $("#exist-module").addClass('d-none');
                    // $('#add-module').removeClass('d-none');
                    $('input[name=voc]').val("");
                    $('input[name=vmpp]').val("");
                    $('input[name=power_max]').val("");
                }
            });

            $(".options").on('click',function () {
                $("#module-config").addClass('d-none');
            });
        });
        $('.select_pump').change(function () {
            if($('.select_pump').is(":checked")){
                $('.water_amount').css({'display': 'none'});
                $('.select_water_amount').css({'display': 'block'});
            } else{
                $('.water_amount').css({'display': 'block'});
                $('.select_water_amount').css({'display': 'none'});

            }
        });
    </script>
@endsection


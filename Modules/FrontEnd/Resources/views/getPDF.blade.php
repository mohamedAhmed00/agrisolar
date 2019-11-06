<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PUMP</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        .chartPDF{
            height: 400px;
            margin: 40px 0;
        }
        body{
            padding: 50px;
        }
        .hidden{
            display: none;
        }
        @page { size: auto;  margin: 0mm auto }
        @media print {

            body {
                color: #fff;
                background-color: #000;
                margin: auto 2em !important;
            }


        }
    </style>
</head>
<body>
<main>
    <div class="container">
        <div class="row">
            <div class="col-8">
                <a href="{{ url('dashboard') }}">
                    <img src="{{ asset('agrisolar/img/logo.png') }}">
                </a>
            </div>
            <div class="col-4">
                <div class="mt-5">Client Info : </div>
                <div>Name : {{ $data['user']->name }}</div>
                <div>Email : <a href="{{ $data['user']->email }}">{{ $data['user']->email }}</a></div>
            </div>
        </div>

        <h2 class="name mt-5">Solar Pumping Project : </h2>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Inputs</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Location</td>
                <td>{{ $data['city']->name }}</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Water Amount </td>
                <td>{{ $data['inputs']['water_amount'] }}</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Dynamic Head </td>
                <td>{{ $data['inputs']['dynamic_head'] }}</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Cable Length </td>
                <td>{{ $data['inputs']['cable_length'] }}</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Mounting Structure  </td>
                <td>{{ $data['inputs']['mounting_structure'] }}</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Module  </td>
                <td>Name: {{ !empty($data['module']->name)? $data['module']->name  :$data['module']->module_name  }}</td>
                <td>VOC : {{ $data['module']->voc }}</td>
                <td>VMPP : {{ $data['module']->vmpp }}</td>
                <td>Power Max : {{ $data['module']->power_max }}</td>
            </tr>
            </tbody>
        </table>

        <table class="table">
            <thead>
            <tr>
                <th scope="col">Product</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Model Name</td>
                <td>{{ $data['model']->model }}</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Motor HP</td>
                <td>{{ $data['model']->motor }}</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Number Of Stages</td>
                <td>{{ $data['model']->stages }}</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Motor Cable </td>
                <td>{{ $data['model']->length }}</td>
                <td></td>
                <td></td>
            </tr>
            </tbody>
        </table>

        <div class="row">
            <div id="chartContainer" class="col-12 chartPDF" style="width: 80% !important;"></div>
        </div>
        <div class="row">
            <div id="january" class="col-12 chartPDF hidden"></div>
        </div>
        <div class="row">
            <div id="february" class="col-12 chartPDF hidden"></div>
        </div>
        <div class="row">
            <div id="march" class="col-12 chartPDF hidden"></div>
        </div>
        <div class="row">
            <div id="april" class="col-12 chartPDF hidden"></div>
        </div>
        <div class="row">
            <div id="may" class="col-12 chartPDF hidden"></div>
        </div>
        <div class="row">
            <div id="june" class="col-12 chartPDF hidden"></div>
        </div>

        <div class="row">
            <div id="july" class="col-12 chartPDF hidden"></div>
        </div>
        <div class="row">
            <div id="august" class="col-12 chartPDF hidden"></div>
        </div>

        <div class="row">
            <div id="september" class="col-12 chartPDF hidden"></div>
        </div>
        <div class="row">
            <div id="october" class="col-12 chartPDF hidden"></div>
        </div>

        <div class="row">
            <div id="november" class="col-12 chartPDF hidden"></div>
        </div>
        <div class="row">
            <div id="december" class="col-12 chartPDF hidden"></div>
        </div>
        <div id="container" style="height: 300px"></div>


        <div class="text-center w-100">
            <img src="{{ asset('agrisolar/img/img.png') }}" class="img-responsive w-50 ">
        </div>
        @foreach($data['model']->getMedias as $media)
            <div class="text-center w-100 my-5">
                <img src="{{ asset($media->image) }}" class="img-responsive w-100 ">
            </div>
        @endforeach
        <div class="row">
            <div id="thanks">Thank you!</div>
        </div>
    </div>

    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Pdf Downloaded Successfully</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    return To Home Page
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a class="btn btn-primary" href="{{ url('dashboard') }}">Home Page</a>
                </div>
            </div>
        </div>
    </div>


</main>
<script src="{{ asset('vendor/jQuery/jquery-2.2.3.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
<script src="{{ asset('js/chart.js') }}"></script>
<script>
    function chart() {
        let data = JSON.parse('{!! $data['year'] !!}').points;
        let array = [];

        for (let i = 0; i < data.length; i++) {
            array[i] = {label: data[i][0], y: data[i][1]};
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
                color: ["#37474F"],
                dataPoints: array
            }]
        });
        chart.render();
        $('#chartContainer').css({'height': '400px'});
    };

    function renderMonth(data, month) {
        let array = [];
        for (let i = 0; i < data.length; i++) {
            array[i] = {label: data[i][0], y: data[i][1]};
        }
        $(`#${month}`).removeClass('hidden');
        var chart = new CanvasJS.Chart(month, {
            animationEnabled: true,
            exportEnabled: true,
            dataPointWidth: 40,
            theme: "light1", // "light1", "light2", "dark1", "dark2"
            title: {
                text: "Water Amount Per Month :" + month
            },
            data: [{
                type: "column", //change type to bar, line, area, pie, etc
                indexLabel: "{y}", //Shows y value on all Data Points
                indexLabelFontColor: "#5A5757",
                indexLabelPlacement: "outside",
                legendMarkerColor: "grey",
                color: ["#37474F"],
                dataPoints: array
            }]
        });
        chart.render();
        $(month).css({'height': '400px'});
    };

    function chartForMonth() {
        let data = JSON.parse('{!! $data['months'] !!}');
        if (data.january){
            renderMonth(data.january, 'january');
        }
        if (data.february){
            renderMonth(data.february, 'february');
        }
        if (data.march){
            renderMonth(data.march, 'march');
        }
        if (data.april){
            renderMonth(data.april, 'april');
        }

        if (data.may){
            renderMonth(data.may, 'may');
        }
        if (data.june){
            renderMonth(data.june, 'june');
        }
        if (data.july){
            renderMonth(data.july, 'july');
        }
        if (data.august){
            renderMonth(data.august, 'august');
        }

        if (data.september){
            renderMonth(data.september, 'september');
        }
        if (data.october){
            renderMonth(data.october, 'october');
        }
        if (data.november){
            renderMonth(data.november, 'november');
        }
        if (data.december){
            renderMonth(data.december, 'december');
        }
    };

    chart()
    chartForMonth();

    $(document).ready(function () {
        setTimeout(function(){
            window.print();
            $("#exampleModalLong").modal('show');
            }, 1000);
    });
</script>


<script type="text/javascript" src="{{ asset('agrisolar/js/echarts.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('agrisolar/js/echarts-gl.js') }}"></script>
<script type="text/javascript" src="{{ asset('agrisolar/js/ecStat.min.js') }}"></script>
<script>
    let collection = '{{ $heightPumps->points }}';
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
            text: 'Power [ KW ]',
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



</script>
</body>
</html>

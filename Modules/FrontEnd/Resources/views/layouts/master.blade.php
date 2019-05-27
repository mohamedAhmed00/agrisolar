<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{ asset('agrisolar/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('agrisolar/css/main.css') }}">
    <title>AgriSolar</title>
</head>
<body>
@yield('content')

<footer class="bg-success p-2 d-block w-100">
    <h5 class="h5 text-center text-capitalize font-weight-bold text-white d-block">Copy Rights Reserved By Nevdia INC</h5>
</footer>
<div class="modal fade" id="auth" tabindex="-1" role="dialog" aria-labelledby="auth" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-body py-4">
                <p class="font-weight-semiBold"><i class="fas fa-check-circle text-success mr-2"></i> Error </p>
                {{Session::get('unauth')}}
                <div class="mt-2 text-right">
                    <button class="btn btn-success btn-sm" data-dismiss="modal">Try Again</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal__flat_error" tabindex="-1" role="dialog" aria-labelledby="modal__flat_error" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body py-4">
                <p class="font-weight-semiBold"><i class="fas fa-check-circle text-success mr-2"></i> Error </p>
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
                <div class="mt-2 text-right">
                    <button class="btn btn-success btn-sm" data-dismiss="modal">Try Again</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal__flat_success" tabindex="-1" role="dialog" aria-labelledby="modal__flat_success" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body py-4">
                <p class="font-weight-semiBold"><i class="fas fa-check-circle text-success mr-2"></i> Successful </p>
                <p>
                    {{Session::get('successful')}}
                </p>
                <div class="mt-2 text-right">
                    <button class="btn btn-success btn-sm" data-dismiss="modal">done</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('agrisolar/js/jquery.js') }}"></script>
<script src="{{ asset('agrisolar/js/propper.js') }}"></script>
<script src="{{ asset('agrisolar/js/bootstrap.min.js') }}"></script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script>
    window.onload = function () {

        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            exportEnabled: true,
            theme: "light1", // "light1", "light2", "dark1", "dark2"
            title:{
                text: "Water Amount"
            },
            data: [{
                type: "column", //change type to bar, line, area, pie, etc
                //indexLabel: "{y}", //Shows y value on all Data Points
                indexLabelFontColor: "#5A5757",
                indexLabelPlacement: "outside",
                dataPoints: [
                    { label: 'January', y: 71 },
                    { label: 'February', y: 55 },
                    { label: 'March', y: 50 },
                    { label: 'April', y: 65 },
                    { label: 'May', y: 92, indexLabel: "Highest" },
                    { label: 'June', y: 68 },
                    { label: 'July', y: 38 },
                    { label: 'August', y: 71 },
                    { label: 'September', y: 54 },
                    { label: 'October', y: 60 },
                    { label: 'November', y: 36 },
                    { label: 'December', y: 21, indexLabel: "Lowest" }
                ]
            }]
        });
        chart.render();
    };
    $(document).ready(function () {
        $("#add-module").on('click',function(){
            $("#module-name").addClass('d-none');
            $("#module-config").removeClass('d-none');
            $("#exist-module").removeClass('d-none');
            $('#add-module').addClass('d-none');
            $('input[name=module_name]').val("");
        });
        $('#exist-module').on('click',function(){
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
@if (Session::has('unauth'))
    <script>
        $('#auth').modal('show');
    </script>
@endif

@if ($errors->any())
    <script>
        $('#modal__flat_error').modal('show');
    </script>
@endif

@if (Session::has('successful'))
    <script>
        $('#modal__flat_success').modal('show');
    </script>
@endif
</body>
</html>

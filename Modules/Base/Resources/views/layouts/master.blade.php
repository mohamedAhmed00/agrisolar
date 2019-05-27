@php
    $admin = getAdmin();
@endphp
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Agrisolar Admin</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="shortcut icon" href="{{ asset('resources/img/favicon.ico') }}" />
        <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
        <link href="{{ asset('resources/icons/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
        <link href="{{ asset('resources/icons/themify-icons/themify-icons.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('vendor/animate.css') }}">
        <link rel="stylesheet" href="{{ asset('resources/css/main-style.min.css') }}">
        <link rel="stylesheet" href="{{ asset('resources/css/skins/all-skins.min.css') }}">
        <link rel="stylesheet" href="{{ asset('resources/css/demo.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/dropzone/dropzone.css') }}">


        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue sidebar-mini">
        <div class="page-loader-wrapper" >
            <div class="loader">
                <div class="preloader">
                    <svg class='part' x="0px" y="0px" viewBox="0 0 256 256" style="enable-background:new 0 0 256 256;" xml:space="preserve">
                    <path class="svgpath" id="playload" d="M189.5,140.5c-6.6,29.1-32.6,50.9-63.7,50.9c-36.1,0-65.3-29.3-65.3-65.3
                          c0,0,17,0,23.5,0c10.4,0,6.6-45.9,11-46c5.2-0.1,3.6,94.8,7.4,94.8c4.1,0,4.1-92.9,8.2-92.9c4.1,0,4.1,83,8.1,83
                          c4.1,0,4.1-73.6,8.1-73.6c4.1,0,4.1,63.9,8.1,63.9c4.1,0,4.1-53.9,8.1-53.9c4.1,0,4.1,44.1,8.2,44.1c4.1,0,3.1-34.5,7.2-34.5
                          c4.1,0,3.1,24.6,7.2,24.6c4.1,0,2.5-14.5,5.2-14.5c2.2,0,0.8,5.1,4.2,4.9c0.4,0,13.1,0,13.1,0c0-34.4-27.9-62.3-62.3-62.3
                          c-27.4,0-50.7,17.7-59,42.3" />
                    <path class="svgbg" d="M61,126c0,0,16.4,0,23,0c10.4,0,6.6-45.9,11-46c5.2-0.1,3.6,94.8,7.4,94.8c4.1,0,4.1-92.9,8.2-92.9
                          c4.1,0,4.1,83,8.1,83c4.1,0,4.1-73.6,8.1-73.6c4.1,0,4.1,63.9,8.1,63.9c4.1,0,4.1-53.9,8.1-53.9c4.1,0,4.1,44.1,8.2,44.1
                          c4.1,0,3.1-34.5,7.2-34.5c4.1,0,3.1,24.6,7.2,24.6c4.1,0,2.5-14.5,5.2-14.5c2.2,0,0.8,5.1,4.2,4.9c0.4,0,22.5,0,23,0" />
                    </svg>
                </div>
            </div>
        </div>
        <div class="wrapper">
            <header class="top-menu-header">
                <a href="{{ url('_admin_/base') }}" class="logo">
                    <span class="logo-mini"><b>A</b>GR</span>
                    <span class="logo-lg"><b>AGRISOLAR </b>ADMIN</span>
                </a>
                <!-- Header Navbar -->
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                    <a class="sidebar-toggle fa-icon" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <!-- Navbar Right Menu -->
                    <div class="navbar-top-menu">
                        <ul class="nav navbar-nav">
                            {{--<li>--}}
                                {{--<a data-toggle="collapse" data-target="#top-menu-navbar-search" aria-expanded="false">--}}
                                    {{--<i class="fa fa-search"></i>--}}
                                {{--</a>--}}
                            {{--</li>--}}
                            <li>
                                <a id="fullscreen-page" role="button"><i class="fa fa-arrows-alt"></i></a>
                            </li>
{{--                            <li class="dropdown messages-menu">--}}
{{--                                <!-- Menu toggle button -->--}}
{{--                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">--}}
{{--                                    <i class="fa fa-envelope-o"></i>--}}
{{--                                    <span class="label label-success">{{ count($contacts) }}</span>--}}
{{--                                </a>--}}
{{--                                <ul class="dropdown-menu animated flipInX">--}}
{{--                                    <li class="header">{{ count($contacts) }} message pending</li>--}}
{{--                                    <li>--}}
{{--                                        <ul class="menu">--}}
{{--                                            @foreach($contacts as $contact)--}}
{{--                                                <li>--}}
{{--                                                    <a href="{{ route('contact.show',$contact->id) }}">--}}
{{--                                                        <h4 style="margin: 0;">--}}
{{--                                                            {{ $contact->name }}--}}
{{--                                                            <small><i class="fa fa-clock-o"></i> {{ $contact->created_at->diffForHumans() }}</small>--}}
{{--                                                        </h4>--}}
{{--                                                    </a>--}}
{{--                                                </li>--}}
{{--                                            @endforeach--}}
{{--                                        </ul>--}}
{{--                                    </li>--}}
{{--                                    <li class="footer"><a href="{{ url('contact') }}">See All Messages</a></li>--}}
{{--                                </ul>--}}
{{--                            </li>--}}
                            <li class="dropdown user user-menu">
                                <!-- Menu Toggle Button -->
                                <a href="#" data-toggle="dropdown" aria-expanded="false">
                                    <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                    <span class="hidden-xs">{{ $admin->name }}<i class="fa fa-angle-down pull-right"></i></span>
                                    <!-- The user image in the navbar-->
                                    <img src="{{ asset('resources/img/icons/icon-user.png') }}" class="user-image" alt="User Image">
                                </a>
                                <ul class="dropdown-menu user-menu animated flipInY">
                                    <li><a href="{{ route('user.show') }}"><i class="ti-user"></i> Profile</a></li>
                                    <li><a href="{{ url('_admin_/setting') }}"><i class="ti-settings"></i> Setting</a></li>
                                    <li class="divider"></li>
                                    <li>
                                        <form action="{{ route('logout') }}" method="post">
                                            @csrf
                                            <button style="background: none;border: none"><i class="ti-power-off"></i> Log Out</button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <!-- Form Navbar Search -->
                        <div class="collapse top-menu-navbar-search" id="top-menu-navbar-search">
                            <form>
                                <div class="form-group">
                                    <div class="input-search">
                                        <div class="input-group">
                                            <input type="text" id="navbar-search" name="search" class="form-control" placeholder="Search">
                                            <span class="input-group-addon">
                                                <a data-target="#top-menu-navbar-search" data-toggle="collapse" aria-label="Close" aria-expanded="true"><i class="fa fa-times"></i></a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /. Form Navar Search -->
                    </div>
                </nav>
            </header>
            <aside class="sidebar-left">
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="{{ asset((!empty($admin->Image)?$admin->Image->image:'resources/img/icons/icon-user.png')) }}" class="img-circle" alt="User Image">
                        </div>
                        <div class="info">
                            <p>{{ $admin->name }}</p>
                            <p><small>Admin</small>
                            </p>
                            <a href="{{ url('_admin_//base') }}"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                        <div class="report-today">
                            <h5>All Actions</h5>
                            <ul>
                                <li><span>7<i>Products</i></span></li>
                                <li><span>5<i>Pages</i></span></li>
                                <li><span>1<i>Contact</i></span></li>
                            </ul>
                        </div>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="header">MAIN MENU</li>
                        <li class="treeview active"><a href="{{ url('_admin_/base') }}"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>

                        @can('view', Modules\Pumps\Entities\Pump::class)
                            <li class="treeview active"><a href="{{ url('_admin_/pumps') }}"><i class="fa fa-bookmark"></i> <span>Pumps</span></a></li>
                        @endcan
                        @can('view', \Modules\Setting\Entities\Setting::class)
                            <li class="treeview"><a href="{{ url('_admin_/setting') }}"><i class="fa fa-wrench"></i> <span>Website Setting</span></a></li>
                        @endcan
                        @can('view', \Modules\Groups\Entities\Group::class)
                            <li class="treeview"><a href="{{ url('_admin_/groups') }}"><i class="fa fa-user"></i> <span>USER GROUPS</span></a></li>
                        @endcan
                        @can('view', \Modules\Users\Entities\User::class)
                            <li class="treeview"><a href="{{ url('_admin_/users') }}"><i class="fa fa-user"></i> <span>Website Admins</span></a></li>
                        @endcan
                    </ul>
                </section>
            </aside>
            <div class="content-wrapper">
                @yield('content')
            </div>
            <footer class="main-footer">
                <strong>Copyright &copy; reserved at {{ date('Y',time()) }} to <a href="http://www.nevdia.com">nevdia.com</a>.</strong>
                <div class="pull-right hidden-xs"></div>
            </footer>
        </div>
        <div class="modal modal-success fade" id="modal-success">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Action done successfully</h4>
                    </div>
                    <div class="modal-body">
                        <p>{{ session()->get('successful') }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <div class="modal modal-danger fade" id="modal-danger">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Error in Action ( Action Not Completed )</h4>
                    </div>
                    <div class="modal-body">
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <script src="{{ asset('vendor/jQuery/jquery-2.2.3.min.js') }}"></script>
        <script src="{{ asset('vendor/jquery-fullscreen/jquery.fullscreen-min.js') }}"></script>
        <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('vendor/slimScroll/jquery.slimscroll.min.js') }}"></script>
        <script src="{{ asset('vendor/fastclick/fastclick.min.js') }}"></script>
        <script src="{{ asset('vendor/chartjs/Chart.min.js') }}"></script>
        <script src="{{ asset('vendor/sparkline/jquery.sparkline.min.js') }}"></script>
        <script src="{{ asset('resources/js/app.min.js') }}"></script>
        <script src="{{ asset('resources/js/demo.js') }}"></script>
        <script src="{{ asset('resources/js/pages/dashboard.js') }}"></script>
        <script src="{{ asset('vendor/dropzone/dropzone.js') }}"></script>
        <script src="{{ asset('vendor/jquery.canvasjs.min.js') }}"></script>
        <script>
            @if ($errors->any())
                $("#modal-danger").modal('show');
            @endif
            @if(session()->has('successful'))
                $("#modal-success").modal('show');
            @endif

            $('.confirm').hide();

            $('.remove').click(function() {
                $(this).next('.confirm').show();
            });

            $('.keep-button').click(function() {
                $(this).parents('.confirm').hide();
            })

            $('.kill-button').click(function() {
                $(this).parents('.slab').addClass('deleted').slideUp();
            });

            $('.select_type').on('change', function(e) {
                $('.select_type_item').addClass('hidden');
                let selector = $(this).val();
                $('.'+selector).removeClass('hidden');
                $("#setting_type").val(selector);
            });
        </script>
        @php
            \request()->session()->forget('successful');
        @endphp
    </body>
</html>

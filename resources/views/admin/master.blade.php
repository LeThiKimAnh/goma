<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Khóa Học Lập Trình Laravel Framework 5.x Tại Khoa Phạm">
    <meta name="author" content="Vu Quoc Tuan">
    <title>Admin - KimAnh</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{url('admin/bower_components/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{url('admin/bower_components/metisMenu/dist/metisMenu.min.css')}}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{url('admin/dist/css/sb-admin-2.css')}}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{url('admin/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet')}}" type="text/css">

    <!-- DataTables CSS -->
    <link href="{{url('admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css')}}" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="{{url('admin/bower_components/datatables-responsive/css/dataTables.responsive.css')}}" rel="stylesheet">
    <!-- CKeditor && CKFinder -->
    <script src="{{url('admin/js/ckeditor/ckeditor.js')}}"></script>
    <script src="{{url('admin/js/ckfinder/ckfinder.js')}}"></script>
    <script src="{{url('admin/js/func_ckfinder.js')}}"></script>
    <script type="text/javascript">
        var baseURL = "{!!url('/')!!}";
    </script>
     <!-- End CKeditor && CKFinder -->
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Admin Area - KimAnh</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="glyphicon glyphicon-user"></i>  <i class="glyphicon glyphicon-menu-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="glyphicon glyphicon-user"></i>  {!!Auth::user()->username!!}</a>
                        </li>
                        <li><a href="#"><i class="glyphicon glyphicon-cog"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="{!!URL::route('getLogout')!!}"><i class="glyphicon glyphicon-log-out"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="glyphicon glyphicon-search"></i>
                                    </button>
                                </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="{!!URL::route('dashboard')!!}"><i class="glyphicon glyphicon-dashboard"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="#"><i class="glyphicon glyphicon-list-alt"></i> Đơn Hàng<span class="glyphicon glyphicon-triangle-bottom"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{!!URL::route('getDonhang')!!}"> Thêm đơn hàng</a>
                                </li>
                                <li>
                                    <a href="{!!URL::route('listDh')!!}"> Danh sách đơn hàng</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="glyphicon glyphicon-book"></i> Vật Dụng<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{!!URL::route('getVatdung')!!}"> Thêm vật dụng</a>
                                </li>
                                <li>
                                    <a href="{!!URL::route('vd-getList')!!}"> Danh sách vật dụng</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="glyphicon glyphicon-book"></i> Vật Liệu<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{!!URL::route('getVatLieu')!!}"> Thêm vật liệu</a>
                                </li>
                                <li>
                                    <a href="{!!URL::route('list')!!}"> Danh sách vật liệu</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="glyphicon glyphicon-user"></i> User<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{!!URL::route('listUser')!!}">List User</a>
                                </li>
                                <li>
                                    <a href="{!!URL::route('userAdd')!!}"> Add User</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">@yield('controller')
                            <small>@yield('action')</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-12  ">
                        @if(Session::has('flash_message'))
                            <div class="alert alert-danger {!! Session::get('flash_level') !!}">
                                {!! Session::get('flash_message') !!}
                            </div>
                        @endif
                    </div>
                    <!-- đây là nơi chứa nội dung -->

                    @yield('content')

                    <!-- End đây là nơi chứa nội dung -->
                </div>
                <!-- /.row -->
            </div>
        </div>
        <!-- /#page-wrapper -->
       

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="{{url('admin/bower_components/jquery/dist/jquery.min.js')}}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{url('admin/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{url('admin/bower_components/metisMenu/dist/metisMenu.min.js')}}"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{url('admin/dist/js/sb-admin-2.js')}}"></script>

    <!-- DataTables JavaScript -->
    <script src="{{url('admin/bower_components/datatables/media/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js')}}"></script>
    <!--myscript -->
    <script src="{{url('admin/js/myscript.js')}}"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
</body>

</html>

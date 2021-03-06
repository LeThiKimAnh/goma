<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Admin - {!!Auth::user()->username!!}</title>

		<!-- Bootstrap Core CSS -->
		<link href="{{url('admin/bower_components/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">

		<!-- MetisMenu CSS -->
		<link href="{{url('admin/bower_components/metisMenu/dist/metisMenu.min.css')}}" rel="stylesheet">

		<!-- Custom CSS -->
		<link href="{{url('admin/dist/css/sb-admin-2.css')}}" rel="stylesheet">

		<link href="{{url('admin/dist/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

		<!-- DataTables CSS -->
		<link href="{{url('admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css')}}" rel="stylesheet">

		<!-- DataTables Responsive CSS -->
		<link href="{{url('admin/bower_components/datatables-responsive/css/dataTables.responsive.css')}}" rel="stylesheet">
		<link href="{{url('admin/dist/css/datepicker.css')}}" rel="stylesheet prefetch">
		<!-- <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> -->
		<link href="{{url('admin/dist/css/bootstrap.min.css')}}" rel="stylesheet prefetch">
		<!-- CKeditor && CKFinder -->
		<script src="{{url('admin/js/ckeditor/ckeditor.js')}}"></script>
		
		

		<script src="{{url('admin/js/ckfinder/ckfinder.js')}}"></script>
		<script src="{{url('admin/js/func_ckfinder.js')}}"></script>
		<script src="{{url('admin/js/jquery-1.9.1.js')}}"></script>
		<!-- <script src="{{url('admin/js/bootstrap.min.js')}}"></script> -->
		<script src="{{url('admin/js/jquery-ui.js')}}"></script>


		<script type="text/javascript">
			var baseURL = "{!!url('/')!!}";
		</script>
		<!-- End CKeditor && CKFinder -->
		<script src="{{url('admin/js/jquery.min.js')}}"></script>
		<style>
			.carousel-inner > .item > img,
			.carousel-inner > .item > a > img {
				width: 70%;
				margin: auto;
			}
			.back-to-top {
				cursor: pointer;
				position: fixed;
				bottom: 20px;
				right: 20px;
				display:none;
			}
			.centered-text {
				text-align:center
			} 
			.glyphicon-bed:before {
				content: "\e219";
			}
			.navbar {
				min-height: 65px;
			}
			.sidebar{
				margin-top: 65px;
			}
		</style>
	</head>

	<body>

		<div id="wrapper" >
			<!-- Navigation -->
			<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a href="{!!URL::route('dashboard')!!}">
						<img src="{{url('admin/images/logo.png')}}" width="70px" height="50px" style="margin-left:80px; margin-top:5px">
					</a>	
				</div>
				<div class="navbar-brand " style="margin-left:410px;"><h2 style="margin-top: 0px;">Công ty TNHH Tuyết Nga</h2></div>
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
							<li class="divider"></li>
							<form method="POST" action="{!!URL::route('postLogout')!!}" id="logout">
								<input type="hidden" name="_token" value="{!! csrf_token() !!}" />
								<li><a href="#" type="button" onclick="return logout()"><i class="glyphicon glyphicon-log-out"></i> Logout</a>
								</li>
							</form>
						</ul>
						<!-- /.dropdown-user -->
					</li>
					<!-- /.dropdown -->
				</ul>
				<!-- /.navbar-top-links -->

				<div class="navbar-default sidebar" role="navigation">
					<div class="sidebar-nav navbar-collapse">
						<ul class="nav" id="side-menu">
							<!-- <li class="sidebar-search">
								<div class="input-group custom-search-form">
									<input type="text" class="form-control" placeholder="Search...">
									<span class="input-group-btn">
										<button class="btn btn-default" type="button">
											<i class="glyphicon glyphicon-search"></i>
										</button>
									</span>
								</div>
							</li> -->
							<li>
								<a href="{!!URL::route('dashboard')!!}"><i class="glyphicon glyphicon-dashboard"></i> Dashboard</a>
							</li>
							<li>
								<a href="#"><i class="glyphicon glyphicon-list-alt"></i> Đơn Hàng<span class="fa arrow"></span></a>
								<ul class="nav nav-second-level">
									<li>
										<a href="{!!URL::route('listDh')!!}"> Danh sách đơn hàng</a>
									</li>
									@if(Auth::user()->level ==1||Auth::user()->level ==2||Auth::user()->level ==3)
									<li>
										<a href="{!!URL::route('getDonhang')!!}"> Thêm đơn hàng</a>
									</li>
									@endif
								</ul>
								<!-- /.nav-second-level -->
							</li>
							@if(Auth::user()->level ==1||Auth::user()->level ==2)
							<li>
								<a href="#"><i class="glyphicon glyphicon-bed"></i> Sản phẩm<span class="fa arrow"></span></a>
								<ul class="nav nav-second-level">
									<li>
										<a href="{!!URL::route('vd-getList')!!}"> Danh sách sản phẩm</a>
									</li>
									<li>
										<a href="{!!URL::route('getVatdung')!!}"> Thêm sản phẩm</a>
									</li>
								</ul>
								<!-- /.nav-second-level -->
							</li>

							<li>
								<a href="#"><i class="glyphicon glyphicon-object-align-bottom"></i> Vật Liệu<span class="fa arrow"></span></a>
								<ul class="nav nav-second-level">
									<li>
										<a href="{!!URL::route('list')!!}"> Danh sách vật liệu</a>
									</li>
									<li>
										<a href="{!!URL::route('getVatLieu')!!}"> Thêm vật liệu</a>
									</li>
								</ul>
								<!-- /.nav-second-level -->
							</li>

							<li>
								<a href="#"><i class="glyphicon glyphicon-home"></i> Kho Gỗ<span class="fa arrow"></span></a>
								<ul class="nav nav-second-level">
									<li>
										<a href="{!!URL::route('khogoList')!!}"> Danh sách kho</a>
									</li>
									<!-- <li>
										<a href="{!!URL::route('khogoAdd')!!}"> Thêm gỗ</a>
									</li> -->
								</ul>
								<!-- /.nav-second-level -->
							</li>
							@endif
							<li>
								<a href="#"><i class="glyphicon glyphicon-user"></i> User<span class="fa arrow"></span></a>
								<ul class="nav nav-second-level">
									<li>
										<a href="{!!URL::route('listUser')!!}">Danh Sách User</a>
									</li>
									@if(Auth::user()->level ==1)
									<li>
										<a href="{!!URL::route('userAdd')!!}"> Thêm User</a>
									</li>
									@endif
									<li>
										<a href="{!!URL::route('getRepass')!!}">Đổi mật khẩu</a>
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
					<!-- Page Heading -->
					<div class="row">
						<div class="col-lg-12" style="margin-top:40px; ">
							<h2 class="page-header">@yield('controller')
								<small>@yield('action')</small>
							</h2>
						</div>
						<!-- /.col-lg-12 -->
						<div class="col-lg-12  ">
							@if(Session::has('flash_message'))
                            <div class="alert alert-danger {!! Session::get('flash_level') !!}">
                                {!! Session::get('flash_message') !!}
                            </div>
							@elseif(Session::has('flash_message_success'))
                            <div class="alert alert-success {!! Session::get('flash_level') !!}">
                                {!! Session::get('flash_message_success') !!}
                            </div>
							@endif
						</div>
						<!-- đây là nơi chứa nội dung -->
					</div>
					<div>
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
		<script src="{{url('admin/js/bootstrap-datepicker.js')}}"></script>


		<!-- DataTables JavaScript -->
		<script src="{{url('admin/bower_components/datatables/media/js/jquery.dataTables.min.js')}}"></script>
		<script src="{{url('admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js')}}"></script>
		<script src="{{url('admin/js/jquery.canvasjs.js')}}"></script>
    	<script src="{{url('admin/js/canvasjs.js')}}"></script>
		<!--myscript -->
		<script src="{{url('admin/js/myscript.js')}}"></script>


		<!-- Page-Level Demo Scripts - Tables - Use for reference -->
	</body>

</html>

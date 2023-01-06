<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="description" content="Management Information System">
	<meta name="keywords" content="HTML, CSS, JavaScript">
	<meta name="author" content="Chrispin B. Zamoranos">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	<title>@yield('title')</title>
	<!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="{{ URL::to('images/Logo.png') }}">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<!-- Fontawesome CSS -->
	<link rel="stylesheet" href="{{ URL::to('assets/css/font-awesome.min.css') }}">
	<!-- Lineawesome CSS -->
	<link rel="stylesheet" href="{{ URL::to('assets/css/line-awesome.min.css') }}">
	<!-- Datatable CSS -->
	<link rel="stylesheet" href="{{ URL::to('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
	<link rel="stylesheet" href="{{ URL::to('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
	<!-- Select2 CSS -->
	<link rel="stylesheet" href="{{ URL::to('assets/css/select2.min.css') }}">
	<!-- Datetimepicker CSS -->
	<link rel="stylesheet" href="{{ URL::to('assets/css/bootstrap-datetimepicker.min.css') }}">
	<!-- Chart CSS -->
	<link rel="stylesheet" href="{{ URL::to('ssets/plugins/morris/morris.css') }}">
	<!-- Main CSS -->
	<link rel="stylesheet" href="{{ URL::to('assets/css/style.css') }}">

	<!-- Theme style -->
	<link rel="stylesheet" href="{{ URL::to('dist/css/adminlte.min.css') }}">

	{{-- message toastr --}}
	<link rel="stylesheet" href="{{ URL::to('assets/css/toastr.min.css') }}">
	<script src="{{ URL::to('assets/js/toastr_jquery.min.js') }}"></script>
	<script src="{{ URL::to('assets/js/toastr.min.js') }}"></script>
</head>

<body>
	<!-- Main Wrapper -->
	<div class="main-wrapper">
		
		<!-- Loader -->
		<div id="loader-wrapper">
			<div id="loader">
				<div class="loader-ellips">
				  <span class="loader-ellips__dot"></span>
				  <span class="loader-ellips__dot"></span>
				  <span class="loader-ellips__dot"></span>
				  <span class="loader-ellips__dot"></span>
				</div>
			</div>
		</div>
		<!-- /Loader -->

		<!-- Header -->
		<div class="header">
			<!-- Logo -->
			<div class="header-left">
				<a href="{{ route('home') }}" class="logo">
					<img src="{{ URL::to('images/Logo.png') }}" width="50" height="50" alt="Villaviciosa Seal">
				</a>
			</div>
			<!-- /Logo -->
			<a id="toggle_btn" href="javascript:void(0);">
				<span class="bar-icon">
					<span></span>
					<span></span>
					<span></span>
				</span>
			</a>
			<!-- Header Title -->
			<div class="page-title-box">
				<h3>Hi, {{ Session::get('user') }}</h3>
			</div>
			<!-- /Header Title -->
			<a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>
			<!-- Header Menu -->
			<ul class="nav user-menu">

				<!-- Notifications -->
				<li class="nav-item dropdown">
					<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
						<i class="fa fa-bell-o"></i>
						<span class="badge badge-pill">3</span> 
					</a>
					<div class="dropdown-menu notifications">
						<div class="topnav-dropdown-header">
							<span class="notification-title">Notifications</span> 
							<a href="javascript:void(0)" class="clear-noti"> Clear All </a> 
						</div>
						<div class="noti-content">
							<ul class="notification-list">
								<li class="notification-message">
									<a href="activities.html">
										<div class="media">
											<span class="avatar">
												<img src="/storage/images/{{Auth::user()->image}}" class="img-circle" alt="User Image"/>
											</span>
											<div class="media-body">
												<p class="noti-details"><span class="noti-title">John Doe</span> added new task <span class="noti-title">Patient appointment booking</span></p>
												<p class="noti-time"><span class="notification-time">4 mins ago</span></p>
											</div>
										</div>
									</a>
								</li>
								<li class="notification-message">
									<a href="activities.html">
										<div class="media">
											<span class="avatar">
												<img src="/storage/images/{{Auth::user()->image}}" class="img-circle" alt="User Image"/>
											</span>
											<div class="media-body">
												<p class="noti-details"><span class="noti-title">Tarah Shropshire</span> changed the task name <span class="noti-title">Appointment booking with payment gateway</span></p>
												<p class="noti-time"><span class="notification-time">6 mins ago</span></p>
											</div>
										</div>
									</a>
								</li>
								<li class="notification-message">
									<a href="activities.html">
										<div class="media">
											<span class="avatar">
												<img src="/storage/images/{{Auth::user()->image}}" class="img-circle" alt="User Image"/>
											</span>
											<div class="media-body">
												<p class="noti-details"><span class="noti-title">Misty Tison</span> added <span class="noti-title">Domenic Houston</span> and <span class="noti-title">Claire Mapes</span> to project <span class="noti-title">Doctor available module</span></p>
												<p class="noti-time"><span class="notification-time">8 mins ago</span></p>
											</div>
										</div>
									</a>
								</li>
								<li class="notification-message">
									<a href="activities.html">
										<div class="media">
											<span class="avatar">
												<img src="/storage/images/{{Auth::user()->image}}" class="img-circle" alt="User Image"/>
											</span>
											<div class="media-body">
												<p class="noti-details"><span class="noti-title">Rolland Webber</span> completed task <span class="noti-title">Patient and Doctor video conferencing</span></p>
												<p class="noti-time"><span class="notification-time">12 mins ago</span></p>
											</div>
										</div>
									</a>
								</li>
								<li class="notification-message">
									<a href="activities.html">
										<div class="media">
											<span class="avatar">
												<img src="/storage/images/{{Auth::user()->image}}" class="img-circle" alt="User Image"/>
											</span>
											<div class="media-body">
												<p class="noti-details"><span class="noti-title">Bernardo Galaviz</span> added new task <span class="noti-title">Private chat module</span></p>
												<p class="noti-time"><span class="notification-time">2 days ago</span></p>
											</div>
										</div>
									</a>
								</li>
							</ul>
						</div>
						<div class="topnav-dropdown-footer"> <a href="#">View all Notifications</a> </div>
					</div>
				</li>
				<!-- /Notifications -->
				
				<!-- Message Notifications -->
				<li class="nav-item dropdown">
					<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
						<i class="fa fa-comment-o"></i> <span class="badge badge-pill">8</span>
					</a>
					<div class="dropdown-menu notifications">
						<div class="topnav-dropdown-header">
							<span class="notification-title">Messages</span> 
							<a href="javascript:void(0)" class="clear-noti"> Clear All </a>
						 </div>
						<div class="noti-content">
							<ul class="notification-list">
								<li class="notification-message">
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">
													<img src="/storage/images/{{Auth::user()->image}}" class="img-circle" alt="User Image"/>
												</span>
											</div>
											<div class="list-body">
												<span class="message-author">Richard Miles </span> 
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span> 
											</div>
										</div>
									</a>
								</li>
								<li class="notification-message">
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">
													<img src="/storage/images/{{Auth::user()->image}}" class="img-circle" alt="User Image"/>
												</span>
											</div>
											<div class="list-body">
												<span class="message-author">John Doe</span> 
												<span class="message-time">6 Mar</span>
												<div class="clearfix"></div> 
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span> 
											</div>
										</div>
									</a>
								</li>
								<li class="notification-message">
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">
													<img src="/storage/images/{{Auth::user()->image}}" class="img-circle" alt="User Image"/>
												</span>
											</div>
											<div class="list-body">
												<span class="message-author"> Tarah Shropshire </span>
												<span class="message-time">5 Mar</span>
												<div class="clearfix"></div> 
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span> 
											</div>
										</div>
									</a>
								</li>
								<li class="notification-message">
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">
													<img src="/storage/images/{{Auth::user()->image}}" class="img-circle" alt="User Image"/>
												</span>
												</div>
											<div class="list-body">
												<span class="message-author">Mike Litorus</span>
												<span class="message-time">3 Mar</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span> 
											</div>
										</div>
									</a>
								</li>
								<li class="notification-message">
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">
													<img src="/storage/images/{{Auth::user()->image}}" class="img-circle" alt="User Image"/>
												</span>
											</div>
											<div class="list-body">
												<span class="message-author"> Catherine Manseau </span>
												<span class="message-time">27 Feb</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
							</ul>
						</div>
						<div class="topnav-dropdown-footer"> <a href="#">View all Messages</a> </div>
					</div>
				</li>
				<!-- /Message Notifications -->
				<li class="nav-item dropdown has-arrow main-drop">
					<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
						<span class="user-img">
							<img src="/storage/images/{{Auth::user()->image}}" width="35" height="35" alt="{{Auth::user()->name}}"/>
						<span class="status online"></span></span>
						<span>{{ Session::get('user') }}</span>
					</a>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="{{ route('edit.profile', auth()->user()->id) }}"><i class='fa fa-user'></i> My Profile</a>
						<a class="dropdown-item" href="{{ route('login.locked') }}"><i class='fa fa-lock'></i> Lockscreen</a>
						<a class="dropdown-item" href="{!! url('/logout') !!}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class='fa fa-sign-out'></i> Sign out
                        </a>
						<form id="logout-form" action="{{ url('/logout') }}" method="POST"
							style="display: none;">
							{{ csrf_field() }}
						</form>
					</div>
				</li>
			</ul>
			<!-- /Header Menu -->

			<!-- Mobile Menu -->
			<div class="dropdown mobile-user-menu">
				<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
					<i class="fa fa-ellipsis-v"></i>
				</a>
				<div class="dropdown-menu dropdown-menu-right">
					<a class="dropdown-item" href="{{ route('edit.profile', auth()->user()->id) }}"> My Profile</a>
					<a class="dropdown-item" href="{{ route('login.locked') }}">Lockscreen</a>
					<a class="dropdown-item" href="{!! url('/logout') !!}"
										onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
						Sign out
					</a>
					<form id="logout-form" action="{{ url('/logout') }}" method="POST"
						style="display: none;">
						{{ csrf_field() }}
					</form>
				</div>
			</div>
			<!-- /Mobile Menu -->

		</div>
		<!-- /Header -->

			<!-- Sidebar -->
			@include('layouts.sidebar')
			<!-- /Sidebar -->

			<!-- Page Wrapper -->
			<div class="page-wrapper">
				<!-- Page Content -->
				<div class="content container-fluid">
					@yield('content')
				</div>
				<!-- /Page Content -->
			</div>
			<!-- /Page Wrapper -->

	</div>
	<!-- /Main Wrapper -->

	<!-- jQuery -->
	<script src="{{ URL::to('assets/js/jquery-3.5.1.min.js') }}"></script>
	<!-- jQuery -->
	<script src="{{ URL::to('plugins/jquery/jquery.min.js') }}"></script>
	<!-- Bootstrap 4 -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<!-- AdminLTE App -->
	<script src="{{ URL::to('dist/js/adminlte.min.js') }}"></script>

	<!-- Bootstrap Core JS -->
	<script src="{{ URL::to('assets/js/popper.min.js') }}"></script>
	<script src="{{ URL::to('assets/js/bootstrap.min.js') }}"></script>
	<!-- Chart JS -->
	<script src="{{ URL::to('assets/plugins/morris/morris.min.js') }}"></script>
	<script src="{{ URL::to('assets/plugins/raphael/raphael.min.js') }}"></script>
	<script src="{{ URL::to('assets/js/chart.js') }}"></script>
	<script src="{{ URL::to('assets/js/Chart.min.js') }}"></script>
	<script src="{{ URL::to('assets/js/line-chart.js') }}"></script>	
	<!-- Slimscroll JS -->
	<script src="{{ URL::to('assets/js/jquery.slimscroll.min.js') }}"></script>
	<!-- Select2 JS -->
	<script src="{{ URL::to('assets/js/select2.min.js') }}"></script>
	<!-- Datetimepicker JS -->
	<script src="{{ URL::to('assets/js/moment.min.js') }}"></script>
	<script src="{{ URL::to('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
	<!-- Datatable JS -->
	<script src="{{ URL::to('assets/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ URL::to('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
	<!-- Multiselect JS -->
	<script src="{{ URL::to('assets/js/multiselect.min.js') }}"></script>		
	<!-- Custom JS -->
	<script src="{{ URL::to('assets/js/app.js') }}"></script>

	{{-- message --}}
	{!! Toastr::message() !!}

	@yield('script')

	<script>
		document.addEventListener('contextmenu', event => event.preventDefault());
	</script>

	<script type="text/javascript">
        $(document).on("click", ".archiveUser", function () {
            var post_id = $(this).data('post_id');
            $(".modal-body #post_id").val( post_id );
        });

        $(document).on("click", ".restoreUser", function () {
            var post_id = $(this).data('post_id');
            $(".modal-body #post_id").val( post_id );
        });

        $(document).on("click", ".deleteResSec", function () {
            var res_id = $(this).data('post_id');
            $(".modal-body #res_id").val( res_id );
        });

        $(document).on("click", ".changeBrgy", function () {
            var res_id = $(this).data('res_id');
            $(".modal-body #res_id").val( res_id );
        });

        $(document).on("click", ".admindeleteRes", function () {
            var res_id = $(this).data('res_id');
            $(".modal-body #res_id").val( res_id );
        });

		$(document).on("click", ".admindeleteSec", function () {
            var res_id = $(this).data('res_id');
			var res_sec_id = $(this).data('res_sec_id');
			var sector_id = $(this).data('sector_id');
            $(".modal-body #res_id").val( res_id );
			$(".modal-body #res_sec_id").val( res_sec_id );
			$(".modal-body #sector_id").val( sector_id );
        });
    </script>
	
</body>
</html>
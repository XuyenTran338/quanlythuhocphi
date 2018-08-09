<!DOCTYPE html>
<html>
<head>
	<title>@yield('title')</title>
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<base href="{{ asset('') }}">
	<!-- Bootstrap -->
	<link rel="stylesheet" href="{{ asset('user/public/lib/bootstrap/css/bootstrap.min.css')}}">
	<!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
	<!-- Font family -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Encode+Sans+Expanded">
  	<link rel='shortcut icon' type='image/x-icon' href="{{ asset('user/public/img/logo_bakcad.png') }}" />

  	<!-- FooTable Bootstrap CSS-->
  	  <!--   <link href="{{ asset('user/public/lib/FooTable/compiled/footable.bootstrap.min.css')}}" rel="stylesheet"> -->
	<!-- Datatable -->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
	<!-- Select BS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

    <!-- animate.css stylesheet -->
    <link rel="stylesheet" href="{{ asset('admin/public/assets/lib/animate.css/animate.css')}}">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />

    <link rel='stylesheet' href='https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.css'>
    <!-- Sweet alert -->
	<script src='https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.min.js'></script>


  	<!-- link css -->
  	<link rel="stylesheet" href="{{ asset('user/public/css/main.css')}}">
	@yield('link')
</head>
<body style="font-family: 'Encode Sans Expanded', sans-serif;">
	<div id="main">
		<!-- Begin header -->
		<div id="header">

			<!-- begin navbar -->
			 @include('users/layouts/includes/header')
			<!-- end navbar -->
		</div>
		<!-- Menu -->
		@include('users/layouts/includes/menu')
		<!-- End header -->

		<!-- Begin Content -->
		<div id="content" class="container-fluid">
			<div class="col-sm-12">
				@yield('content')
			</div>
		</div>
		<!-- End content -->
		<div id="footer" class="col-sm-12">
		   	<p>2018 BKACAD  &copy; Fee Management Software</p>
	  	</div>
	  	
	  	<!-- /#footer -->
  	</div>

	<!-- Script -->
	<!-- Bootstrap -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  	<script src="{{ asset('user/public/lib/bootstrap/js/bootstrap.min.js')}}"></script>
	
	<script src="//cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>
	<!-- Add in any FooTable dependencies we may need
	    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>
	  Add in FooTable itself
	    <script src="{{ asset('user/public/lib/FooTable/compiled/footable.js')}}"></script>
	  Initialize FooTable
	  <script type="text/javascript">
	  	jQuery(function($){
	        $('#data_table').footable({
	          "paging": {
	            "enabled": true
	          }
	        });
	    });
	  </script> -->
	
	<!-- Filee input -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/js/fileinput.min.js"></script>
	<script type="text/javascript">
	  $("#input-id").fileinput({
	    overwriteInitial: true,
	    maxFileSize: 1500,
	    showClose: false,
	    showCaption: false,
	    browseLabel: '',
	    removeLabel: '',
	    browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
	    removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
	    removeTitle: 'Cancel or reset changes',
	    elErrorContainer: '#errors',
	    msgErrorClass: 'alert alert-block alert-danger',
	    defaultPreviewContent: '<img  src="admin/public/assets/img/{{ session()->get('users.image') }}" alt="Your Avatar" width="180px">',
	    layoutTemplates: {main2: '{preview} {remove} {browse}'},
	    allowedFileExtensions: ["jpg", "png", "gif"],

	  });
	</script>
	<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>       
	    <!-- <script>
	    $(document).ready(function() {
	        $('#data_table').DataTable({
	                responsive: true
	        });
	    });
	    	   </script>  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script type="text/javascript">
	    $('.select2').select2();
	</script>
	<script>
		// Initialize tooltip component
		$(function () {
		  $('[data-toggle="tooltip"]').tooltip()
		})

		// Initialize popover component
		$(function () {
		  $('[data-toggle="popover"]').popover()
		})
	</script>
	@yield('script2')
	@yield('script')
</body>
</html>
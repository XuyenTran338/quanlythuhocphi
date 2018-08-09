<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <!--IE Compatibility modes-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--Mobile first-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>@yield('title')</title>
    
    <meta name="description" content="Content">
    <meta name="author" content="">
    
    <meta name="msapplication-TileColor" content="#5bc0de" />
    <meta name="msapplication-TileImage" content="{{ asset('admin/public/assets/img/metis-tile.png')}}" />
    <base href="{{ asset('') }}">
    <link rel='shortcut icon' type='image/x-icon' href="{{ asset('admin/public/assets/img/background2.jpg')}}" />

    <!-- Font-family -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Encode+Sans+Expanded">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('admin/public/assets/lib/bootstrap/css/bootstrap.css')}}">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
    
    <!-- Metis core stylesheet -->
    <link rel="stylesheet" href="{{ asset('admin/public/assets/css/main.css')}}">
    
    <!-- metisMenu stylesheet -->
    <link rel="stylesheet" href="{{ asset('admin/public/assets/lib/metismenu/metisMenu.css')}}">
    
    <!-- onoffcanvas stylesheet -->
    <link rel="stylesheet" href="{{ asset('admin/public/assets/lib/onoffcanvas/onoffcanvas.css')}}">
    
    <!-- animate.css stylesheet -->
    <link rel="stylesheet" href="{{ asset('admin/public/assets/lib/animate.css/animate.css')}}">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/css/dataTables.bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />

   <!--  FooTable Bootstrap CSS
   <link href="{{ asset('admin/FooTable/compiled/footable.bootstrap.min.css')}}" rel="stylesheet"> -->

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/prism/0.0.1/prism.min.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
     <link rel='stylesheet' href='https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.css'>
    <script src='https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.min.js'></script>
    
    @yield('link')

    <script>
        less = {
            env: "development",
            relativeUrls: false,
            rootpath: "/assets/"
        };
    </script>
    <link rel="stylesheet/less" type="text/css" href="{{ asset('admin/public/assets/less/theme.less')}}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/less.js/2.7.1/less.js"></script>
</head>
<style type="text/css">
  
</style>
<body style="font-family: 'Encode Sans Expanded', sans-serif;" class="  menu-affix">

  <div id="wrap" style="background-color: hsl(0, 0%, 92%);">
      <!-- begin top-->
      <div id="top"> 
        <!-- header -->
        @include('admin/layouts/includes/header')
      </div>
      <!-- end top -->

      <!-- begin left-->
      <div id="left">
        <div class="media user-media bg-dark dker">
            <div class="user-media-toggleHover" ">
                <span class="fa fa-user"></span>
            </div>
            <div class="user-wrapper bg-dark" style="background-image: url(admin/public/assets/img/pattern/header-profile-1.png); color: black">
                <a class="user-link" href="{{ route('view_user',session()->get('user.ma_tai_khoan')) }}">
                    <img class="media-object  user-img" alt="User Picture" src="admin/public/assets/img/{{session()->get('user.image')}}" style="border-radius: 100%; border:0px solid" width="80"> 
                    <!-- <span class="label label-danger user-label">16</span> -->
                </a>
        
                <div class="media-body" style=" background-image: url(admin/public/assets/img/pattern/header-profile-1.png); padding-left: 15px">
                    <h5 class="media-heading" style="color: white">Hello &nbsp;{{ session()->get('user.ten_tai_khoan')}}</h5>
                    <ul class="list-unstyled user-info">
                        <li style="color: white;">Level: 
                          @if(session()->get('user.phan_quyen')==1) 
                              Admin
                          @endif
                        </li>
                        <li style="color: white">Last Access :<br>
                            <small>
                              <i class="fas fa-calendar-alt"></i>
                              @if(session()->get('user.lan_truy_cap_cuoi') > 0) 
                                  {{date('d-m-Y', strtotime(session()->get('user.lan_truy_cap_cuoi')))}}
                                  <br>
                                  <?php \Carbon\Carbon::setLocale('vi') ?>
                                  {!! \Carbon\Carbon::createFromTimeStamp(strtotime(session()->get('user.lan_truy_cap_cuoi')))->diffForHumans() !!}
                              @else
                                  d/m/y h:i:s
                              @endif
                            </small>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- begin menu -->
          @include('admin/layouts/includes/menu')
        <!-- end menu -->
      </div>
      <!-- end left -->

      <!-- Begin Content -->
      <div id="content" style="border-top: 1px solid #16a291;" >
          <div class="col-lg-12" style="background-color: hsl(0, 0%, 92%); color: black; padding-top: 20px">
            @yield('content') 
          </div>  
      </div>
      <!-- End content -->
  </div>
  <!-- /#wrap -->
  <footer class="Footer " style="background-color: #16a291; border-color: white; border-top: 0px">
      <p>2018 BKACAD  &copy; Fee Management Software</p>
  </footer>
  <!-- /#footer -->
    <!--jQuery -->
    <script src="{{ asset('admin/public/assets/lib/jquery/jquery.js')}}"></script>

   <!--  Datatable -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/jquery.dataTables.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/dataTables.bootstrap.min.js"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/prism/0.0.1/prism.min.js"></script>

    <!--Bootstrap -->
    <script src="{{ asset('admin/public/assets/lib/bootstrap/js/bootstrap.js')}}"></script>
    <!-- MetisMenu -->
    <script src="{{ asset('admin/public/assets/lib/metismenu/metisMenu.js')}}"></script>
    <!-- onoffcanvas -->
    <script src="{{ asset('admin/public/assets/lib/onoffcanvas/onoffcanvas.js')}}"></script>
    <!-- Screenfull -->
    <script src="{{ asset('admin/public/assets/lib/screenfull/screenfull.js')}}"></script>

    <!-- Metis core scripts -->
    <script src="{{ asset('admin/public/assets/js/core.js')}}"></script>
    <!-- Metis demo scripts -->
    <script src="{{ asset('admin/public/assets/js/app.js')}}"></script>
    
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
      defaultPreviewContent: '<img  src="admin/public/assets/img/{{ session()->get('user.image') }}" alt="Your Avatar" width="180px">',
      layoutTemplates: {main2: '{preview} {remove} {browse}'},
      allowedFileExtensions: ["jpg", "png", "gif"],

    });
  </script>
   <script>
    $(document).ready(function() {
        $('#data_table').DataTable({
          responsive: true,
          "language": {
              "sProcessing":   "Đang xử lý...",
              "sLengthMenu":   "Xem _MENU_ mục",
              "sZeroRecords":  "Không tìm thấy dòng nào phù hợp",
              "sInfo":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
              "sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 mục",
              "sInfoFiltered": "(được lọc từ _MAX_ mục)",
              "sInfoPostFix":  "",
              "sSearch":       "Tìm:",
              "sUrl":          "",
              "oPaginate": {
                  "sFirst":    "Đầu",
                  "sPrevious": "Trước",
                  "sNext":     "Tiếp",
                  "sLast":     "Cuối"
              }
          }
        });
    });
   </script>
      <!-- Latest compiled and minified JavaScript -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
      <script type="text/javascript">
         $('.select2').select2();
      </script>
       @yield('script2')
      
       @yield('script')
       @yield('script3')
      <!-- Sweet alert -->

      <!-- (Optional) Latest compiled and minified JavaScript translation files -->
   
    <!-- Add in any FooTable dependencies we may need -->
  <!--   <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>
  Add in FooTable itself
  <script src="{{ asset('admin/FooTable/compiled/footable.js')}}"></script>
  Initialize FooTable
  <script>
    jQuery(function($){
      $('#data_table').footable({
        "paging": {
          "enabled": true
        },
        "filtering": {
          "enabled": true
        },
        "sorting": {
          "enabled": true
        },
      });
    });
  </script> -->
 
    
</body>

</html>

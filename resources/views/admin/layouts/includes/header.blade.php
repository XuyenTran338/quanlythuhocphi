<style type="text/css" >
	.navbar-inverse .container-fluid .navbar-brand {
	    margin-left: 30px;
	}

	.navbar-inverse .navbar-brand {
	    color: white;
	}

	.navbar-brand {
	    float: left;
	    height: 50px;
	    padding: 15px 15px;
	    font-size: 25px;
	    line-height: 50px
	}

  .topnav i{font-size: 18px}

  .error{
    color: hsl(0, 100%, 40%);
    font-weight: bold;
  }

  .kv-avatar .krajee-default.file-preview-frame,.kv-avatar .krajee-default.file-preview-frame:hover {
      margin: 0;
      padding: 0;
      border: none;
      box-shadow: none;
      text-align: center;
  }
  .kv-avatar {
      display: inline-block;
      text-align: center;
  }
  .kv-avatar .file-input {
      display: table-cell;
      width: 180px;
  }
  .kv-reqd {
      color: red;
      font-family: monospace;
      font-weight: normal;
  }
</style>
<!-- begin navbar -->
<nav class="navbar navbar-inverse navbar-fixed-top" style="background-color: #16a291; border-color:#16a291 ">
<!-- begin container-fluid -->
<div class="container-fluid">
      <a href="{{ route('home') }}" class="navbar-brand"><i class="fas fa-cubes" style="font-size: 35px"></i>&nbsp;Hệ thống quản lý thu học phí</a>
  <!-- begin topnav -->
  <div class="topnav">
      <div class="btn-group">
          <div class="dropdown" data-toggle="tooltip" data-placement="right" title="Tài khoản {{ session()->get('user.ten_tai_khoan') }}">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" >
            <i class="fa fa-user"></i>&nbsp; <span class="caret"></span></button>
            <ul class="dropdown-menu">
              <li><a href="{{ route('view_user',session()->get('user.ma_tai_khoan')) }}"><i class="fas fa-info-circle"></i> &nbsp;Xem thông tin</a></li>
              <li data-toggle="modal" data-target="#myModal">
                  <a><i class="fas fa-cog"></i>&nbsp;Sửa tài khoản</a>
              </li>
              <li><a href="{{ route('getUpdate_pass',session()->get('user.ma_tai_khoan')) }}"><i class="fas fa-key"></i>&nbsp;Đổi Mật khẩu</a></li>
            </ul>
          </div>
      </div>
     <!--  <div class="btn-group">
         <a data-placement="bottom" data-original-title="E-mail" data-toggle="tooltip"
            class="btn btn-default btn-sm">
             <i class="fas fa-envelope"></i>
             <span class="label label-warning">5</span>
         </a>
         <a data-placement="bottom" data-original-title="Messages" href="#" data-toggle="tooltip"
            class="btn btn-default btn-sm">
             <i class="fa fa-comments"></i>
             <span class="label label-danger">4</span>
         </a>
        <a data-toggle="modal" data-original-title="Help" data-placement="bottom"
           class="btn btn-default btn-sm"
           href="#helpModal">
            <i class="fa fa-question"></i>
        </a>
     </div> -->
      <div class="btn-group">
          <a href="{{ route('logout') }}" data-toggle="tooltip" data-original-title="Đăng xuất" data-placement="bottom"
             class="btn btn-metis-1 btn-sm">
              <i class="fas fa-sign-out-alt"></i>
          </a>
      </div>
      <div class="btn-group">
          <a data-placement="bottom" data-original-title="Hiển thị / Ẩn trái" data-toggle="tooltip"
             class="btn btn-primary btn-sm toggle-left" id="menu-toggle">
              <i class="fa fa-bars"></i>
          </a>
         <!--  <a href="#right" data-toggle="onoffcanvas" class="btn btn-default btn-sm" aria-expanded="false">
             <span class="fa fa-fw fa-comment"></span>
         </a> -->
      </div>
      <div class="btn-group">
          <a data-placement="bottom" data-original-title="Fullscreen" data-toggle="tooltip"
             class="btn btn-default btn-sm" id="toggleFullScreen">
              <i class="glyphicon glyphicon-fullscreen"></i>
          </a>
      </div>
      
     

  </div>
  <!-- end topnav -->                  
  <!-- <div class="collapse navbar-collapse navbar-ex1-collapse">
  
      .nav
      <ul class="nav navbar-nav">
          <li><a href="dashboard.html">Dashboard</a></li>
          <li><a href="admins/table">Tables</a></li>
          <li class='dropdown '>
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  Form Elements <b class="caret"></b>
              </a>
              <ul class="dropdown-menu">
                  <li><a href="form-general.html">General</a></li>
                  <li><a href="form-validation.html">Validation</a></li>
                  <li><a href="form-wysiwyg.html">WYSIWYG</a></li>
                  <li><a href="form-wizard.html">Wizard &amp; File Upload</a></li>
              </ul>
          </li>
      </ul>
      /.nav
  </div> -->
</div>
<!-- end container-fluid -->
</nav>
<!-- end navbar -->

  <!-- Begin Model -->
  <div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog" style="width: 500px">
   <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background-color: #16a291; color: white">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title">Thông tin cá nhân :</h4>
      </div>
      <div class="modal-body">
          <form id="form_update" action="{{ route('postUpdate_account',session()->get('user.ma_tai_khoan')) }}"         method="post" onSubmit="return Update()" enctype="multipart/form-data" >
           <input type="hidden" name="_token" value="{{csrf_token()}}">
           <div class="form-group" id="err_form">
                
           </div>
            <div class="form-group">
              <label>Tên tài khoản:</label>
              <input type="text" name="txtTenTK" value="{{ session()->get('user.ten_tai_khoan') }}" class="form-control" id="TenTK">
              <div class="error" id="errTenTK"></div> 
            </div>
            
            <div class="form-group">
              <label>Email:</label>
              <input type="email" name="txtEmail" value="{{ session()->get('user.email') }}" class="form-control" id="Email">
              <div class="error" id="errEmail"></div> 
            </div>
            
            <div class="form-group">
              <label>Họ và tên:</label>
              <input type="text" name="txtTen" value="{{ session()->get('user.ho_ten') }}" class="form-control" id="Name">
              <div class="error" id="errName"></div>
            </div>
           
            <div class="form-group">
              <label>Số điện thoại:</label>
              <input type="text" name="txtSDT" value="{{ session()->get('user.SDT') }}" class="form-control" id="SDT">
              <div class="error" id="errSDT" ></div>
            </div>
            
            <div class="form-group">
              <label>Giới tính</label><br>
              <input type="radio" name="rdSex" value="1" @if(session()->get('user.gioi_tinh')==1) checked @endif>Nam&nbsp;&nbsp;
              <input type="radio" name="rdSex" value="0" @if(session()->get('user.gioi_tinh')==0) checked @endif>Nữ
              <div class="error" id="errGT" ></div>
            </div>
            <div class="form-group" >
              <label>Ảnh đại diện</label>
              <input type="hidden" name="txtAnhCu" value="{{ session()->get('user.image') }}" />
              <div class="kv-avatar" style="margin-left: 45px">
                <input id="input-id" type="file"  name="txtFile" >
              </div>
            </div>
            <div id="errors"></div>
            
      </div>
      <div class="modal-footer" style="background-color:#16a291; color: white">
              <input type="submit" value="Lưu" class="btn btn-primary btn-line btn-lg" id="save">
        </form>
        </div>
       </div>
      </div>
</div>
<!-- End Model-->
<header class="head" style=" border-bottom:  1px solid #16a291;border-top:  1px solid #16a291">
      <!-- begin search-bar -->
    <div class="search-bar" style="background-color: white;border-top:  1px solid #16a291">
          <form class="main-search">
              <div class="input-group">
                  <input type="text" class="form-control" placeholder="Mã, tên sinh viên..." style="color: black" id="search">
                  <span class="input-group-btn">
                      <button class="btn btn-primary" type="submit" id="button_search">
                          <i class="fab fa-sistrix" style="color: black"></i>
                      </button>
                  </span>
              </div>
          </form>
    </div>
      <!-- end search-bar -->

    <div class="main-bar" style="background-color: white; border-left: 1px solid #16a291;border-top:  1px solid #16a291">
   		<h3 style="color: black">@yield('heading')</h3>
   	</div>
  <!-- /.main-bar -->
</header>
<!-- /.head -->

<!-- Modal search -->
<div class="modal fade" id="modal_search" tabindex="-1" role="dialog" aria-labelledby="myModal_search" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog" style="width: 1200px">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModal_search"><i class="fas fa-comment-dots" style="font-size: 25px; color:hsl(24, 100%, 50%) "></i> Kết quả tìm kiếm</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-12" id="result_search">
            
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-line btn-lg" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal search -->
<div class="modal fade" id="modal_hoc_phi" tabindex="-1" role="dialog" aria-labelledby="myModal_hoc_phi" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog" style="width: 1200px">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModal_hoc_phi"><i class="fas fa-donate" style="font-size: 25px; color:hsl(24, 100%, 50%) "></i> Thông tin chi tiết về học phí</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-12" id="result_hoc_phi">
           
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-line btn-lg" data-dismiss="modal">Close</button>

      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
  function Update()
  {
    var validate=true;
    var name = document.getElementById("Name").value;
    var tentk = document.getElementById("TenTK").value;
    var sdt = document.getElementById("SDT").value;
    var sex = Array();
    sex = document.getElementsByName("rdSex");
    var email = document.getElementById("Email").value;
    //
    var errname=document.getElementById("errName");
    var errsdt=document.getElementById("errSDT");
    var errsex=document.getElementById("errGT");
    var erremail=document.getElementById("errEmail");
    var errTenTK=document.getElementById("errTenTK");
  
    //Name
    if(name.length==0){
      errname.innerHTML="*Vui lòng nhập Họ tên!";
      validate=false;
    }else{
      errname.innerHTML="";
    }

    if(tentk.length==0){
      errTenTK.innerHTML="*Vui lòng nhập tên tài khoản!";
      validate=false;
    }else if(tentk.length< 5){
      errTenTK.innerHTML="Tên tài khoản ít nhất 5 ký tự";
      validate=false;
    }else{
      errTenTK.innerHTML="";
    }
    //sdt phone
    if(sdt.length==0)
    {
      errsdt.innerHTML="*Vui lòng nhập số điện thoại!";
      validate=false;
    }else if(sdt.length < 11 || sdt.length > 13)
      {
        errsdt.innerHTML="*Số điện thoại nhập không đúng!";
        validate=false;
      }else{
        errsdt.innerHTML="";
      }
    //gioi tinh
    var demGt=0;
    for(var i=0; i<sex.length; i++){
      if(sex[i].checked){
        demGt++;
      }
    }
    if(demGt==0)
    {
      errsex.innerHTML="*Vui lòng chọn giới tính!";
      validate=false;
    }
    else
    {
      errsex.innerHTML="";  
    }
    //Email
    if(email.length==0)
      {
        erremail.innerHTML="*Vui lòng nhập email!";
        validate=false;
      }else{
      erremail.innerHTML="";
    }

    return validate;
  }
</script>
@section('script2')

<script>
  $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip();   
  });

  $(document).ready(function(){
    $("#save").click(function(e){
      e.preventDefault();
      var form_data = $("#form_update").serialize();
      $.ajax({
        url : '{{ route('check',session()->get('user.ma_tai_khoan')) }}',
        data :form_data,
        type : 'POST',
        dataType: 'json',
        processData: false,
        success: function(data){
          if(data.error.length > 0)
          {
            var error_html = '';
            error_html+='<div class="alert alert-danger">';
            for(var count = 0; count < data.error.length; count++)
            {
                error_html += data.error[count]+'</br>';
            }
            error_html+='</div>';
            $('#err_form').html(error_html);
            return false;
          }else{
            $("#form_update").submit();

          }
        }
      });

    });
    function get_date(day)
    {
      var date=day.getDate();
      if(date < 10)
      {
        date='0'+date;
      }
      var month=(day.getMonth()+1);
      if(month < 10)
      {
        month='0'+month;
      }
      var year=day.getFullYear();
      var html='';
      html=date+'/'+month+'/'+year;
      return html;
    }

    $('#button_search').click(function(e){
      e.preventDefault();
      var search=$('#search').val();
      if(search.length <=1)
      {
        swal("Nhắc nhở!",'Hãy nhập ít nhất 2 ký tự', "warning");
      }else
      {
        $.get('admins/student/ajax_search/'+search,function(data){
          if(data.count == 0)
          {
            swal("Có lỗi!",'Lỗi rồi! Không có kết quả tìm kiếm với từ khóa '+'" '+search+' "', "error");
          }else
          {
            var html='';
              html+='<table id="search_table" class="table table-hover table-bordered" ><thead><tr style="background-color: #16a291; color: white"><th>Mã SV</th><th>Họ và Tên</th><th>Email</th><th>Ngày sinh</th><th>Giới tính</th><th>Số điện thoại</th><th>Học bổng</th><th>Hình thức nộp</th><th>Học phí</th> </tr></thead><tbody>';
              $.each(data.search,function(key,value){
                html+='<tr class="font_search">';
                html+='<td>'+value.ma_sinh_vien+'</td>';
                html+='<td>'+value.ten_sinh_vien+'</td>';
                html+='<td>'+value.email+'</td>';
                html+='<td>'+value.ngay_sinh+'</td>';
                html+='<td>'+value.gioi_tinh+'</td>';
                html+='<td>'+value.sdt+'</td>';
                html+='<td>'+value.ty_le_phan_tram+'</td>';
                html+='<td>'+value.hinh_thuc+'</td>';
                html+='<td class="text-center"><button type="button" class="btn btn-primary view_hoc_phi" value="'+value.ma_sinh_vien+'" >Xem</button></td>';
              });
              html+='</tbody></table>';
              $("#result_search").html(html);
              $("#modal_search").modal('show');
              $('.view_hoc_phi').on('click',function(){
                var ma_sv=$(this).val();
                $.get('admins/receipt/ajax_receipt_sinhvien/'+ma_sv,function(data){
                  $("#modal_search").modal('hide');
                  var gt='';
                  if(data.sinh_vien.gioi_tinh == 0) 
                  {
                    gt='Nữ' 
                  }
                  else {gt='Nam';}
                  var birth=new Date(data.sinh_vien.ngay_sinh);
                  var ngay_sinh='';
                  ngay_sinh=get_date(birth);
                  var tinh_trang='';
                  if(data.dot_thu_max == 30) tinh_trang='<p style="color:blue;font-weight: bold ">Hoàn tất học phí</p>';
                  else tinh_trang='<p style="color:green; font-weight: bold">Chưa hoàn tất học phí</p>';
                  var html='';
                  html+='<div class="col-sm-6"><table class="table table-hover"><caption style="background-color: hsl(33, 100%, 50%); color:white;padding-left: 10px"><i class="fas fa-graduation-cap"></i> &nbsp;Thông tin học viên</caption>';
                  html+='<tr><th>Mã học viên</th><td>'+data.sinh_vien.ma_sinh_vien+'</td></tr><tr><th>Học viên</th><td>'+data.sinh_vien.ten_sinh_vien+'</td></tr><tr><th>Lớp</th><td>'+data.sinh_vien.ten_lop+'</td></tr><tr><th>Khóa học</th><td>'+data.sinh_vien.ten_khoa_hoc+'</td></tr><tr><th>Ngành học</th><td>'+data.sinh_vien.ten_nganh+'</td></tr><tr><th>Ngày sinh</th><td>'+ngay_sinh+'</td></tr><tr> <th>Địa chỉ</th><td>'+data.sinh_vien.dia_chi+'</td></tr><tr><th>Email</th><td>'+data.sinh_vien.email+'</td></tr><tr><th>Giới tính</th><td>'+gt+'</td></tr><tr><th>Số Điện thoại</th><td>'+data.sinh_vien.sdt+'</td></tr><tr><th>Học bổng</th><td>'+data.sinh_vien.ty_le_phan_tram+' %</td></tr>';
                  html+=' </table></div><div class="col-sm-6"><table class="table table-hover"><caption style="background-color: hsl(33, 100%, 50%); color:white;padding-left: 10px"><i class="fas fa-id-card"></i> &nbsp;Thông tin học phí</caption>';
                  html+='<tr><th>Số tiền đã nộp</th><td><b style="color: hsl(0, 100%, 40%); font-weight: bold">'+data.so_tien_da_nop+'</b> VND</td></tr><tr><th>Số tiền còn lại</th><td><b style="color: hsl(0, 100%, 40%); font-weight: bold">'+data.so_tien_con_lai+'</b> VND</td></tr><tr><th>Số tiền nợ phí / Số tháng chưa nộp</th><td><b style="color: hsl(0, 100%, 40%); font-weight: bold">'+data.so_tien_can_nop+'</b> VND/ '+data.so_thang_chua_nop+' tháng</td></tr><tr><th>Hình thức nộp</th><td>'+data.sinh_vien.ten_hinh_thuc+'</td></tr><tr><th>Tình trạng học phí</th><td>'+tinh_trang+'</td></tr></table></div>';

                  $("#result_hoc_phi").html(html);
                  $("#modal_hoc_phi").modal('show');
                  $("#modal_hoc_phi").on("hidden.bs.modal", function () {
                      $("#modal_search").modal('show');
                  });
                });
              });

              $('#search_table').DataTable({
                  destroy: true,
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
          }
        });
      }
    });
      
  });

  

</script>
@endsection

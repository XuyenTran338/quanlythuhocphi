<style type="text/css">
	.btn-line{
		background-color: white;
		color: blue;
		font-weight: bold;
    border: 1px solid #ccc;
	}
	.btn:hover{
		background-color: hsl(195, 100%,30%);
		color: white;
		border: none;
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

	.error{
		color: red;
		font-weight: bold;
	}
</style>
<nav class="navbar navbar-inverse navbar-fixed-top" id="navbar_header_a">
	<div class="col-sm-12">
	    <div class="navbar-header">
	      <a class="navbar-brand" href="{{ route('index') }}"><i class="fas fa-cubes" ></i>&nbsp;Quản lý thu học phí</a>
	    </div>
	    <div class="search-bar">
			<form class="navbar-form navbar-left main-search" id="form_search">
			  <div class="input-group">
			    <input type="text" class="form-control" placeholder="Tên học viên..." id="search">
			    <div class="input-group-btn">
			      <button class="btn btn-tim" type="submit" id="search_submit">
			        <i class="fab fa-sistrix"></i>
			      </button>
			    </div>
			  </div>
			</form>
      <!-- <div style="position: absolute; font-size: 12px; width: 80%; margin-top: 110px; border: 5px solid hsl(0, 0%, 80%); border-radius: 5px; background-color: white; padding:10px 10px 10px 10px">
        <table id="result" class="table table-hover table-bordered" >
          <thead>
            <tr style="background-color: hsl(163, 81%, 90%);">
              <th>Mã SV</th>
              <th>Tên Lớp</th>
              <th>Họ và Tên</th>
              <th>Ngày sinh</th>
              <th>Giới tính</th>
              <th>Số điện thoại</th>
              <th>Số tiền nợ</th> 
            </tr>
          </thead>
        </table>
      </div> -->
      
	    <ul class="nav navbar-nav navbar-right" >
	    	<li  data-toggle="modal" data-target="#myModal">
	    		<a class="user-link" id="link_image">
                    <img class="media-object  user-img" alt="User Picture" src="admin/public/assets/img/{{ session()->get('users.image')}}" width="35">
                    <div class="user-name"> &nbsp; &nbsp;{{ session()->get('users.ten_tai_khoan')}}</div>
                </a>
            </li>
            <li ><a id="name">Họ tên: {{ session()->get('users.ho_ten')}}</a></li>
            <li ><a>Quyền: @if(session()->get('users.phan_quyen')==2) Giáo vụ @endif</a></li>
	      	<li ><a href="{{ route('logout_user') }}"><i class="fas fa-sign-out-alt"></i>Logout</a></li>
	    </ul>
	</div>
</nav>

<!-- Begin Model -->
  <div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog" style="width: 500px">
   <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background-color: hsl(195, 100%, 40%); color: white">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title">Thông tin cá nhân : </h4>
      </div>
      <div class="modal-body">
          <form id="form_update" action="{{ route('update_account',session()->get('users.ma_tai_khoan')) }}" onSubmit="return Update()" enctype="multipart/form-data" method="post">
           <input type="hidden" name="_token" value="{{csrf_token()}}">
           	<div class="form-group" id="err_form">
								
			     </div>
            <div class="form-group">
              <label>Tên tài khoản:</label>
              <input type="text" name="txtTenTK" value="{{ session()->get('users.ten_tai_khoan') }}" class="form-control" id="TenTK" placeholder="Tên tài khoản">
              <div class="error" id="errTenTK"></div> 
            </div>
            
            <div class="form-group">
              <label>Email:</label>
              <input type="email" name="txtEmail" value="{{ session()->get('users.email') }}" class="form-control" id="Email" placeholder="MyEmail@gmail.com">
              <div class="error" id="errEmail"></div> 
            </div>
            
            <div class="form-group">
              <label>Họ và tên:</label>
              <input type="text" name="txtTen" value="{{ session()->get('users.ho_ten') }}" class="form-control" id="Name" placeholder="Họ và tên">
              <div class="error" id="errName"></div>
            </div>
           
            <div class="form-group">
              <label>Số điện thoại:</label>
              <input type="text" name="txtSDT" value="{{ session()->get('users.SDT') }}" class="form-control" id="SDT" placeholder="Số điện thoại">
              <div class="error" id="errSDT" ></div>
            </div>
            
            <div class="form-group">
              <label>Giới tính</label><br>
              <input type="radio" name="rdSex" value="1" @if(session()->get('users.gioi_tinh')==1) checked @endif>Nam&nbsp;&nbsp;
              <input type="radio" name="rdSex" value="0" @if(session()->get('users.gioi_tinh')==0) checked @endif>Nữ
              <div class="error" id="errGT" ></div>
            </div>
            <div class="form-group" >
              <label>Ảnh đại diện</label>
              <input type="hidden" name="txtAnhCu" value="{{ session()->get('users.image') }}" />
              <input type="hidden"  id="import"  />
              <div class="kv-avatar" style="margin-left: 45px">
     		      	<input id="input-id" type="file"  name="txtFile" >
     		      </div>
            </div>
            <div id="errors"></div>
            
      </div>
      <div class="modal-footer" style="background-color:hsl(195, 100%, 40%); color: white">
              <input type="submit" value="Lưu" class="btn btn-primary btn-line btn-lg" id="save">
        </form>
        </div>
       </div>
      </div>
</div>
<!-- End Model-->

<!-- Modal search -->
<div class="modal fade" id="modal_search" tabindex="-1" role="dialog" aria-labelledby="myModal_search" aria-hidden="true">
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
</div>
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
<script type="text/javascript">
   	$(document).ready(function(){
   		$("#save").click(function(e){
        e.preventDefault();
   			var form_data = $("#form_update").serialize();
   			$.ajax({
				url : '{{ route('check_update',session()->get('users.ma_tai_khoan')) }}',
				data :form_data,
				type : 'POST',
				dataType: 'json',
				processData: false,
				success: function(data){
					if(data.error.length > 0)
					{
						var error_html = '';
						error_html+='<div class="alert alert-danger alert-dismissible fade in"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
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
   		
   	});

</script>
<script type="text/javascript">
  $(document).ready(function() {
    $("#search_submit").on('click',function(e){
      e.preventDefault();
      var key_word=$("#search").val();
      if(key_word.length <=1)
      {
        swal("Nhắc nhở!",'Hãy nhập ít nhất 2 ký tự', "warning");
      }else
      {
        $.get("users/receipt/search/"+key_word,function(data){
            if(data.count == 0)
            {
              swal("Có lỗi!",'Lỗi rồi! Không có kết quả tìm kiếm với từ khóa '+'" '+key_word+' "', "error");
            }else{
              var html='';
              html+='<table id="search_table" class="table table-hover table-bordered" ><thead><tr style="background-color: hsl(24, 100%, 50%); color: white"><th>Mã SV</th><th>Tên Lớp</th><th>Họ và Tên</th><th>Email</th><th>Ngày sinh</th><th>Giới tính</th><th>Số điện thoại</th><th>Tổng tiền nợ</th> </tr></thead><tbody>';
              $.each(data.search,function(key,value){
                html+='<tr class="font_search">';
                html+='<td>'+value.ma_sinh_vien+'</td>';
                html+='<td>'+value.ten_lop+'</td>';
                html+='<td>'+value.ten_sinh_vien+'</td>';
                html+='<td>'+value.email+'</td>';
                html+='<td>'+value.ngay_sinh+'</td>';
                html+='<td style="color: hsl(0, 0%, 30%)  ">'+value.gioi_tinh+'</td>';
                html+='<td style="color: hsl(0, 0%, 30%)  ">'+value.sdt+'</td>';
                html+='<td><b style="color: hsl(0, 100%, 40%); font-weight:bold">'+value.so_tien_can_nop+'</b> VND / '+value.so_thang+' tháng</td>';
              });
              html+='</tbody></table>';
              $("#result_search").html(html);
              $(".font_search").css('color','hsl(0, 0%, 30%)');
              $("#modal_search").modal('show');
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

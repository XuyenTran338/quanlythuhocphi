@extends('users.layouts.master')
@section('title','Báo cáo thu phí')

@section('content')
<style type="text/css">
	.content_thuphi{
		width: 100%;
		border: 1px solid #4a7da3;
		background-color: hsl(0, 0%, 95%)	;
		border-radius: 3px;
		color: black;
		margin: auto;
		padding-top:10px;
		font-size: 13px;
	}

	.control-label{
		text-align: right;
		position: inherit;
		top: 5px;
	}
	.input_thu{
		position: inherit;
		right: 20px;
	}
	
	#content_body{
		width: 800px;
		overflow-y: auto;
		max-height: 800px;
		background-color: white;
		margin:auto;
		font-family: initial;
		font-size: 14px;
		border:1px solid #4a7da3;
		margin-bottom: 10px;
	}
</style>
<header class="header_main">
	<i class="fas fa-file"></i>&nbsp;&nbsp;Báo cáo thu phí theo lớp
</header>
<div class="content_thuphi">
	<div class="row" style="padding-left: 13px;">
		<div class="col-sm-12" id="header_thuphi">
			<label class="control-label col-sm-1">Ngành học</label>
			<div class="col-sm-2 input_thu">
				<select class="form-control select2"  id="id_nganh">
					@foreach($nganh as $obj)
						<option value="{{ $obj->ma_nganh }}">
							{{ $obj->ten_nganh }}
						</option>
					@endforeach
				</select>
			</div>
			<label class="control-label col-sm-1">Khóa học</label>
			<div class="col-sm-2 input_thu">
				<select class="form-control select2" id="id_khoa">
					
				</select>
			</div>
			<label class="control-label col-sm-1">Lớp học</label>
			<div class="col-sm-2 input_thu">
				<select class="form-control select2" id="id_lop">
					
				</select>
			</div>
			<div class="col-sm-3">
				<button id="view" class="btn btn-primary btn-color" data-toggle="tooltip" data-placement="top" title="View">Xem</button>
				<button id="print" class="btn btn-info btn-color" data-toggle="tooltip" data-placement="top" title="Print"><span class="glyphicon glyphicon-print" ></span> &nbsp;In</button>
				<div class="btn-group">
		        	<div class="dropdown" data-toggle="tooltip" data-placement="right" title="Xuất file">
			            <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">
			            <i class="fas fa-save"></i> &nbsp;Lưu &nbsp;<span class="caret"></span></button>
			            <ul class="dropdown-menu">
			              <li><a id="excel"><i class="far fa-file-excel" style="font-size: 20px"></i>&nbsp;&nbsp; File Excel</a></li>
			              <li><a id="word"><i class="far fa-file-word" style="font-size: 20px"></i>&nbsp;&nbsp; File Word</a></li>
			             <!--  <li><a id="pdf"><i class="far fa-file-pdf" style="font-size: 20px"></i>&nbsp;&nbsp; File PDF</a></li> -->
			            </ul>
		          	</div>
		      </div>
			</div>
			<div class="col-sm-12"><br></div>
			<label class="control-label col-sm-1">Từ ngày</label>
			<div class="col-sm-2 input_thu">
				<input type="date" id="start_date" class="form-control">
			</div>
			
			<label class="control-label col-sm-1">Đến ngày</label>
			<div class="col-sm-2 input_thu">
				<input type="date" id="end_date" class="form-control">
			</div>
		</div>
	</div>
	<br>
	<div class="row">
		
	</div>
	<br>
	<div class="row" id="content_body">
		<div class="container-fluid" id="content_print">
			<div class="col-sm-12" style="padding-top: 10px;">
				<table>
					<tr>
						<td width="45%">
							<p align="center">
								<img src="{{ asset('user/public/img/bkacad.png')}}" alt="logo" width="150px"><br>
								<p style="font-size: 12px" align="center"><b style="color: hsl(3, 89%, 47%)">TRƯỜNG ĐẠI HỌC BÁCH KHOA HÀ NỘI</b><br><b style="color: hsl(176, 96%, 34%)">HỌC VIỆN CÔNG NGHỆ THÔNG TIN BÁCH KHOA</b></p>
							</p>
						</td>
						<td width="2%"></td>
						<td>
							<p align="center"><b>CÔNG TY CỔ PHẨN ĐÀO TẠO, TRIỂN KHAI DỊCH VỤ CÔNG NGHỆ THÔNG TIN VÀ VIỄN THÔNG BÁCH KHOA HÀ NỘI</b><br>
								Tầng 5, nhà A17, số 17 Tạ Quang Bửu, Phường Bách Khoa, Quận Hai Bà Trưng, Hà Nội, Việt Nam</p>
						</td>
					</tr>
				</table>
				<p>Ngày lập: <b id="date"></b></p>
			</div>
			<div class="col-sm-12" style="text-align: center">
				<P>
					<b style="font-size: 20px;">BÁO CÁO THU PHÍ LỚP <b style="color: hsl(176, 96%, 34%)" id="name_lop">_______</b></b><br>
					Ngành: <b id="name_nganh">_______</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Khóa học: <b id="name_khoa">_______</b><br>
					(Từ ngày : <b id="start">__/__/____</b> &nbsp;&nbsp;------&nbsp;&nbsp;
				    Đến ngày: <b id="end">__/__/____</b>)
				</P>
			</div>
			<div class="col-sm-12" id="content_phi_lop">
				<table class="table table-hover table-striped table-bordered table-condensed table-responsive table_export" border="1" cellpadding="5" cellspacing="0" width="100%">
					<thead>
						<tr style="background-color: hsl(163, 81%, 90%); font-size: 14px">
			                <th>Họ tên</th>
			                <th>Ngày đóng</th>
			                <th>Hình thức nộp</th>
			                <th>Học bổng</th>
			                <th>Số tiền đã nộp</th>
			                <th>Nôi dung thu phí</th>
						</tr>
					</thead>
					<tbody>
			            <tr style="height: 30px;">
			            	<td></td><td></td><td></td><td></td><td></td><td></td>
			            </tr> 
			            <tr style="height: 30px">
			            	<td></td><td></td><td></td><td></td><td></td><td></td>
			            </tr>
			        </tbody>
				</table>
			</div>
			<div class="col-sm-12" id="footer_print">
    			<style type="text/css">
    				#ky_ten tr td{
						text-align: center;
    				}
    				#ky_ten #content_ky td{
    					height: 30px;
    				}
					#footer_print{
						padding-top: 20px;
					}
    			</style>
    			<table cellspacing="0" cellpadding="0" style="width: 100%" id="ky_ten">
    				<tr>
    					<td colspan="2"></td>
    					<td><i>Ngày....tháng....năm.......</i></td>
    				</tr>
    				<tr>
    					<td><b>Giám đốc</b><br><i>(Ký,họ tên,đóng dấu)</i></td>
    					<td><b>Kế toán trưởng</b><br><i>(Ký,họ tên)</i></td>
    					<td><b>Người lập phiếu</b><br><i>(Ký,họ tên)</i></td>
    				</tr>
    				<tr id="content_ky">
    					<td></td><td></td><td></td><td></td><td></td>
    				</tr>
    				<tr>
    					<td colspan="2"></td>
    					<td><b>{{session()->get('users.ho_ten')}}</b></td>
    				</tr>
    			</table>
    		</div>
		</div>
	</div>
</div>
@endsection

@section('script')
<script type="text/javascript">
	$(document).ready(function(){
		var ma_nganh=$("#id_nganh").val();
		$.get("users/student/ajax_khoa/"+ma_nganh,function(data){
			var html='';
			$.each(data,function(key,value){
	            var start= new Date(value.ngay_bat_dau);
	            var end= new Date(value.ngay_ket_thuc);
	            start=start.getFullYear();
	            end=end.getFullYear();
	            html+='<option value='+value.khoa_hoc_ma+'>'+ value.ten_khoa_hoc+'-'+value.khoa_hoc_ma+'</option>';
	        });
			$("#id_khoa").html(html);
			var ma_khoa = $("#id_khoa").val();
			$.get("users/student/ajax_lop/"+ma_nganh+"/"+ma_khoa,function(data){
				var html='';
	            $.each(data,function(key,value){
	                html+='<option value='+value.ma_lop+'>'+ value.ten_lop +'</option>';
	            });
	            $('#id_lop').html(html); 	
			});
		});

		$("#id_nganh").change(function(){
			var ma_nganh = $(this).val();
			$.get("users/student/ajax_khoa/"+ma_nganh,function(data){
				var html='';
				$.each(data,function(key,value){
		            var start= new Date(value.ngay_bat_dau);
		            var end= new Date(value.ngay_ket_thuc);
		            start=start.getFullYear();
		            end=end.getFullYear();
		            html+='<option value='+value.khoa_hoc_ma+'>'+ value.ten_khoa_hoc+'-'+value.khoa_hoc_ma+'</option>';
		        });
				$("#id_khoa").html(html);

				var ma_khoa = $("#id_khoa").val();
				$.get("users/student/ajax_lop/"+ma_nganh+"/"+ma_khoa,function(data){
					var html='';
	                $.each(data,function(key,value){
	                    html+='<option value='+value.ma_lop+'>'+ value.ten_lop +'</option>';
	                });
	                $('#id_lop').html(html); 
				});

			});
		
		});

		$("#id_khoa").change(function(){
			var ma_khoa = $(this).val();
			var ma_nganh=$("#id_nganh").val();
			$.get("users/student/ajax_lop/"+ma_nganh+"/"+ma_khoa,function(data){
				var html='';
	            $.each(data,function(key,value){
	                html+='<option value='+value.ma_lop+'>'+ value.ten_lop +'</option>';
	            });
	            $('#id_lop').html(html);
			});
			
		});
		//---------------Date------------------------
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

		//----------------------------------
		var day= new Date();
		var html=get_date(day);
		$("#date").html(html);
		//-----------------------------------
		document.querySelector("#start_date").valueAsDate= new Date();
		document.querySelector("#end_date").valueAsDate= new Date();
		var start=document.getElementById("start_date").value;
		var start_date=new Date(start);
		var html=get_date(start_date);
		$("#start").html(html);
		var end=document.getElementById("end_date").value;
		var end_date=new Date(end);
		var html=get_date(end_date);
		$("#end").html(html);
		//-----------------------------------
		$("#start_date").change(function(){
			var start=$(this).val();
			var start_date=new Date(start);
			var html1=get_date(start_date);
			var end=document.getElementById("end_date").value;
			var end_date=new Date(end);
			var html2=get_date(end_date);
			
			if(html1 <= html2)
			{	
				$("#start").html(html1);
			}else
			{
				swal("Nhắc nhở!",'Hãy chọn ngày nhỏ hoặc bằng ngày kết thúc', "warning");
				document.querySelector("#start_date").valueAsDate= new Date();
			}
			
		});
		//--------------------------------------
		$("#end_date").change(function(){
			var end=$(this).val();
			var end_date=new Date(end);
			var html1=get_date(end_date);
			var start=document.getElementById("start_date").value;
			var start_date=new Date(start);
			var html2=get_date(start_date);
			
			if(html1 >= html2)
			{	
				$("#end").html(html1);
			}else
			{
				swal("Nhắc nhở!",'Hãy chọn ngày lớn hoặc bằng ngày bắt đầu', "warning");
				document.querySelector("#end_date").valueAsDate= new Date();
			}
			
		});

		//========================================
		$("#view").on('click',function(e){
			var day=new Date();
			var month=(day.getMonth()+1);
			// if(month > 5 && month < 8)
			// {
			// 	swal("Nhắc nhở!",'Đây không phải là thời điểm báo cáo thu phí', "warning");
			// }else{
				var ma_lop=$("#id_lop").val();
				var start=document.getElementById("start_date").value;
				/*var start_date=new Date(start);
				var month_start=(start_date.getMonth()+1);
				var year_start=start_date.getFullYear();*/
				var end=document.getElementById("end_date").value;
				/*var end_date=new Date(end);
				var month_end=(end_date.getMonth()+1);
				var year_end=end_date.getFullYear();*/
				$.get("users/statistical/bao_cao_theo_lop/"+ma_lop+"/"+start+"/"+end,function(data){
					if(data.count > 0)
					{
						var html='';
						html+='<table id="ajax_result" class="table table-hover table-striped table-bordered table-condensed table-responsive table_export" border="1" cellpadding="5" cellspacing="0" width="100%"><thead><tr style="background-color: hsl(163, 81%, 90%); font-size: 14px"><th>Họ tên</th><th>Ngày đóng</th><th>Hình thức nộp</th><th>Học bổng</th><th>Số tiền đã nộp</th><th>Nôi dung thu phí</th></tr></thead><tbody>';
						$.each(data.thong_ke,function(key,value){
							html+='<tr style="font-size:13px;">';
							html+='<td>'+value.ten_sinh_vien+'</td>';
							html+='<td>'+value.thoi_gian_thu+'<br></td>';
							html+='<td>'+value.ten_hinh_thuc+'</td>';
							html+='<td>'+'<b style="color: hsl(0, 100%, 40%);">'+value.hoc_bong+'</b> VND</td>';
							html+='<td>'+'<b style="color: hsl(0, 100%, 40%);">'+value.so_tien_thu+'</b> VND</td>';
							html+='<td>'+value.noi_dung+'</td>';
							html+='</tr>';
						});
						html+='</tbody></table>';
						$("#name_lop").html(data.thong_ke[0].ten_lop);
						$("#name_nganh").html(data.thong_ke[0].ten_nganh);
						$("#name_khoa").html(data.thong_ke[0].ten_khoa_hoc+'-'+data.thong_ke[0].khoa_hoc_ma);
						$("#content_phi_lop").html(html);
						$('#ajax_result').DataTable({
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
					}else
					{
						swal("Nhắc nhở!",'Chưa có học viên nộp trong khoảng thời gian này', "warning");
					}
				});
			// }

			});

		
	});
</script>
<script type="text/javascript" src="{{ asset('user/public/js/word_export.js') }}"></script>
<script type="text/javascript">
	function printData()
	{
	   var data_print=document.getElementById("content_print");
	   newWin= window.open("");
	   newWin.document.write(data_print.outerHTML);
	   newWin.print();
	   newWin.close();
	}

	$('#print').on('click',function(){
		var table=$('#ajax_result').DataTable();
		table.destroy();
		printData();
		$('#ajax_result').DataTable({
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
	});

	$('#word').on('click',function(){
		var table=$('#ajax_result').DataTable();
		table.destroy();
		Export_Doc('content_print');
		$('#ajax_result').DataTable({
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
	});

	$(document).ready(function(){
		$('#excel').click(function(){
			$("#content_phi_lop").table2excel({
				exclude: ".noExl",
				name: "Excel Document Name",
				filename: "Danh sach thu phi" + new Date().toISOString().replace(/[\-\:\.]/g, ""),
				fileext: ".xls",
				exclude_img: true,
				exclude_links: true,
				exclude_inputs: true
			});
		});
	});
</script>
@endsection
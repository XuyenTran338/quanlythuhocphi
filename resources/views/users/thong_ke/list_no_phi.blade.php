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
		overflow-y: auto;
	}
</style>
<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<header class="header_main">
	<i class="fas fa-file"></i>&nbsp;&nbsp;Danh sách sinh viện nợ học phí
</header>
<div class="content_thuphi">
	<div class="row" style="padding-left: 13px;">
		<div class="col-sm-12" id="header_thuphi">
			<label class="control-label col-sm-1">Ngành học</label>
			<div class="col-sm-2 input_thu">
				<select class="form-control select2" id="id_nganh">
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
			<form id="form_submit">
			<div class="col-sm-3">
				<button type="submit" id="view" class="btn btn-primary btn-color" data-toggle="tooltip" data-placement="top" title="View">Xem</button>
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
			<div class="col-sm-2 input_thu" id="chon_ngay">
				<?php $today= new \Carbon\Carbon;
					$time=date('d-m-Y',strtotime($today)); ?>
				<input type="date" id="start_date" class="form-control" value="{{ $time }}">
			</div>
			</form>
			<label class="control-label col-sm-1">Đến ngày</label>
			<div class="col-sm-2 input_thu" >
				<?php $today= new \Carbon\Carbon;
					$time2=date('d-m-Y', strtotime($today)) ?>
				<input type="date" id="today" class="form-control" disabled="" value="{{ $time2 }}">
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
				<p>Ngày lập: <b id="day"></b></p>
			</div>
			<div class="col-sm-12" style="text-align: center">
				<P>
					<b style="font-size: 20px;">DANH SÁCH SINH VIÊN NỢ HỌC PHÍ LỚP <b style="color: hsl(176, 96%, 34%)" id="name_lop">____</b></b><br>
					Ngành: <b id="name_nganh" >____</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Khóa học: <b id="name_khoa">____</b><br>
					(Từ : <b id="start">__/__/____</b> &nbsp;&nbsp;------&nbsp;&nbsp;
				    Đến : <b id="end">__/__/____</b>)
				</P>
			</div>
			<div class="col-sm-12">
				<table class="table table-hover table-striped table-bordered table-condensed table-responsive table_export" border="1" cellpadding="5" cellspacing="0" width="100%" id="content_table">
					<thead>
						<tr style="background-color: hsl(163, 81%, 90%);">
			                <th>Họ tên</th>
			                <th>Ngày sinh</th>
			                <th>Giới tính</th>
			                <th>Email</th>
			                <th>Số điện thoại</th>
			                <th>Số tiền nợ</th>
						</tr>
					</thead>
					<tbody id="content_no_phi">
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
    					<td><b>Phạm Công Thăng</b></td>
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

		function check_date()
		{
			document.querySelector("#start_date").valueAsDate= new Date();
			var start=document.getElementById("start_date").value;
			var start_date=new Date(start);
			var html=get_date(start_date);
			$("#start").html(html);
			//-----------------------------------
			$("#start_date").change(function(){
				var start=document.getElementById("start_date").value;
				var start_date=new Date(start);
				var html1=get_date(start_date);
				var day= new Date();
				var html2=get_date(day);
				if(html1 <= html2)
				{	
					$("#start").html(html1);
				}else
				{
					swal("Nhắc nhở!",'Hãy chọn ngày nhỏ hoặc bằng ngày hiện tại', "warning");
					document.querySelector("#start_date").valueAsDate= new Date();
				}
				
			});
		}

		//----------------------------------
		document.querySelector("#today").valueAsDate= new Date();
		var day= new Date();
		var html=get_date(day);
		$("#day").html(html);
		$("#end").html(html);
		//----------------------------------

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
	            var date='';
	            date+='<input type="date" id="start_date" min="'+ data[0].ngay_bat_dau +'" max="'+ data[0].ngay_ket_thuc +'" class="form-control" required>';
	            $("#chon_ngay").html(date);
				check_date();		
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
	                var date='';
		            date+='<input type="date" id="start_date" min="'+ data[0].ngay_bat_dau +'" max="'+ data[0].ngay_ket_thuc +'" class="form-control" required>';
		            $("#chon_ngay").html(date);
					check_date();
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

	            var date='';
	            date+='<input type="date" id="start_date" min="'+ data[0].ngay_bat_dau +'" max="'+ data[0].ngay_ket_thuc +'" class="form-control" >';
	            $("#chon_ngay").html(date);
				check_date();	
			});
			
		});
		//---------------Date------------------------
		
		//========================================
		$("#form_submit").on('submit',function(e){
			e.preventDefault();
			var day=new Date();
			var month=(day.getMonth()+1);
			if(month > 5 && month < 8)
			{
				swal("Nhắc nhở!",'Đây không phải là thời điểm báo cáo thu phí', "warning");
			}else{
				var ma_lop=$("#id_lop").val();
				var start=document.getElementById("start_date").value;
				$.get("users/statistical/chua_nop/"+ma_lop+"/"+start,function(data){
					var html='';
					$.each(data,function(key,value){
						html+='<tr>';
						html+='<td>'+value.ten_sinh_vien+'</td>';
						html+='<td>'+value.ngay_sinh+'</td>';
						html+='<td>'+value.gioi_tinh+'</td>';
						html+='<td>'+value.email+'</td>';
						html+='<td>'+value.sdt+'</td>';
						html+='<td>'+'<b style="color: hsl(0, 100%, 40%);">'+value.so_tien_can_nop+'</b> VND</td>';
						html+='</tr>';
						$("#name_lop").html(value.ten_lop);
						$("#name_nganh").html(value.ten_nganh);
						$("#name_khoa").html(value.ten_khoa_hoc+'-'+value.khoa_hoc_ma);
					});
					
					$("#content_no_phi").html(html);
				});
			}

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
		var day=new Date();
		var month=(day.getMonth()+1);
		if(month > 5 && month < 8)
		{
			swal("Nhắc nhở!",'Đây không phải là thời điểm báo cáo thu phí', "warning");
		}else{
			printData();
		}
	});

	$('#word').on('click',function(){
		Export_Doc('content_print');
	});

	$(document).ready(function(){
		$('#excel').click(function(){
			$("#content_table").table2excel({
				exclude: ".noExl",
				name: "Excel Document Name",
				filename: "Danh sach no phi" + new Date().toISOString().replace(/[\-\:\.]/g, ""),
				fileext: ".xls",
				exclude_img: true,
				exclude_links: true,
				exclude_inputs: true
			});
		});
	});
</script>
@endsection
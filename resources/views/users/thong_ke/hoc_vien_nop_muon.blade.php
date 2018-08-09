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
<header class="header_main">
	<i class="fas fa-file"></i>&nbsp;&nbsp;Danh sách sinh viên nộp muộn
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
			<div class="col-sm-3">
				<button id="view" class="btn btn-primary btn-color" data-toggle="tooltip" data-placement="top" title="View">Xem</button>
				<button id="print" class="btn btn-info btn-color" data-toggle="tooltip" data-placement="top" title="Print"><span class="glyphicon glyphicon-print" ></span> &nbsp;In</button>
				<!-- <button class="btn btn-success" id="save" data-toggle="tooltip" data-placement="top" title="Save file"><i class="fas fa-save"></i> &nbsp;Lưu</button> -->
			</div>
			<div class="col-sm-12"><br></div>
			<div class="col-sm-2">
				<label class="label-control col-sm-12">Chọn Tháng</label>
				<div class="col-sm-12" id="chon_ngay">
					<select class="form-control select2" id="month">
						<option value="0">--Chọn tháng--</option>
						<option value="8">8</option>
						<option value="9">9</option>
						<option value="10">10</option>
						<option value="11">11</option>
						<option value="12">12</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
					</select>
				</div>
			</div>
			<div class="col-sm-2">
				<label class="label-control col-sm-12">Chọn năm</label>
				<div class="col-sm-12" >
					<select class="form-control select2" id="year">
						
					</select>
				</div>
			</div>
		</div>
	</div>
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
					<b style="font-size: 20px;">DANH SÁCH SINH VIÊN LỚP <b style="color: hsl(176, 96%, 34%)" id="name_lop">____</b> NỘP HỌC PHÍ MUỘN THÁNG <b id="date">__/____</b></b><br>
					Ngành: <b id="name_nganh">____</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Khóa: <b id="name_khoa">____</b><br>
					<!-- (Từ ngày : <b>01/04/2018</b> &nbsp;&nbsp;------&nbsp;&nbsp;
									    Đến ngày: <b>30/04/2018</b>) -->
				</P>
			</div>
			<div class="col-sm-12">
				<table class="table table-hover table-striped table-bordered table-condensed table-responsive table_export" border="1" cellpadding="5" cellspacing="0" width="100%">
					<thead>
						<tr style="background-color: hsl(163, 81%, 90%);">
			                <th>Họ tên</th>
			                <th>Ngày sinh</th>
			                <th>Giới tính</th>
			                <th>Email</th>
			                <th>Số điện thoại</th>
			                <th>Thời gian nộp</th>
						</tr>
					</thead>
					<tbody id="content_nop_muon">
			            <tr style="height: 20px"><td></td><td></td><td></td><td></td><td></td><td></td></tr>
			            <tr style="height: 20px"><td></td><td></td><td></td><td></td><td></td><td></td></tr>
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
    					<td><b>{{ session()->get('users.ho_ten') }}</b></td>
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
	            var start=new Date(data[0].ngay_bat_dau);
	            var end=new Date(data[0].ngay_ket_thuc);
	           	var html='';
	           	html+='<option value="0">---Chọn năm---</option>';
	            for(var i=start.getFullYear(); i<= end.getFullYear(); i++)
	            {
	            	html+='<option value='+ i +'>'+i+'</option>';
	            }
	            $("#year").html(html);
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

	                var start=new Date(data[0].ngay_bat_dau);
		            var end=new Date(data[0].ngay_ket_thuc);
		           	var html='';
		           	html+='<option value="0">---Chọn năm---</option>';
		            for(var i=start.getFullYear(); i<= end.getFullYear(); i++)
		            {
		            	html+='<option value='+ i +'>'+i+'</option>';
		            }
		            $("#year").html(html);
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

	            var start=new Date(data[0].ngay_bat_dau);
	            var end=new Date(data[0].ngay_ket_thuc);
	           	var html='';
	           	html+='<option value="0">---Chọn năm---</option>';
	            for(var i=start.getFullYear(); i<= end.getFullYear(); i++)
	            {
	            	html+='<option value='+ i +'>'+i+'</option>';
	            }
	            $("#year").html(html);	
			});
			
		});
		//---------------------------------------
		var day= new Date();
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
		$("#day").html(html);

		$("#month").change(function(){
			var month=$(this).val();
			var year=$("#year").val();

			if(month < 10)
			{
				month='0'+month;
			}
			var html='';
			html+=month+'/'+year;
			$("#date").html(html);
		});

		$("#year").change(function(){
			var year=$(this).val();
			var month=$("#month").val();

			if(month < 10)
			{
				month='0'+month;
			}
			var html='';
			html+=month+'/'+year;
			$("#date").html(html);
		});
		//========================================
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
		//----------------------------------------------
		$("#view").on('click',function(){
			var ma_lop=$("#id_lop").val();
			var month=$("#month").val();
			var year=$("#year").val();
			if(month == 0 || year == 0)
			{
				swal("Nhắc nhở!",'Chưa chọn tháng hoặc chọn năm!', "warning");
			}else
			{
				$.get("users/statistical/nop_muon/"+ma_lop+"/"+month+"/"+year,function(data){
					var html='';
					var gt='';
					if(data.count > 0)
					{
						$.each(data.sinh_vien,function(key,value){
							if(value.gioi_tinh == 1)
								gt='Nam';
							else gt='Nữ';

							var ngay_sinh=new Date(value.ngay_sinh);
							ngay_sinh=get_date(ngay_sinh);
							var thoi_gian_thu=new Date(value.thoi_gian_thu);
							thoi_gian_thu=get_date(thoi_gian_thu);
							html+='<tr>';
							html+='<td>'+value.ten_sinh_vien+'</td>';
							html+='<td>'+ngay_sinh+'</td>';
							html+='<td>'+gt+'</td>';
							html+='<td>'+value.email+'</td>';
							html+='<td>'+value.sdt+'</td>';
							html+='<td>'+thoi_gian_thu+'</td>';
							html+='</tr>';
							$("#name_lop").html(value.ten_lop);
							$("#name_nganh").html(value.ten_nganh);
							$("#name_khoa").html(value.ma_khoa_hoc);
						});
						
						$("#content_nop_muon").html(html);
					}else{
						swal("Nhắc nhở!",'Không có sinh viên nộp muộn trong tháng '+month+'/'+year, "warning");
						var html='<tr style="height: 20px"><td></td><td></td><td></td><td></td><td></td><td></td></tr><tr style="height: 20px"><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
						$("#content_nop_muon").html(html);
						$("#name_lop").html('____');
						$("#name_nganh").html('____');
						$("#name_khoa").html('____');
						$("#date").html('__/____');
					}
				});
			}
			
		});
	});
</script>
<script type="text/javascript">
	$(document).ready(function(){
		function printData()
		{
		   var data_print=document.getElementById("content_print");
		   newWin= window.open("");
		   newWin.document.write(data_print.outerHTML);
		   newWin.print();
		   newWin.close();
		}

		$('#print').on('click',function(){
			var ma_lop=$("#id_lop").val();
			var month=$("#month").val();
			var year=$("#year").val();
			$.get("users/statistical/nop_muon/"+ma_lop+"/"+month+"/"+year,function(data){
				if(data.count == 0)
				{
					swal("Nhắc nhở!",'Không có sinh viên nộp muộn trong tháng '+month+'/'+year, "warning");
				}else
				{
					printData();
				}
			});
		});
	});
</script>
@endsection
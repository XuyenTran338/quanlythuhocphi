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
	<i class="fas fa-file"></i>&nbsp;&nbsp;Báo cáo thu phí theo chuyên ngành
</header>
<div class="content_thuphi">
	<div class="row" style="padding-left: 13px;">
		<div class="col-sm-12" id="header_thuphi">
			<label class="control-label col-sm-1">Ngành học</label>
			<div class="col-sm-2 input_thu">
				<select class="select_form form-control select2"  title="---Chọn ngành học---" data-live-search = "true" id="nganh">
					@foreach($nganh as $obj)
						<option value="{{ $obj->ma_nganh }}">
							{{ $obj->ten_nganh }}
						</option>
					@endforeach
				</select>
			</div>
			<label class="control-label col-sm-1">Khóa học</label>
			<div class="col-sm-2 input_thu">
				<select class="form-control select2" id="khoahoc">
					
				</select>
			</div>
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
		<div class="container">
			<button id="xem" class="btn btn-primary btn-color" data-toggle="tooltip" data-placement="top" title="View">Xem</button>
			<button id="print" class="btn btn-info btn-color" data-toggle="tooltip" data-placement="top" title="Print"><span class="glyphicon glyphicon-print" ></span> &nbsp;In</button>
			<button class="btn btn-success" id="save" data-toggle="tooltip" data-placement="top" title="Save file"><i class="fas fa-save"></i> &nbsp;Lưu</a>
		</div>
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
				<p>Ngày : 01/05/2018</p>
			</div>
			<div class="col-sm-12" style="text-align: center">
				<P>
					<b style="font-size: 20px;">BÁO CÁO THU PHÍ CÁC LỚP <b style="color: hsl(176, 96%, 34%)">LẬP TRÌNH VIÊN</b></b><br>
					Khóa học: <b> Khóa 5-K5</b><br>
					(Từ ngày : <b>01/04/2018</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				    Đến ngày: <b>30/04/2018</b>)
				</P>
			</div>
			<div class="col-sm-12">
				<table class="table table-hover table-striped table-bordered table-condensed table-responsive table_export" border="1" cellpadding="5" cellspacing="0" width="100%">
					<thead>
						<tr style="background-color: hsl(163, 81%, 90%);">
							<th width="15%">Lớp</th>
			                <th>Sĩ số</th>
			                <th>Số lượng đóng</th>
			                <th>Tiền học bổng</th>
			                <th>Số tiền đã thu</th>
						</tr>
					</thead>
					<tbody id="content_phi_nganh">
			            <tr style="height: 20px;">
			            	<td></td><td></td><td></td><td></td><td></td>
			            </tr>
			            <tr style="height: 20px;">
			            	<td></td><td></td><td></td><td></td><td></td>
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
	function printData()
	{
	   var data_print=document.getElementById("content_print");
	   newWin= window.open("");
	   newWin.document.write(data_print.outerHTML);
	   newWin.print();
	   newWin.close();
	}

	$('#print').on('click',function(){
		printData();
	});

</script>
<script type="text/javascript">
	
</script>
@endsection
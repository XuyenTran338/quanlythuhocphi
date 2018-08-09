@extends('admin/layouts.master')
@section('title','Chi tiết phiếu thu')
@section('heading') 
    <i class="fas fa-id-card" style="color:#16a291; font-size: 30px"></i>&nbsp;Phiếu thu
@endsection  	
@section('content')

@if(session('messages'))
    <div class="alert alert-success alert-dismissible fade in">
        {{session('messages')}}
    </div>
@endif
<style type="text/css">
	.box{
		background-color: white;
	}

</style>
<div class="row box">
	<div class="col-sm-12" id="header">
		<br>
		<h4><i class="fas fa-info-circle"></i> &nbsp;Thông tin chi tiết phiếu thu
			<hr>
		</h4>

	</div>
    <div class="col-sm-12">
    	<div class="col-sm-6">
		   	<table class="table table-hover">
		   		<caption style="background-color: hsl(33, 100%, 50%); color:white;padding-left: 10px"><i class="fas fa-graduation-cap"></i> &nbsp;Thông tin học viên</caption>
		   		<tr>
	                <th>Mã học viên</th>
	                <td>{{ $obj->sinh_vien_ma }}</td>
	            </tr>
	            <tr>
	                <th>Học viên</th>
	                <td>{{ $obj->ten_sinh_vien }}</td>
	            </tr>
	            <tr>
	                <th>Lớp</th>
	                <td>{{ $obj->ten_lop }}</td>
	            </tr>
	            <tr>
	                <th>Khóa học</th>
	                <td>{{ $obj->ten_khoa_hoc }}</td>
	            </tr>
	            <tr>
	                <th>Ngành học</th>
	                <td>{{ $obj->ten_nganh }}</td>
	            </tr>
	            <tr>
	                <th>Ngày sinh</th>
	                <td>{{ date('d-m-Y', strtotime($obj->ngay_sinh)) }}</td>
	            </tr>
	            <tr>
	                <th>Địa chỉ</th>
	                <td>{{ $obj->dia_chi }}</td>
	            </tr>
	            <tr>
	                <th>Email</th>
	                <td>{{ $obj->email }}</td>
	            </tr>
	            <tr>
	                <th>Giới tính</th>
	                <td>
	                    @if($obj->gioi_tinh == 1 )
	                        {{ "Nam" }}
	                    @else 
	                        {{ "Nữ" }}
	                    @endif
	                </td>
	            </tr>
	            <tr>
	                <th>Số Điện thoại</th>
	                <td>{{ $obj->sdt }}</td>
	            </tr>
	            <tr>
	                <th>Học bổng</th>
	                <td>{{ $obj->ty_le_phan_tram }}%</td>
	            </tr>
	            <tr>
	                <th>Ngày nhập học</th>
	                <td>{{ date('d-m-Y', strtotime($obj->ngay_bat_dau)) }}</td>
	            </tr>
	            <tr>
	                <th>Ngày kết thúc</th>
	                <td>{{ date('d-m-Y', strtotime($obj->ngay_ket_thuc)) }}</td>
	            </tr>
	            <tr>
	                <th>Trạng thái</th>
	                <td>
	                    @if($obj->trang_thai == 1 )
	                        <p style="color: red">{{ "Còn học" }}</p>
	                    @else 
	                        <p style="color: green">{{ "Đã nghỉ" }}</p>
	                    @endif
	                </td>
	            </tr>
	        </table>
	    </div>
    	<div class="col-sm-6">

	        <table class="table table-hover">
		   		<caption style="background-color: hsl(33, 100%, 50%); color:white;padding-left: 10px"><i class="fas fa-id-card"></i> &nbsp;Thông tin thu phí</caption>
		   		<tr>
	                <th>Lần thu</th>
	                <td>{{ $obj->lan_thu}}</td>
	            </tr>
		   		<tr>
	                <th>Đợt thu</th>
	                <td>{{ $obj->noi_dung }}</td>
	            </tr>
	            <tr>
	                <th>Hình thức nộp</th>
	                <td>{{ $obj->ten_hinh_thuc }}</td>
	            </tr>
	            <tr>
	                <th>Thuộc ngành</th>
	                <td>{{ $obj->ten_nganh }}</td>
	            </tr>
	            <tr>
	                <th width="50%">Ngày nộp phí/Thời gian</th>
	                <td>
	                    <?php \Carbon\Carbon::setLocale('vi') ?>
	                    {{date('d-m-Y', strtotime($obj->thoi_gian_thu))}}&nbsp;/
	                    {!! \Carbon\Carbon::createFromTimeStamp(strtotime($obj->thoi_gian_thu))->diffForHumans() !!}
	                </td>
	            </tr>
	            <tr>
	                <th>Nhân viên thu</th>
	                <td>{{ $obj->nguoi_thu }}</td>
	            </tr>
	            <tr>
	                <th>Tiền qui định</th>
	                <td>
	                	<b style="color: hsl(0, 100%, 40%)">{{ number_format($obj->muc_thu_qui_dinh,0,",",".")." "}}</b> <u>VND</u>
	                </td>
	            </tr>
	            <tr>
	                <th>Số tiền theo học bổng</th>
	                <td>
	                	<b style="color: hsl(0, 100%, 40%)">
	                	<?php 
	                	$hoc_bong=$obj->ty_le_phan_tram/100;
	                	$phi_qui_dinh=$obj->muc_thu_qui_dinh;
	                	$phi_giam=$phi_qui_dinh*$hoc_bong;
	                	echo number_format($phi_giam,0,",",".")." ";
	                	?>
	                	</b>
	                	<u>VND</u>
	                </td>
	            </tr>
	            <tr>
	                <th>Phí ưu đãi</th>
	                <?php 
		                $ty_le_uu_dai=$obj->ty_le_giam/100;
		                $ty_le_uu_dai=$phi_qui_dinh*$ty_le_uu_dai;
	            		$ty_le_uu_dai=round($ty_le_uu_dai, -3, PHP_ROUND_HALF_UP);
            		?>
	                <td>
	                	<b style="color: hsl(0, 100%, 40%)">{{ number_format($ty_le_uu_dai,0,",",".")." "}}</b> <u>VND</u>
	                </td>
	            </tr>
	            <tr>
	                <th>Số tiền đã nộp</th>
	                <td>
	                	<b style="color: hsl(0, 100%, 40%)">{{ number_format($obj->so_tien_thu,0,",",".")." "}}</b> <u>VND</u>
	                </td>
	            </tr>
	            <tr>
	                <th>Viết bằng chữ</th>
	                <td>
	                	<i style="font-family: initial;font-size: 18px;"><b>{{ $bang_chu }}</b></i>
	                </td>
	            </tr>
	           
	        </table>
	    </div>
    </div>
</div>
@endsection

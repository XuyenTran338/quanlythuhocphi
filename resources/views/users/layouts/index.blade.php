@extends('users.layouts.master')
@section('title','Trang chủ')

@section('content')

<div class="container-fluid" style="background-color: white; padding-top: 10px; border: 5px solid #4a7da3; border-radius: 10px; margin-top: 13px; margin-bottom: 13px;">
	<h3 class="text-center">Danh sách thu phí </h3>
	<div class="row">
		<div class="col-sm-12">
			<table id="data_table" class="table table-hover table-striped table-bordered table-condensed table-responsive">
				<thead>
					<tr style="background-color: hsl(24, 100%, 50%); color: white">
						<th>Mã SV</th>
						<th>Tên Lớp</th>
						<th>Họ và Tên</th>
				        <th>Thời gian thu</th>
				        <th>Hình thức nộp</th>
				        <th>Số tiền đã nộp</th> 
				        <th width="20%">Đợt thu</th>
				        <!-- <th width="8%">Thu tiếp</th>  -->
				    </tr>
			    </thead>
		    <tbody>
		    	@foreach($obj as $value)
					<tr>
						<td>{{ $value->sinh_vien_ma }}</td>
						<td>{{ $value->ten_lop }}</td>
						<td>{{ $value->ten_sinh_vien }}</td>
						<td>{{date('d-m-Y', strtotime($value->thoi_gian_thu))}} <br><i class="far fa-clock"></i>
							<?php \Carbon\Carbon::setLocale('vi') ?>
	                        {!! \Carbon\Carbon::createFromTimeStamp(strtotime($value->thoi_gian_thu))->diffForHumans() !!}
                    	</td>
						<td>{{ $value->ten_hinh_thuc }}</td>
						<td><b style="color: hsl(0, 100%, 40%)">{{ number_format($value->so_tien_thu,0,",",".") }}</b> VND</td>
						<td>{{ $value->noi_dung }}</td>
						<!-- <td class="text-center"><a href="{{route('list_receipt_student', $value->sinh_vien_ma)}}"><i class="fas fa-share " style="font-size: 20px; color: hsl(24, 100%, 50%)"></i></a></td> -->
					</tr>
		    	@endforeach
		    </tbody>
		    <tfoot>
				<tr style="background-color: hsl(24, 100%, 50%); color: white">
					<th>Mã SV</th>
					<th>Tên Lớp</th>
					<th>Họ và Tên</th>
			        <th>Thời gian thu</th>
			        <th>Hình thức nộp</th>
			        <th>Số tiền đã nộp</th> 
			        <th width="20%">Đợt thu</th>
				</tr>
			</tfoot>
			</table>
		</div>
	</div>
</div>
 
@endsection

@section('script')

	@if(session('messages'))
	   	<script type="text/javascript">
			$(document).ready(function(){
				swal("Thành công!",'{{session('messages')}}', "success");
			});
		</script>
	@else

	<script type="text/javascript">
		$(document).ready(function(){
			var today=new Date();
			var day=today.getDate();
			if(day == 21)
			{
				swal("Cảnh báo!",'Hôm nay là ngày 21 rồi! Bắt tay làm báo cáo thôi', "warning");
			}
			return true;
		});
	</script>
	@endif
	<script type="text/javascript">
		$(document).ready(function() {
	        $('#data_table').DataTable({
	                responsive: true
	        });
	    });
	</script>

@endsection






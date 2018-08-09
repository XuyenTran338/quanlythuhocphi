@extends('users.layouts.master')
@section('title','Danh sách sinh viên')

@section('link')

@endsection
@section('content')
<style type="text/css">
    td:nth-child(10){
        color: hsl(0, 100%, 40%);
        font-weight: bold;
    }
</style>
<header class="header_main">
	<i class="fas fa-graduation-cap font-icon"></i>&nbsp;&nbsp;Danh sách sinh viên
</header>
<div class="content_main">
	<div class="row">
		<div class="select_input col-sm-12">
			<div class="form-group col-sm-4">
				<label class="label-control col-sm-8">Ngành học</label>
				<div class="col-sm-12">
					<select name="sltNganh" id="id_nganh" class="form-control select2" >
						@foreach($nganh as $obj)
							<option value="{{ $obj->ma_nganh }}" @if(old('sltNganh') == $obj->ma_nganh) selected @endif>
								{{ $obj->ten_nganh }}
							</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="form-group col-sm-4">
				<label class="label-control col-sm-8">Khóa</label>
				<div class="col-sm-12">
					<select name="sltKhoa" class="form-control select2" id="id_khoa">
						
					</select>
				</div>
			</div>
			<div class="form-group col-sm-4">
				<label class="label-control col-sm-8">Lớp học</label>
				<div class="col-sm-12">
					<select name="sltKhoa" class="form-control select2" id="id_lop">
						
					</select>
				</div>
			</div>
		</div>

		<div class="button_function col-sm-12">
			<!-- <button type="button" class="btn btn_color " data-toggle="modal" data-target="#model_excel"><i class="fas fa-file-excel icon_color"></i> &nbsp; Import&nbsp; <i class="fas fa-upload"></i></button>
			
			<div id="model_excel" class="modal fade" tabindex="-1" role="dialog">
				<form action="{{ route('postExcel') }}" method="post" enctype="multipart/form-data">
					        <div class="modal-dialog ">
					            <div class="modal-content">
					                <div class="modal-header">
					                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					                    <h4 class="modal-title"><i class="fas fa-upload"></i>&nbsp; Import File Excel </h4>
					                </div>
					                <div class="modal-body">
					                   		<input type="hidden" name="_token" value="{{csrf_token()}}">
					                   		<input type="file" name="import_file">
					                   		<span> </span>
					                </div>
					                <div class="modal-footer">
					                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					                    <button type="submit" class="btn btn-primary">Import File</button> 
					                </div>
					            </div>
					        </div>
					    	</form>
					    </div> -->
		   
			<button type="button" class="btn btn_color export" data-toggle="tooltip" data-placement="top" title="Export"><i class="fas fa-file-excel icon_color"></i> &nbsp; Export</button>
			<button type="button" id="view_sv_print" class="btn btn_color"><i class="fas fa-print icon_color"></i> &nbsp; In</button>

			@include('users.sinhvien.print_list')
			<!-- <button type="button" class="btn btn_color"><i class="fas fa-sync-alt icon_color"></i> &nbsp; Tải lại</button> -->
		</div>
	</div>
</div><br>
	<div class="row">
		<div class="col-sm-12" id="table_export" style="background-color: white; padding-top: 10px; border: 5px solid #4a7da3; border-radius: 10px">
			<table id="data_table" class="table table-hover table-striped table-bordered table-condensed table-responsive table_export" border="1" cellpadding="5" cellspacing="0">
				<!-- <span style="position: inherit;top: 30px; left: 30px; z-index: 100; color: #1e395b;font-size: 13px;">
					Sĩ số : 10 học viên
				</span> -->
				<thead>
					<tr style="background-color: hsl(163, 81%, 90%);">
						<th>STT</th>
						<th>Mã_SV</th>
		                <th>Họ và tên</th>
		                <th>Học bổng</th>
		                <th>Ngày sinh</th>
		                <th>Email</th>
		                <th>Giới tính</th>
		                <th>Số điện thoại</th>
		                <th>Hình thức nộp</th>
		                <th>Trạng thái</th>
					</tr>
				</thead>
				<tbody>
					
		        </tbody>
			</table>
		</div>
	</div>

@endsection

@section('script')

<script src="{{ asset('user/public/js/ajax_sinh_vien.js') }}"></script>
<script type="text/javascript">
   	$(document).ready(function(){
   		$('.export').click(function(){
   			var ma_lop = $("#id_lop").val();
			$.get("users/student/check_sv_print/"+ma_lop,function(check){
				if(check['check'] > 0)
				{
					$("#data_table").table2excel({
						exclude: ".noExl",
						name: "Excel Document Name",
						filename: "Danh sach sinh vien" + new Date().toISOString().replace(/[\-\:\.]/g, ""),
						fileext: ".xls",
						exclude_img: true,
						exclude_links: true,
						exclude_inputs: true
					});
				}else
				{
					swal("Nhắc nhở!",'Lớp '+check.ten_lop+' chưa có sinh viên để xuất file! Vui lòng chọn lớp khác',"warning");
				}
			});
		});
	});

	$(document).ready(function(){
		$('#save_excel').click(function(){
			$("#content_print").table2excel({
				exclude: ".noExl",
				name: "Excel Document Name",
				filename: "Danh sach sinh vien" + new Date().toISOString().replace(/[\-\:\.]/g, ""),
				fileext: ".xls",
				exclude_img: true,
				exclude_links: true,
				exclude_inputs: true
			});
		});
	});

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
@endsection

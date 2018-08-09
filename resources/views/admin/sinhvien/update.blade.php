@extends('admin/layouts.master')
@section('title','Sửa sinh viên')
@section('heading') 
   <i class="fas fa-graduation-cap" style="color:#16a291; font-size: 30px"></i>&nbsp;Sinh viên
@endsection 	 	
@section('content')

<div class="box">
    <header>
        <div class="icons"><i class="fas fa-edit"></i></div>
        <h5>Sửa sinh viên</h5>
    </header>
    <div id="collapseOne" class="body">
        <form action="{{ route('postUpdate_students',$obj->ma_sinh_vien) }}" method="post" class="form-horizontal">
        	<div class="col-sm-1"></div>
        	<div class="col-sm-4">
				<input type="hidden" name="_token" value="{{csrf_token()}}">
				<div class="form-group{{ $errors->has('sltNganh') ? ' has-error' : '' }}">
					<label>Ngành học</label>
						<select class="form-control selectpicker" title="---Chọn ngành học---" data-live-search = "true" name="sltNganh" id="id_nganh" disabled>
							@foreach($nganh as $value)
								<option value="{{ $value->ma_nganh }}" @if($obj->ma_nganh == $value->ma_nganh) selected @endif >
									{{ $value->ten_nganh }}
								</option>
							@endforeach
						</select>
					@if ($errors->has('sltNganh'))
	                    <span class="help-block">
	                        <strong>{{ $errors->first('sltNganh') }}</strong>
	                    </span>
	                @endif
				</div>
				<div class="form-group{{ $errors->has('sltKhoaHoc') ? ' has-error' : '' }}">
					<label>Khóa học</label>
						<select class="form-control" name="sltKhoaHoc" id="id_khoa" disabled>
							@foreach($khoahoc as $value)
								<option value="{{ $value->ma_khoa_hoc }}" @if($value->ma_khoa_hoc == $obj->ma_khoa_hoc) selected @endif>
									{{ $value->ten_khoa_hoc }}
								</option>
							@endforeach
						</select>
					@if ($errors->has('sltKhoaHoc'))
	                    <span class="help-block">
	                        <strong>{{ $errors->first('sltKhoaHoc') }}</strong>
	                    </span>
	                @endif
				</div>
				<div class="form-group{{ $errors->has('sltLop') ? ' has-error' : '' }}">
					<label>Lớp học</label>
						<select class="form-control select2" title="---Chọn lớp học---" name="sltLop" id="id_lop">
							 @foreach($lop as $value)
								<option value="{{ $value->ma_lop }}" @if($value->ma_lop == $obj->lop_ma) selected @endif>
									{{ $value->ten_lop }}
								</option>
							@endforeach
						</select>
					@if ($errors->has('sltLop'))
	                    <span class="help-block">
	                        <strong>{{ $errors->first('sltLop') }}</strong>
	                    </span>
	                @endif
				</div>
				<div class="form-group{{ $errors->has('sltHB') ? ' has-error' : '' }}">
					<label>Học bổng</label>
						<select class="form-control select2" title="---Chọn học bổng---" name="sltHB">
							@foreach($doituong as $value)
								<option value="{{$value->ma_hoc_bong}}" @if($value->ma_hoc_bong == $obj->hoc_bong_ma) selected @endif>
									{{$value->ten_hoc_bong}}__{{$value->ty_le_phan_tram}}%
								</option>
							@endforeach
						</select>
					@if ($errors->has('sltHB'))
	                    <span class="help-block">
	                        <strong>{{ $errors->first('sltHB') }}</strong>
	                    </span>
	                @endif
				</div>
				<div class="form-group{{ $errors->has('sltMucThu') ? ' has-error' : '' }}">
					<label>Hình thức nộp</label>
						<select class="form-control select2" title="---Chọn mức thu---" name="sltMucThu">
							@foreach($muc_thu as $value)
								<option value="{{$value->ma_muc_thu}}" @if($value->ma_muc_thu == $obj->muc_thu_ma) selected @endif>
									{{$value->ten_hinh_thuc}} có phí {{number_format($value->muc_thu_qui_dinh,0,",",".")}} (VND)
								</option>
							@endforeach
						</select>
					@if ($errors->has('sltMucThu'))
	                    <span class="help-block">
	                        <strong>{{ $errors->first('sltMucThu') }}</strong>
	                    </span>
	                @endif
				</div>
				<div class="form-group{{ $errors->has('rdTrangthai') ? ' has-error' : '' }}">
					<label>Trạng thái</label>
					<br>
						<input type="radio" name="rdTrangthai" value="1" @if( $obj->trang_thai == 1) checked @endif>&nbsp;Còn học &nbsp;&nbsp;&nbsp;
						<input type="radio" name="rdTrangthai"  value="0" @if( $obj->trang_thai == 0) checked @endif>&nbsp;Đã nghỉ
					@if ($errors->has('rdTrangthai'))
	                    <span class="help-block">
	                        <strong>{{ $errors->first('rdTrangthai') }}</strong>
	                    </span>
	                @endif
				</div>
			</div>
			<div class="col-sm-2"></div>
			<div class="col-sm-4"> 
				<div class="form-group{{ $errors->has('txtTen') ? ' has-error' : '' }}">
					<label>Tên sinh viên</label>
						<input type="text" name="txtTen" class="form-control" placeholder="Họ và tên" value="{{ $obj->ten_sinh_vien }}">
					@if ($errors->has('txtTen'))
	                    <span class="help-block">
	                        <strong>{{ $errors->first('txtTen') }}</strong>
	                    </span>
	                @endif
				</div>
				<div class="form-group{{ $errors->has('txtBirth') ? ' has-error' : '' }}">
					<label>Ngày sinh</label>
						<input type="date" name="txtBirth" class="form-control" value="{{ $obj->ngay_sinh }}">
					@if ($errors->has('txtBirth'))
	                    <span class="help-block">
	                        <strong>{{ $errors->first('txtBirth') }}</strong>
	                    </span>
	                @endif
				</div>
				<div class="form-group{{ $errors->has('txtEmail') ? ' has-error' : '' }}">
					<label>Email</label>
						<input type="email" name="txtEmail" class="form-control" placeholder="Email@gmail.com" value="{{ $obj->email }}">
					@if ($errors->has('txtEmail'))
	                    <span class="help-block">
	                        <strong>{{ $errors->first('txtEmail') }}</strong>
	                    </span>
	                @endif
				</div>
				<div class="form-group{{ $errors->has('txtSDT') ? ' has-error' : '' }}">
					<label>Số điện thoại</label>
						<input type="text" name="txtSDT" class="form-control" placeholder="Số điện thoại" value="{{ $obj->sdt }}">
					@if ($errors->has('txtSDT'))
	                    <span class="help-block">
	                        <strong>{{ $errors->first('txtSDT') }}</strong>
	                    </span>
	                @endif
				</div>
				<div class="form-group{{ $errors->has('txtAdd') ? ' has-error' : '' }}">
					<label>Địa chỉ</label>
						<input type="text" name="txtAdd" class="form-control" placeholder="Thôn/Xã-Phường/Quận-Tỉnh/TP" value="{{ $obj->dia_chi }}">
					@if ($errors->has('txtAdd'))
	                    <span class="help-block">
	                        <strong>{{ $errors->first('txtAdd') }}</strong>
	                    </span>
	                @endif
				</div>
				<div class="form-group{{ $errors->has('rdSex') ? ' has-error' : '' }}">
					<label>Giới tính</label>
					<br>
						<input type="radio" name="rdSex" value="1" @if( $obj->gioi_tinh == 1) checked @endif>&nbsp;Nam &nbsp;&nbsp;&nbsp;
						<input type="radio" name="rdSex"  value="0" @if( $obj->gioi_tinh == 0) checked @endif>&nbsp;Nữ
					@if ($errors->has('rdSex'))
	                    <span class="help-block">
	                        <strong>{{ $errors->first('rdSex') }}</strong>
	                    </span>
	                @endif
				</div>
			</div>
			<div class="col-sm-1"></div>
	        <div align="center">
	        	<input type="submit" value="Lưu" class="btn btn-primary btn-line" style="width: 100px; font-weight: bold;">&nbsp;&nbsp;&nbsp;
	        </div>
        </form>
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
@endif
<!-- <script type="text/javascript">
 	$(document).ready(function(){
 		$("#id_nganh").change(function(){
 			var ma_nganh = $(this).val();
 			$.get("admins/student/ajax_khoa/"+ma_nganh,function(data){
 				$("#id_khoa").html(data);
 
 				var ma_khoa = $("#id_khoa").val();
 				$.get("admins/student/ajax_lop/"+ma_nganh+'/'+ma_khoa,function(data){
 					$("#id_lop").html(data);
 				});
 
 			});
 			
 		});
 
 		$("#id_khoa").change(function(){
 			var ma_khoa = $(this).val();
 			var ma_nganh = $("#id_nganh").val();
 			$.get("admins/student/ajax_lop/"+ma_nganh+'/'+ma_khoa,function(data){
 				$("#id_lop").html(data);
 			});
 		});
 	});
 </script> --> 

@endsection
@extends('admin/layouts.master')
@section('title','Thêm sinh viên')
@section('heading') 
   <i class="fas fa-graduation-cap" style="color:#16a291; font-size: 30px"></i>&nbsp;Sinh viên
@endsection 	 	
@section('content')

<!-- @if(session('messages'))
    <div class="alert alert-success alert-dismissible fade in">
        {{session('messages')}}
    </div>
@endif -->
<div class="box">
    <header>
        <div class="icons"><i class="fas fa-plus-square"></i></div>
        <h5>Thêm sinh viên</h5>
    </header>
    <div id="collapseOne" class="body">
        <form action="{{ route('postInsert_students') }}" method="post" class="form-horizontal">
        	<div class="col-sm-1"></div>
        	<div class="col-sm-4">
				<input type="hidden" name="_token" value="{{csrf_token()}}">
				<div class="form-group{{ $errors->has('sltNganh') ? ' has-error' : '' }}">
					<label>Ngành học</label>
						<select class="form-control select2" title="---Chọn ngành học---" name="sltNganh" id="id_nganh">
							@foreach($nganh as $obj)
								<option value="{{ $obj->ma_nganh }}" @if(old('sltNganh') == $obj->ma_nganh) selected @endif>
									{{ $obj->ten_nganh }}
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
						<select class="form-control select2" name="sltKhoaHoc" id="id_khoa">
							
						</select>
					@if ($errors->has('sltKhoaHoc'))
	                    <span class="help-block">
	                        <strong>{{ $errors->first('sltKhoaHoc') }}</strong>
	                    </span>
	                @endif
				</div>
				<div class="form-group{{ $errors->has('sltLop') ? ' has-error' : '' }}">
					<label>Lớp học</label>
						<select class="form-control select2" name="sltLop" id="id_lop">
							
						</select>
					@if ($errors->has('sltLop'))
	                    <span class="help-block">
	                        <strong>{{ $errors->first('sltLop') }}</strong>
	                    </span>
	                @endif
				</div>
				<div class="form-group{{ $errors->has('sltHB') ? ' has-error' : '' }}">
					<label>Học bổng</label>
						<select class="form-control select2" title="---Chọn học bổng---" data-live-search = "true" name="sltHB">
							@foreach($doituong as $obj)
								<option value="{{$obj->ma_hoc_bong}}" @if(old('sltHB') == $obj->ma_hoc_bong) selected @endif>
									{{$obj->ten_hoc_bong}}__{{$obj->ty_le_phan_tram}}%
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
						<select class="form-control select2" title="---Chọn mức thu---" name="sltMucThu" id="id_muc_thu">
							
						</select>
					@if ($errors->has('sltMucThu'))
	                    <span class="help-block">
	                        <strong>{{ $errors->first('sltMucThu') }}</strong>
	                    </span>
	                @endif
				</div>
			</div>
			<div class="col-sm-2"></div>
			<div class="col-sm-4"> 
				<div class="form-group{{ $errors->has('txtTen') ? ' has-error' : '' }}">
					<label>Tên sinh viên</label>
						<input type="text" name="txtTen" class="form-control" placeholder="Họ và tên" value="{{ old('txtTen') }}">
					@if ($errors->has('txtTen'))
	                    <span class="help-block">
	                        <strong>{{ $errors->first('txtTen') }}</strong>
	                    </span>
	                @endif
				</div>
				<div class="form-group{{ $errors->has('txtBirth') ? ' has-error' : '' }}">
					<label>Ngày sinh</label>
						<input type="date" name="txtBirth" class="form-control" value="{{ old('txtBirth') }}">
					@if ($errors->has('txtBirth'))
	                    <span class="help-block">
	                        <strong>{{ $errors->first('txtBirth') }}</strong>
	                    </span>
	                @endif
				</div>
				<div class="form-group{{ $errors->has('txtEmail') ? ' has-error' : '' }}">
					<label>Email</label>
						<input type="email" name="txtEmail" class="form-control" placeholder="Email@gmail.com" value="{{ old('txtEmail') }}">
					@if ($errors->has('txtEmail'))
	                    <span class="help-block">
	                        <strong>{{ $errors->first('txtEmail') }}</strong>
	                    </span>
	                @endif
				</div>
				<div class="form-group{{ $errors->has('txtSDT') ? ' has-error' : '' }}">
					<label>Số điện thoại</label>
						<input type="text" name="txtSDT" class="form-control" placeholder="Số điện thoại" value="{{ old('txtSDT') }}">
					@if ($errors->has('txtSDT'))
	                    <span class="help-block">
	                        <strong>{{ $errors->first('txtSDT') }}</strong>
	                    </span>
	                @endif
				</div>
				<div class="form-group{{ $errors->has('txtAdd') ? ' has-error' : '' }}">
					<label>Địa chỉ</label>
						<input type="text" name="txtAdd" class="form-control" placeholder="Thôn/Xã-Phường/Quận-Tỉnh/TP" value="{{ old('txtAdd') }}">
					@if ($errors->has('txtAdd'))
	                    <span class="help-block">
	                        <strong>{{ $errors->first('txtAdd') }}</strong>
	                    </span>
	                @endif
				</div>
				<div class="form-group{{ $errors->has('rdSex') ? ' has-error' : '' }}">
					<label>Giới tính</label>
					<br>
						<input type="radio" name="rdSex" value="1" @if( old('rdSex') == 1) checked @endif>&nbsp;Nam &nbsp;&nbsp;&nbsp;
						<input type="radio" name="rdSex"  value="0" @if( old('rdSex') == 0) checked @endif>&nbsp;Nữ
					@if ($errors->has('rdSex'))
	                    <span class="help-block">
	                        <strong>{{ $errors->first('rdSex') }}</strong>
	                    </span>
	                @endif
				</div>
			</div>
			<div class="col-sm-1"></div>
	        <div align="center">
	        	<input type="submit" value="Lưu" class="btn btn-primary btn-line" style="width: 100px; font-weight: bold;">
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

<!-- <script src="{{ asset('admin/public/assets/js/ajax_nganh_khoa_lop.js') }}"></script>
 -->
 <script type="text/javascript">
 	$(document).ready(function() {
        var ma_nganh=$("#id_nganh").val();
        $.get("admins/student/ajax_khoa/"+ma_nganh,function(data){
            var html='';
           
            $.each(data.khoa,function(key,value){
                var start= new Date(value.ngay_bat_dau);
                var end= new Date(value.ngay_ket_thuc);
                start=start.getFullYear();
                end=end.getFullYear();
                html+='<option value='+value.khoa_hoc_ma+'>'+ value.ten_khoa_hoc+'___Niên học:'+start+'-'+end+'</option>';
            });
            $('#id_khoa').html(html);

            var html='';
            $.each(data.mucthu,function(key,value){
            	html+='<option value='+ value.ma_muc_thu +'>'+value.ten_hinh_thuc+' có phí '+value.muc_thu_qui_dinh+' (VND)</option>';
            });
            $("#id_muc_thu").html(html);

            var ma_khoa=$("#id_khoa").val();
            $.get("admins/student/ajax_lop/"+ma_nganh+'/'+ma_khoa,function(data){
                var html='';
                $.each(data,function(key,value){
                	if(value.si_so == value.si_so_now)
                	{
                		html+='<option value='+value.ma_lop+' disabled>'+ value.ten_lop +'___Sĩ số: '+ value.si_so_now+'/'+value.si_so+'</option>';
                	}else
                	{
                		html+='<option value='+value.ma_lop+'>'+ value.ten_lop +'___Sĩ số: '+ value.si_so_now+'/'+value.si_so +'</option>';
                	}
                    
                });
                $('#id_lop').html(html);
            });
        });

        $("#id_nganh").change(function(){
            var ma_nganh = $(this).val();
            $.get("admins/student/ajax_khoa/"+ma_nganh,function(data){
                var html='';
                $.each(data.khoa,function(key,value){
                    var start= new Date(value.ngay_bat_dau);
                    var end= new Date(value.ngay_ket_thuc);
                    start=start.getFullYear();
                    end=end.getFullYear();
                    html+='<option value='+value.khoa_hoc_ma+'>'+ value.ten_khoa_hoc+'___Niên học:'+start+'-'+end+'</option>';
                });
                $('#id_khoa').html(html);

                var html='';
	            $.each(data.mucthu,function(key,value){
	            	html+='<option value='+ value.ma_muc_thu +'>'+value.ten_hinh_thuc+' có phí '+value.muc_thu_qui_dinh+' (VND)</option>';
	            });
	            $("#id_muc_thu").html(html);

                var ma_khoa=$("#id_khoa").val();
                $.get("admins/student/ajax_lop/"+ma_nganh+'/'+ma_khoa,function(data){
                    var html='';
                    $.each(data,function(key,value){
                        if(value.si_so == value.si_so_now)
	                	{
	                		html+='<option value='+value.ma_lop+' disabled>'+ value.ten_lop +'___Sĩ số: '+ value.si_so_now+'/'+value.si_so+'</option>';
	                	}else
	                	{
	                		html+='<option value='+value.ma_lop+'>'+ value.ten_lop +'___Sĩ số: '+ value.si_so_now+'/'+value.si_so +'</option>';
	                	}
	                    });
                    $('#id_lop').html(html);
                });
            });
        });

        $("#id_khoa").change(function(){
            var ma_khoa=$(this).val();
            var ma_nganh=$("#id_nganh").val();
            $.get("admins/student/ajax_lop/"+ma_nganh+'/'+ma_khoa,function(data){
                var html='';
                $.each(data,function(key,value){
                   if(value.si_so == value.si_so_now)
                	{
                		html+='<option value='+value.ma_lop+' disabled>'+ value.ten_lop +'___Sĩ số: '+ value.si_so_now+'/'+value.si_so+'</option>';
                	}else
                	{
                		html+='<option value='+value.ma_lop+'>'+ value.ten_lop +'___Sĩ số: '+ value.si_so_now+'/'+value.si_so +'</option>';
                	}
                });
                $('#id_lop').html(html);
            });
        });
    });
 </script>
@endsection
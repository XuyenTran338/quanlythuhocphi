@extends('admin/layouts.master')

@section('title','Thêm tài khoản')

@section('heading') 
    <i class="fas fa-user-circle" style="color:#16a291; font-size: 30px"></i>&nbsp;Tài khoản
@endsection

@section('link')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css">
@endsection	 

@section('content')

<div class="box">
    <header>
        <div class="icons"><i class="fas fa-user-plus"></i></div>
        <h5>Thêm tài khoản</h5>
    </header>
    <div id="collapseOne" class="body">
        <form action="{{ route('postInsert_user') }}" method="post" class="form-horizontal" enctype="multipart/form-data">
			<input type="hidden" name="_token" value="{{csrf_token()}}">
			<div class="form-group{{ $errors->has('txtEmail') ? ' has-error' : '' }}">
				<label class="control-label col-lg-4">Email</label>
				<div class="col-lg-4">
					<input type="email" name="txtEmail" class="form-control" placeholder="Example@gmail.com" value="{{ old('txtEmail') }}">
				</div>
				@if ($errors->has('txtEmail'))
                    <span class="help-block">
                        <strong>{{ $errors->first('txtEmail') }}</strong>
                    </span>
                @endif
			</div>
			<div class="form-group{{ $errors->has('txtUser') ? ' has-error' : '' }}">
				<label class="control-label col-lg-4">Tên tài khoản</label>
				<div class="col-lg-4">
					<input type="text"  name="txtUser" class="form-control" placeholder="Tên tài khoản" value="{{ old('txtUser') }}">
				</div>
				@if ($errors->has('txtUser'))
                    <span class="help-block">
                        <strong>{{ $errors->first('txtUser') }}</strong>
                    </span>
                @endif
			</div>
			<div class="form-group{{ $errors->has('txtPass') ? ' has-error' : '' }}">
				<label class="control-label col-lg-4">Mật khẩu</label>
				<div class="col-lg-4">
					<input type="password" name="txtPass" class="form-control" placeholder="Mật khẩu" value="{{ old('txtPass') }}">
				</div>
				@if ($errors->has('txtPass'))
                    <span class="help-block">
                        <strong>{{ $errors->first('txtPass') }}</strong>
                    </span>
                @endif
			</div>
			<div class="form-group{{ $errors->has('txtRe_Pass') ? ' has-error' : '' }}">
				<label class="control-label col-lg-4">Xác nhận mật khẩu</label>
				<div class="col-lg-4">
					<input type="password" name="txtRe_Pass" class="form-control" placeholder="Nhập lại mật khẩu" >
				</div>
				@if ($errors->has('txtRe_Pass'))
                    <span class="help-block">
                        <strong>{{ $errors->first('txtRe_Pass') }}</strong>
                    </span>
                @endif
			</div>
			<div class="form-group{{ $errors->has('txtLevel') ? ' has-error' : '' }}">
				<label class="control-label col-lg-4">Phân quyền</label>
				<div class="col-lg-4">
					<select class="form-control" name="txtLevel">
						<option value="">---Chọn phân quyền---</option>
							<option class="form-control" value="1" @if( old('txtLevel') ==1 ) selected @endif >Admin</option>
							<option class="form-control" value="2" @if( old('txtLevel') ==2 ) selected @endif >Giáo Vụ</option>
					</select>
				</div>
				@if ($errors->has('txtLevel'))
                    <span class="help-block">
                        <strong>{{ $errors->first('txtLevel') }}</strong>
                    </span>
                @endif
			</div>
			<div class="form-group{{ $errors->has('txtTen') ? ' has-error' : '' }}">
				<label class="control-label col-lg-4">Họ và Tên</label>
				<div class="col-lg-4">
					<input type="text" name="txtTen" class="form-control" placeholder="Họ và tên" value="{{ old('txtTen') }}">
				</div>
				@if ($errors->has('txtTen'))
                    <span class="help-block">
                        <strong>{{ $errors->first('txtTen') }}</strong>
                    </span>
                @endif
			</div>
			<div class="form-group{{ $errors->has('rdSex') ? ' has-error' : '' }}">
				<label class="control-label col-lg-4">Giới tính</label>
				<div class="col-lg-4">
					<input type="radio" name="rdSex" value="1" @if( old('rdSex') == 1) checked @endif>&nbsp;Nam &nbsp;&nbsp;&nbsp;
					<input type="radio" name="rdSex"  value="0" @if( old('rdSex') == 0) checked @endif>&nbsp;Nữ
				</div>
				@if ($errors->has('rdSex'))
                    <span class="help-block">
                        <strong>{{ $errors->first('rdSex') }}</strong>
                    </span>
                @endif
			</div>
			<div class="form-group{{ $errors->has('txtSDT') ? ' has-error' : '' }}">
				<label class="control-label col-lg-4">Số điện thoại</label>
				<div class="col-lg-4">
					<br>
					<input type="text" name="txtSDT" class="form-control" placeholder="Number phone" value="{{ old('txtSDT') }}">
				</div>
				@if ($errors->has('txtSDT'))
                    <span class="help-block">
                        <strong>{{ $errors->first('txtSDT') }}</strong>
                    </span>
                @endif
			</div>

           <div class="form-group{{ $errors->has('txtFile') ? ' has-error' : '' }}">
			    <label class="control-label col-lg-4">Ảnh đại diện</label>
			    <div class="col-lg-4">
			        <div class="fileinput fileinput-new" data-provides="fileinput" style="border:0px solid white">
			        	<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
			            <img src="admin/public/assets/img/nophoto.png" alt="..." >
			          	</div>
			        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 300px; max-height: 150px;"></div>
			        <div>
			            <span class="btn btn-default btn-file">
			            <span class="fileinput-new">Chọn ảnh</span>
			            <span class="fileinput-exists">Đổi ảnh</span>
			            <input type="file" name="txtFile">
			            </span>
			            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Xóa</a>
			        </div>
			    	</div>
				</div>
			    @if ($errors->has('txtFile'))
                    <span class="help-block">
                        <strong>{{ $errors->first('txtFile') }}</strong>
                    </span>
                @endif
			</div>
			
			<div align="center"><input type="submit" value="Thêm" class="btn btn-primary" style="width: 100px"></div>
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
	<script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>
	
    <script>
        $(function() {
            Metis.formWizard();
        });
    </script>

   
@endsection
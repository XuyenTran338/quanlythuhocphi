@extends('admin/layouts.master')
@section('title','Sửa tài khoản')
@section('heading') 
    <i class="fas fa-user-circle" style="color:#16a291; font-size: 30px"></i>&nbsp;Tài khoản
@endsection

@section('link')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css">
@endsection	

@section('content')

@if(session('messages'))
    <div class="alert alert-success alert-dismissible fade in">
        {{session('messages')}}
    </div>
@endif

<div class="box">
    <header>
        <div class="icons"><i class="fas fa-edit"></i></div>
        <h5>Sửa tài khoản</h5>
    </header>
    <div id="collapseOne" class="body">
        <form action="{{ route('postUpdate_user',$obj->ma_tai_khoan) }}" method="post" class="form-horizontal" enctype="multipart/form-data">
			<input type="hidden" name="_token" value="{{csrf_token()}}">
			<div class="form-group{{ $errors->has('txtUser') ? ' has-error' : '' }}">
				<label class="control-label col-lg-4">Tên tài khoản</label>
				<div class="col-lg-4">
					<input type="text"  name="txtUser" class="form-control" placeholder="Tên tài khoản" value="{{ $obj->ten_tai_khoan }}" readonly>
				</div>
				@if ($errors->has('txtUser'))
                    <span class="help-block">
                        <strong>{{ $errors->first('txtUser') }}</strong>
                    </span>
                @endif
			</div>
			<div class="form-group{{ $errors->has('txtEmail') ? ' has-error' : '' }}">
				<label class="control-label col-lg-4">Email</label>
				<div class="col-lg-4">
					<input type="email" name="txtEmail" class="form-control" placeholder="Example@gmail.com" value="{{ $obj->email }}">
				</div>
				@if ($errors->has('txtEmail'))
                    <span class="help-block">
                        <strong>{{ $errors->first('txtEmail') }}</strong>
                    </span>
                @endif
			</div>
			@if(session()->get('user.ma_tai_khoan') != $obj->ma_tai_khoan)

				<div class="form-group{{ $errors->has('txtLevel') ? ' has-error' : '' }}">
				<label class="control-label col-lg-4">Phân quyền</label>
				<div class="col-lg-4">
					<select class="form-control" name="txtLevel">
						<option value="">---Chọn phân quyền---</option>
						@foreach($list_distinct as $value)
							<option value="{{$value->phan_quyen}}" @if($value->phan_quyen == $obj->phan_quyen) selected @endif>
								@if($value->phan_quyen == 1)
									{{ "Admin" }}
								@elseif($value->phan_quyen == 2)
									{{ "Giáo vụ" }}
								@endif
							</option>
						@endforeach
					</select>
				</div>
				@if ($errors->has('txtLevel'))
                    <span class="help-block">
                        <strong>{{ $errors->first('txtLevel') }}</strong>
                    </span>
                @endif
				</div>
			@endif
			<div class="form-group{{ $errors->has('txtTen') ? ' has-error' : '' }}">
				<label class="control-label col-lg-4">Họ và Tên</label>
				<div class="col-lg-4">
					<input type="text" name="txtTen" class="form-control" placeholder="Họ và tên" value="{{ $obj->ho_ten }}">
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
					<input type="radio" name="rdSex" value="1" @if( $obj->gioi_tinh == 1) checked @endif>&nbsp;Nam &nbsp;&nbsp;&nbsp;
					<input type="radio" name="rdSex"  value="0" @if( $obj->gioi_tinh == 0) checked @endif>&nbsp;Nữ
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
					<input type="text" name="txtSDT" class="form-control" placeholder="Number phone" value="{{ $obj->SDT}}">
				</div>
				@if ($errors->has('txtSDT'))
                    <span class="help-block">
                        <strong>{{ $errors->first('txtSDT') }}</strong>
                    </span>
                @endif
			</div>
			<div class="form-group{{ $errors->has('txtFile') ? ' has-error' : '' }}">
			    <label class="control-label col-lg-4">Ảnh đại diện</label>
			    <input type="hidden" name="txtAnhCu" value="{{ $obj->image}}" />
			    <div class="col-lg-4">
			        <div class="fileinput fileinput-new" data-provides="fileinput">
			          <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
			            <img src="admin/public/assets/img/{{$obj->image}}" alt="...">
			          </div>
			          <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
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
                @if(session('error_anh'))
					<div class="alert alert-danger alert-dismissible fade in">
					    {{session('error_anh')}}
					</div>
				@endif
			</div>
           <div align="center"><input type="submit" value="Sửa" class="btn btn-primary" style="width: 100px"></div>

        </form>
    </div>
</div>
@endsection

@section('script')
	<script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>
	
    <script>
        $(function() {
            Metis.formWizard();
        });
    </script>
@endsection
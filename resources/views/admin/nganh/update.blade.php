@extends('admin/layouts.master')
@section('title','Sửa ngành học')
@section('heading') 
    <i class="fab fa-readme" style="color:#16a291; font-size: 30px"></i>&nbsp;Ngành học
@endsection 	 	
@section('content')

<div class="box">
    <header>
        <div class="icons"><i class="fas fa-edit"></i></div>
        <h5>Sửa ngành học</h5>
    </header>
    <div id="collapseOne" class="body">
        <form action="{{ route('postUpdate_majors',$obj->ma_nganh) }}" method="post" class="form-horizontal">
			<input type="hidden" name="_token" value="{{csrf_token()}}">
			<div class="form-group{{ $errors->has('txtTenNganh') ? ' has-error' : '' }}">
				<label class="control-label col-lg-4">Tên ngành</label>
				<div class="col-lg-4">
					<input type="text" name="txtTenNganh" class="form-control" placeholder="Tên ngành" value="{{ $obj->ten_nganh }}">
				</div>
				@if ($errors->has('txtTenNganh'))
                    <span class="help-block">
                        <strong>{{ $errors->first('txtTenNganh') }}</strong>
                    </span>
                @endif
			</div>
			<div class="form-group{{ $errors->has('txtHe') ? ' has-error' : '' }}">
				<label class="control-label col-lg-4">Hệ đào tạo</label>
				<div class="col-lg-4">
					<input type="text"  name="txtHe" class="form-control" placeholder="Hệ đào tạo" value="{{ $obj->he_dao_tao }}">
				</div>
				@if ($errors->has('txtHe'))
                    <span class="help-block">
                        <strong>{{ $errors->first('txtHe') }}</strong>
                    </span>
                @endif
			</div>
           <div align="center"><input type="submit" value="Sửa" class="btn btn-primary" style="width: 100px"></div>

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

@if(session('messages_error'))
    <script type="text/javascript">
        $(document).ready(function(){
            swal("Có lỗi!",'{{session('messages_error')}}', "error");
        });
    </script>
@endif

@endsection
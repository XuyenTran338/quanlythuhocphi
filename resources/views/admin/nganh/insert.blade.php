@extends('admin/layouts.master')
@section('title','Thêm ngành học')
@section('heading') 
    <i class="fab fa-readme" style="color:#16a291; font-size: 30px"></i>&nbsp;Ngành học
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
        <h5>Thêm ngành học</h5>
    </header>
    <div id="collapseOne" class="body">
        <form action="{{ route('postInsert_majors') }}" method="post" class="form-horizontal">
			<input type="hidden" name="_token" value="{{csrf_token()}}">
			<div class="form-group{{ $errors->has('txtTenNganh') ? ' has-error' : '' }}">
				<label class="control-label col-lg-4">Tên ngành</label>
				<div class="col-lg-4">
					<input type="text" name="txtTenNganh" class="form-control" placeholder="Tên ngành" value="{{ old('txtTenNganh') }}">
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
					<input type="text"  name="txtHe" class="form-control" placeholder="Hệ đào tạo" value="{{ old('txtHe') }}">
				</div>
				@if ($errors->has('txtHe'))
                    <span class="help-block">
                        <strong>{{ $errors->first('txtHe') }}</strong>
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

@endsection
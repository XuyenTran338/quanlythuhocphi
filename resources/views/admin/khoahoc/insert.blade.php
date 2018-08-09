@extends('admin/layouts.master')
@section('title','Thêm khóa học')
@section('heading') 
   <i class="fab fa-leanpub" style="color:#16a291; font-size: 30px"></i>&nbsp;Khóa học
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
        <h5>Thêm khóa học</h5>
    </header>
    <div id="collapseOne" class="body">
        <form action="{{ route('postInsert_course') }}" method="post" class="form-horizontal">
			<input type="hidden" name="_token" value="{{csrf_token()}}">
			<div class="form-group{{ $errors->has('txtKhoaHoc') ? ' has-error' : '' }}">
				<label class="control-label col-lg-4">Tên khóa học</label>
				<div class="col-lg-4">
					<input type="text" name="txtKhoaHoc" class="form-control" placeholder="Khóa 1..." value="{{ old('txtKhoaHoc') }}">
				</div>
				@if ($errors->has('txtKhoaHoc'))
                    <span class="help-block">
                        <strong>{{ $errors->first('txtKhoaHoc') }}</strong>
                    </span>
                @endif
			</div>
			<div class="form-group{{ $errors->has('txtStart') ? ' has-error' : '' }}">
				<label class="control-label col-lg-4">Ngày bắt đầu</label>
				<div class="col-lg-4">
					<input type="date"  name="txtStart" class="form-control" value="{{ old('txtStart') }}">
				</div>
				@if ($errors->has('txtStart'))
                    <span class="help-block">
                        <strong>{{ $errors->first('txtStart') }}</strong>
                    </span>
                @endif
			</div>
			<div class="form-group{{ $errors->has('txtEnd') ? ' has-error' : '' }}">
				<label class="control-label col-lg-4">Ngày kết thúc</label>
				<div class="col-lg-4">
					<input type="date"  name="txtEnd" class="form-control" value="{{ old('txtEnd') }}">
				</div>
				@if ($errors->has('txtEnd'))
                    <span class="help-block">
                        <strong>{{ $errors->first('txtEnd') }}</strong>
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
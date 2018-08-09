@extends('admin/layouts.master')
@section('title','Thêm Lớp học')
@section('heading') 
   <i class="fas fa-book" style="color:#16a291; font-size: 30px"></i>&nbsp;Lớp học
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
        <h5>Thêm Lớp học</h5>
    </header>
    <div id="collapseOne" class="body">
        <form action="{{ route('postInsert_classes') }}" method="post" class="form-horizontal">
			<input type="hidden" name="_token" value="{{csrf_token()}}">
			<div class="form-group{{ $errors->has('txtLop') ? ' has-error' : '' }}">
				<label class="control-label col-lg-4">Tên lớp học</label>
				<div class="col-lg-4">
					<input type="text" name="txtLop" class="form-control" placeholder="Tên lớp" value="{{ old('txtLop') }}">
				</div>
				@if ($errors->has('txtLop'))
                    <span class="help-block">
                        <strong>{{ $errors->first('txtLop') }}</strong>
                    </span>
                @endif
			</div>
			<div class="form-group{{ $errors->has('txtNganhHoc') ? ' has-error' : '' }}">
				<label class="control-label col-lg-4">Ngành học</label>
				<div class="col-lg-4">
					<select class="form-control select2" title="---Chọn ngành học---" data-live-search = "true" name="txtNganhHoc" >
						@foreach($nganh as $obj)
							<option value="{{ $obj->ma_nganh }}" @if(old('txtNganhHoc') == $obj->ma_nganh) selected @endif>
								{{ $obj->ten_nganh }}
							</option>
						@endforeach
					</select>
				</div>
				@if ($errors->has('txtNganhHoc'))
                    <span class="help-block">
                        <strong>{{ $errors->first('txtNganhHoc') }}</strong>
                    </span>
                @endif
			</div>
			<div class="form-group{{ $errors->has('txtKhoa') ? ' has-error' : '' }}">
				<label class="control-label col-lg-4">Khóa học</label>
				<div class="col-lg-4">
					<select class="form-control select2" name="txtKhoa">
						<option value="">---Chọn khóa học---</option>
						@foreach($khoahoc as $obj)
							<option value="{{$obj->ma_khoa_hoc}}" @if(old('txtKhoa') == $obj->ma_khoa_hoc) selected @endif>
								{{$obj->ten_khoa_hoc}}
							</option>
						@endforeach
					</select>
				</div>
				@if ($errors->has('txtKhoa'))
                    <span class="help-block">
                        <strong>{{ $errors->first('txtKhoa') }}</strong>
                    </span>
                @endif
			</div>
			<div class="form-group{{ $errors->has('txtSiSo') ? ' has-error' : '' }}">
				<label class="control-label col-lg-4">Sĩ số</label>
				<div class="col-lg-4">
					<input type="number"  name="txtSiSo" placeholder="Sĩ số" class="form-control" value="{{ old('txtSiSo') }}">
				</div>
				@if ($errors->has('txtSiSo'))
                    <span class="help-block">
                        <strong>{{ $errors->first('txtSiSo') }}</strong>
                    </span>
                @endif
			</div>
			<div class="form-group{{ $errors->has('txtGVCN') ? ' has-error' : '' }}">
				<label class="control-label col-lg-4">Giáo viên chủ nhiệm</label>
				<div class="col-lg-4">
					<select class="form-control select2" name="txtGVCN">
						<option value="">---Chọn tên GVCN---</option>
						<option value="1" @if( old('txtGVCN') ==1 ) selected @endif>Phạm Văn Hiệp</option>
						<option value="2" @if( old('txtGVCN') ==2 ) selected @endif>Nguyễn Thị Nga</option>
						<option value="3" @if( old('txtGVCN') ==3 ) selected @endif>Vũ Thị Lan Anh</option>
						<option value="4" @if( old('txtGVCN') ==4 ) selected @endif>Trần Quốc Tuấn</option>
						<option value="5" @if( old('txtGVCN') ==5 ) selected @endif>Nguyễn Văn Duy</option>
					</select>
				</div>
				@if ($errors->has('txtGVCN'))
                    <span class="help-block">
                        <strong>{{ $errors->first('txtGVCN') }}</strong>
                    </span>
                @endif
			</div>
			<br><br>
           <div align="center"><input type="submit" value="Lưu" class="btn btn-primary" style="width: 100px"></div>

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
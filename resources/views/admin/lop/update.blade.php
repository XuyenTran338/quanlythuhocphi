@extends('admin/layouts.master')
@section('title','Sửa Lớp học')
@section('heading') 
   <i class="fas fa-book" style="color:#16a291; font-size: 30px"></i>&nbsp;Lớp học
@endsection 	 	
@section('content')

<div class="box">
    <header>
        <div class="icons"><i class="fas fa-edit"></i></div>
        <h5>Sửa lớp học</h5>
    </header>
    <div id="collapseOne" class="body">
        <form action="{{ route('postUpdate_classes',$obj->ma_lop) }}" method="post" class="form-horizontal">
			<input type="hidden" name="_token" value="{{csrf_token()}}">
			<div class="form-group{{ $errors->has('txtLop') ? ' has-error' : '' }}">
				<label class="control-label col-lg-4">Tên lớp học</label>
				<div class="col-lg-4">
					<input type="text" name="txtLop" class="form-control" placeholder="Tên lớp" value="{{ $obj->ten_lop }}">
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
					<select class="form-control select2" name="txtNganhHoc">
						<option value="">---Chọn ngành học---</option>
						@foreach($nganh as $value)
							<option value="{{ $value->ma_nganh }}" @if($obj->nganh_ma == $value->ma_nganh) selected @endif>
								{{ $value->ten_nganh }}
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
						@foreach($khoahoc as $value)
							<option value="{{$value->ma_khoa_hoc}}" @if($value->ma_khoa_hoc == $obj->khoa_hoc_ma) selected @endif>
								{{$value->ten_khoa_hoc}}
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
					<input type="number"  name="txtSiSo" placeholder="Sĩ số" class="form-control" value="{{ $obj->si_so }}">
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
						<option value="1" @if( $obj->giao_vien_chu_nhiem ==1 ) selected @endif>Phạm Văn Hiệp</option>
						<option value="2" @if( $obj->giao_vien_chu_nhiem ==2 ) selected @endif>Nguyễn Thị Nga</option>
						<option value="3" @if( $obj->giao_vien_chu_nhiem ==3 ) selected @endif>Vũ Thị Lan Anh</option>
						<option value="4" @if( $obj->giao_vien_chu_nhiem ==4 ) selected @endif>Trần Quốc Tuấn</option>
						<option value="5" @if( $obj->giao_vien_chu_nhiem ==5 ) selected @endif>Nguyễn Văn Duy</option>
					</select>
				</div>
				@if ($errors->has('txtGVCN'))
                    <span class="help-block">
                        <strong>{{ $errors->first('txtGVCN') }}</strong>
                    </span>
                @endif
			</div>
			<div class="form-group{{ $errors->has('rdTrangThai') ? ' has-error' : '' }}">
				<label class="control-label col-lg-4">Trạng thái</label>
				<div class="col-lg-4">
					<input type="radio" name="rdTrangThai" value="1" @if($obj->trang_thai == 1) checked @endif> Còn học
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" name="rdTrangThai" value="0" @if($obj->trang_thai != 1) checked @endif> Kết thúc
				</div>
				@if ($errors->has('rdTrangThai'))
                    <span class="help-block">
                        <strong>{{ $errors->first('rdTrangThai') }}</strong>
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
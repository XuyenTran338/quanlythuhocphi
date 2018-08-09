@extends('admin/layouts.master')
@section('title','Sửa mức thu')
@section('heading') 
    <i class="fas fa-donate" style="color:#16a291; font-size: 30px"></i>&nbsp;Mức thu
@endsection 	 	
@section('content')

<div class="box">
    <header>
        <div class="icons"><i class="fas fa-edit"></i></div>
        <h5>Sửa mức thu</h5>
    </header>
    <div id="collapseOne" class="body">
        <form action="{{ route('postUpdate_fee',$obj->ma_muc_thu) }}" method="post" class="form-horizontal">
			<input type="hidden" name="_token" value="{{csrf_token()}}">
			<div class="form-group{{ $errors->has('txtNganh') ? ' has-error' : '' }}">
				<label class="control-label col-lg-4">Tên ngành</label>
				<div class="col-lg-4">
					<select name="txtNganh" class="form-control">
						<option value="">---Chọn ngành học---</option>
						@foreach($nganh as $value)
							<option value="{{ $value->ma_nganh }}" @if($obj->nganh_ma == $value->ma_nganh) selected @endif>
								{{ $value->ten_nganh }}
							</option>
						@endforeach
					</select>
				</div>
				@if ($errors->has('txtNganh'))
                    <span class="help-block">
                        <strong>{{ $errors->first('txtNganh') }}</strong>
                    </span>
                @endif
			</div>
			<div class="form-group{{ $errors->has('txtHinhThuc') ? ' has-error' : '' }}">
				<label class="control-label col-lg-4">Hình thức nộp(Tỷ lệ giảm %)</label>
				<div class="col-lg-4">
					<select name="txtHinhThuc" class="form-control">
						<option value="">---Chọn khóa học---</option>
						@foreach($hinhthuc as $value)
							<option value="{{$value->ma_hinh_thuc}}" @if($obj->hinh_thuc_ma == $value->ma_hinh_thuc) selected @endif>
								{{$value->ten_hinh_thuc}}_({{$value->ty_le_giam}}%)
							</option>
						@endforeach
					</select>
				</div>
				@if ($errors->has('txtHinhThuc'))
                    <span class="help-block">
                        <strong>{{ $errors->first('txtHinhThuc') }}</strong>
                    </span>
                @endif
			</div>
			<div class="form-group{{ $errors->has('txtMucThu') ? ' has-error' : '' }}">
				<label class="control-label col-lg-4">Mức thu qui định</label>
				<div class="col-lg-4">
					<input type="number" name="txtMucThu" class="form-control" placeholder="Mức thu qui định (VND)" value="{{ $obj->muc_thu_qui_dinh }}">
				</div>
				@if ($errors->has('txtMucThu'))
                    <span class="help-block">
                        <strong>{{ $errors->first('txtMucThu') }}</strong>
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
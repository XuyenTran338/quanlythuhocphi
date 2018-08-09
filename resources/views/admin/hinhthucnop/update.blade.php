@extends('admin/layouts.master')
@section('title','Sửa hình thức')
@section('heading') 
    <i class="fas fa-clipboard-list" style="color:#16a291; font-size: 30px"></i>&nbsp;Hình thức nộp
@endsection 	 	
@section('content')

<div class="box">
    <header>
        <div class="icons"><i class="fas fa-edit"></i></div>
        <h5>Sửa hình thức nộp</h5>
    </header>
    <div id="collapseOne" class="body">
        <form action="{{ route('postUpdate_payment',$obj->ma_hinh_thuc) }}" method="post" class="form-horizontal">
			<input type="hidden" name="_token" value="{{csrf_token()}}">
			<div class="form-group{{ $errors->has('txtHinhThuc') ? ' has-error' : '' }}">
				<label class="control-label col-lg-4">Tên hình thức</label>
				<div class="col-lg-4">
					<input type="text" name="txtHinhThuc" class="form-control" placeholder="Tên hình thức" value="{{ $obj->ten_hinh_thuc }}">
				</div>
				@if ($errors->has('txtHinhThuc'))
                    <span class="help-block">
                        <strong>{{ $errors->first('txtHinhThuc') }}</strong>
                    </span>
                @endif
			</div>
			<div class="form-group{{ $errors->has('txtSoThang') ? ' has-error' : '' }}">
				<label class="control-label col-lg-4">Số tháng phải đóng</label>
				<div class="col-lg-4">
					<input type="number" name="txtSoThang" class="form-control" placeholder="Số tháng phải đóng" value="{{$obj->so_thang }}">
				</div>
				@if ($errors->has('txtSoThang'))
                    <span class="help-block">
                        <strong>{{ $errors->first('txtSoThang') }}</strong>
                    </span>
                @endif
			</div>
			<div class="form-group{{ $errors->has('txtTyLeGiam') ? ' has-error' : '' }}">
				<label class="control-label col-lg-4">Tỷ lệ ưu đãi</label>
				<div class="col-lg-4">
					<input type="text" name="txtTyLeGiam" class="form-control" placeholder="Tỷ lệ ưu đãi (%)" value="{{ $obj->ty_le_giam }}">
				</div>
				@if ($errors->has('txtTyLeGiam'))
                    <span class="help-block">
                        <strong>{{ $errors->first('txtTyLeGiam') }}</strong>
                    </span>
                @endif
			</div>
			<div class="form-group{{ $errors->has('txtNote') ? ' has-error' : '' }}">
				<label class="control-label col-lg-4">Ghi chú</label>
				<div class="col-lg-4">
					<textarea name="txtNote" class="form-control" rows="6">{{ $obj->ghi_chu }}</textarea>
				</div>
				@if ($errors->has('txtNote'))
                    <span class="help-block">
                        <strong>{{ $errors->first('txtNote') }}</strong>
                    </span>
                @endif
			</div>
           <div align="center"><input type="submit" value="Sửa" class="btn btn-primary" style="width: 100px"></div>

        </form>
    </div>
</div>
@endsection
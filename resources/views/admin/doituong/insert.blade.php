@extends('admin/layouts.master')
@section('title','Thêm học bổng')
@section('heading') 
    <i  class="fas fa-gift" style="color:#16a291; font-size: 30px"></i>&nbsp;Học bổng
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
        <h5>Thêm học bổng</h5>
    </header>
    <div id="collapseOne" class="body">
        <form action="{{ route('postInsert_objects') }}" method="post" class="form-horizontal">
			<input type="hidden" name="_token" value="{{csrf_token()}}">
			<div class="form-group{{ $errors->has('txtTenHB') ? ' has-error' : '' }}">
				<label class="control-label col-lg-4">Tên học bổng</label>
				<div class="col-lg-4">
					<input type="text" name="txtTenHB" class="form-control" placeholder="Tên học bổng" value="{{ old('txtTenHB') }}">
				</div>
				@if ($errors->has('txtTenHB'))
                    <span class="help-block">
                        <strong>{{ $errors->first('txtTenHB') }}</strong>
                    </span>
                @endif
			</div>
			<div class="form-group{{ $errors->has('txtTyLeHB') ? ' has-error' : '' }}">
				<label class="control-label col-lg-4">Tỷ lệ học bổng</label>
				<div class="col-lg-4">
					<input type="number"  name="txtTyLeHB" class="form-control" placeholder="Tỷ lệ học bổng(_%)" value="{{ old('txtTyLeHB') }}">
				</div>
				@if ($errors->has('txtTyLeHB'))
                    <span class="help-block">
                        <strong>{{ $errors->first('txtTyLeHB') }}</strong>
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
@extends('admin/layouts.master')
@section('title','Tài khoản cá nhân')
@section('heading') 
    <i class="fas fa-user-circle" style="color:#16a291 ; font-size: 30px"></i>&nbsp;Thông tin cá nhân
@endsection  	
@section('content')

<style type="text/css">
	.box{
	  border-radius: 10px;
	  background-color: white;
	}
</style>
<div class="row box" >
	<div class="col-sm-12" style="padding-bottom: 30px;">
	    <div class="col-sm-4">
	    	<div style="padding-left: 40px; padding-top: 35px">
	    	 	<img class="media-object img-thumbnail user-img" alt="User Picture" src="admin/public/assets/img/{{ $account->image }}" style="border-radius: 10px; " width= "200">
	    	</div>
	    </div>
	    <div class="col-sm-6">
	    	<table class="table">
	    		<caption>Thông tin tài khoản</caption>
	    		<tr>
	    			<th>Tên tài khoản</th>
	    			<td>{{ $account->ten_tai_khoan }}</td>
	    		</tr>
	    		<tr>
	    			<th>Email</th>
	    			<td>{{ $account->email }}</td>
	    		</tr>
	    		<tr>
	    			<th>Họ và tên</th>
	    			<td>{{ $account->ho_ten }}</td>
	    		</tr>
	    		<tr>
	    			<th>Giới tính</th>
	    			<td> 
	    				@if($account->gioi_tinh == 1 )
                            {{ "Nam" }}
                        @else 
                            {{ "Nữ" }}
                        @endif
                    </td>
	    		</tr>
	    		<tr>
	    			<th>Số điện thoại</th>
	    			<td>{{ $account->SDT }}</td>
	    		</tr>
	    	</table>
	    </div>
	    <div class="col-sm-2">
	    	
	    </div>
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
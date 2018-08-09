@extends('admin/layouts.master')
@section('title','Thay đổi mật khẩu')
@section('heading') 
    <i class="fas fa-key" style="color:#16a291 ; font-size: 30px"></i>&nbsp;Đổi mật khẩu
@endsection  	
@section('content')

@if(session('messages'))
    <div class="alert alert-success alert-dismissible fade in">
        {{session('messages')}}
    </div>
@endif
<style type="text/css">
	.box{
	  border-radius: 10px;
	  background-color: white;
	}

</style>
<body onLoad="return reload()">
<div class="row box" >
	<br><br>
	<div class="col-sm-12">
		<div class="col-sm-2"></div>
		<div class="col-sm-8">
			<form action="{{ route('postUpdate_pass',session()->get('user.ma_tai_khoan')) }}" method="post" onSubmit="return Pass()">
				<input type="hidden" name="_token" value="{{csrf_token()}}">
				<div class="form-group">
					<label for="txtUser">Tên tài khoản*</label>
					<input type="text" value="{{ session()->get('user.ten_tai_khoan') }}" disabled class="form-control" name="txtUser">
				</div>
				<div class="form-group">
					<label for="txtPasscu">Mật khẩu cũ*</label>
					<input type="password" class="form-control" name="txtPasscu" placeholder="Mật khẩu cũ" id="PassOld">
					<div class="error" id="errPassOld">
						@if(session('message_error'))
						        {{session('message_error')}}
						@endif
					</div>
				</div>
				<div class="form-group">
					<label for="txtPassNew">Nhập mật khẩu mới*</label>
					<input type="password" class="form-control" name="txtPassNew" placeholder="Mật khẩu mới" id="PassNew">
					<div class="error" id="errPassNew"></div>
				</div>
				<div class="form-group">
					<label for="txtRePassNew">Xác nhận mật khẩu mới*</label>
					<input type="password" class="form-control" name="txtRePassNew" placeholder="Xác nhận mật khẩu mới" id="RePassNew">
					<div class="error" id="errRePassNew"></div>
				</div>
				<div class="form-group">
					<label for="txtCheck" class="control-label col-lg-3">Mã xác nhận*</label>
					<div class="col-sm-3">
						<input type="text" class="form-control" id="check">
						<div class="error" id="errCaptchar"></div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" id="captchar" readonly style="background-color: hsl(0, 0%, 54%); color: white; font-size: 18px">
					</div>
					<div class="col-sm-3"><span onClick="return reload()"><i class="fas fa-sync-alt" style="font-size: 24px; color: blue"></i></span>
					</div>
					
				</div>
				<div class="col-sm-12"><br><br></div>
				<div class="col-lg-12" align="center"><button type="submit" class="btn btn-lg btn-success" style="width: 300px">Đổi mật khẩu</button></div>
				<div class="col-sm-12"><br><br></div>
			</form>
		</div>
		<div class="col-sm-2"></div>
	</div>
</div>
</body>
@endsection

@section('script')

<script type="text/javascript">
	function reload()
	{
		var captchar = Array();
		for(var i=0; i<5; i++)
		{
			captchar[i]=Math.floor(Math.random()*34);
			if(captchar[i]==10) captchar[i]="A";
			if(captchar[i]==11) captchar[i]="B";
			if(captchar[i]==12) captchar[i]="C";
			if(captchar[i]==13) captchar[i]="D";
			if(captchar[i]==14) captchar[i]="E";
			if(captchar[i]==15) captchar[i]="F";
			if(captchar[i]==16) captchar[i]="G";
			if(captchar[i]==17) captchar[i]="H";
			if(captchar[i]==18) captchar[i]="I";
			if(captchar[i]==19) captchar[i]="J";
			if(captchar[i]==20) captchar[i]="K";
			if(captchar[i]==21) captchar[i]="L";
			if(captchar[i]==22) captchar[i]="M";
			if(captchar[i]==23) captchar[i]="N";
			if(captchar[i]==24) captchar[i]="O";
			if(captchar[i]==25) captchar[i]="P";
			if(captchar[i]==26) captchar[i]="Q";
			if(captchar[i]==27) captchar[i]="R";
			if(captchar[i]==28) captchar[i]="S";
			if(captchar[i]==29) captchar[i]="T";
			if(captchar[i]==30) captchar[i]="U";
			if(captchar[i]==31) captchar[i]="V";
			if(captchar[i]==32) captchar[i]="W";
			if(captchar[i]==33) captchar[i]="X";
			if(captchar[i]==32) captchar[i]="Y";
			if(captchar[i]==33) captchar[i]="Z";
			
		}
		document.getElementById("captchar").value=captchar.join("");
	}
	//---------------------------------------------------------------
	function Pass()
	{
		var validate=true;
		var passold = document.getElementById("PassOld").value;
		var passnew = document.getElementById("PassNew").value;
		var errpassold=document.getElementById("errPassOld");
		var errpassnew=document.getElementById("errPassNew");
		var repassnew = document.getElementById("RePassNew").value;
		var errrepassnew=document.getElementById("errRePassNew");
		//passold
		var regpassold=/^[A-Za-z0-9_.!@#$%^&*()><=]{6,32}$/;
		var kqPassold = regpassold.test(passold);
			if(passold.length==0){
				errpassold.innerHTML="Vui lòng nhập Mật khẩu cũ!";
				validate=false;
			}else if(passold.length < 8){
				errpassold.innerHTML="Mật khẩu phải ít nhất 8 kí tự gồm số, chữ!";
				validate=false;
			}else if(kqPassold==false){
				errpassold.innerHTML="Vui lòng nhập Mật khẩu đúng định dạng!";
				validate=false;
			}else{
				errpassold.innerHTML="";
			}
		//passnew
		var regpassnew=/^[A-Za-z0-9_.!@#$%^&*()><=]{6,32}$/;
		var kqPassnew = regpassnew.test(passnew);
			if(passnew.length==0){
				errpassnew.innerHTML="Vui lòng nhập Mật khẩu Mới!";
				validate=false;
			}else if(passnew.length < 8){
				errpassnew.innerHTML="Mật khẩu phải ít nhất 8 kí tự gồm số, chữ!";
				validate=false;
			}else if(kqPassnew==false){
				errpassnew.innerHTML="Vui lòng nhập Mật khẩu đúng định dạng!";
				validate=false;
			}else{
				errpassnew.innerHTML="";
			}
		//RePassNew
		if(repassnew.length==0){
		errrepassnew.innerHTML="Vui lòng xác nhận mật khẩu mới!";
		validate=false;
		}else if(repassnew != passnew){
			errrepassnew.innerHTML="*Mật khẩu mới không khớp!";
			validate=false;
		}else{
			 errrepassnew.innerHTML="";
		}
		//Capthchar
		var check=document.getElementById("check").value;
		var captchar = document.getElementById("captchar").value;
		var errcaptchar = document.getElementById("errCaptchar");
		if(check.length==0){
			errcaptchar.innerHTML="Xin vui lòng nhập mã xác nhận!";
			reload();
			validate=false;
		}else if(captchar!=check){
			errcaptchar.innerHTML="Mã xác nhận không khớp! Vui lòng thử lại";
			reload();
			validate=false;
		}else{
			errcaptchar.innerHTML="";
		}
		return validate;
	}
</script>

@endsection
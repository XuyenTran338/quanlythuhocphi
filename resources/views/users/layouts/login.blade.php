<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
    <!-- bootstrap link -->
    <base href="{{ asset('') }}">
    <link rel='shortcut icon' type='image/x-icon' href="{{ asset('user/public/img/logo_bakcad.png') }}" />

    <!-- Font-family -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Encode+Sans+Expanded">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('admin/public/assets/lib/bootstrap/css/bootstrap.css')}}">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">

</head>
<style type="text/css">
    body{
        background-image: url('admin/public/assets/img/pattern/rip_jobs.png');
    }
</style>
<body style="font-family: 'Encode Sans Expanded', sans-serif;">
<div class="container">
        <nav class="navbar navbar-inverse navbar-static-top" style="background-color: #16a291; border-color:#16a291 ">
        <!-- begin container-fluid -->
        <div style="font-size: 30px;  ">
            <a href="" style="line-height: 20px;color: white; text-decoration: none; padding-left: 30px"><i class="fas fa-cubes"></i>&nbsp;Quản lý thu học phí</a>
          <!-- begin topnav -->
          <div class="topnav">
              
          </div>
          
        </div>
        <!-- end container-fluid -->
        </nav>
    <div class="row">
        <div class="col-md-6 col-md-offset-3" style="margin-top: 100px">
            <div class="panel">
                <div class="panel-heading" style="font-size: 20px; background-color: #16a291; color: white"><i class="fas fa-user"></i> &nbsp;Đăng nhập</div>

                <div class="panel-body">
                    @if(session('message_error'))
                        <div class="alert alert-danger alert-dismissible fade in">
                            {{session('message_error')}}
                        </div>
                    @endif
                    @if(session('message'))
                        <div class="alert alert-success alert-dismissible fade in">
                            {{session('message')}}
                        </div>
                    @endif
                    <form class="form-horizontal" method="POST" action="{{ route('post_login_user') }}">
                     {!! csrf_field() !!}
                        <div class="form-group{{ $errors->has('txtEmail') ? ' has-error' : '' }}">
                            <div class="col-md-8 col-md-offset-2 input-group">
                            	<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                <input id="email" type="email" class="form-control" name="txtEmail" 
                                {{ isset($email) ? 'value = '.$email.'' : '' }} placeholder="Email" value="{{ old('txtEmail') }}">
                            </div>
                            <div class="col-md-8 col-md-offset-2">
	                            @if ($errors->has('txtEmail'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('txtEmail') }}</strong>
	                                    </span>
	                            @endif
	                        </div>
                        </div>

                        <div class="form-group{{ $errors->has('txtPass') ? ' has-error' : '' }}">
                            <div class="col-md-8 col-md-offset-2 input-group">
                            	<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input id="password" type="password" class="form-control" placeholder="Password" name="txtPass"
                                 {{ isset($password) ? 'value = '.$password.'' : '' }} >    
                            </div>
                            <div class="col-md-8 col-md-offset-2">
	                            @if ($errors->has('txtPass'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('txtPass') }}</strong>
	                                    </span>
	                            @endif
                       		</div>
                        </div>
                        
                         <div class="form-group">
                            <div class="col-md-8 col-md-offset-2">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ isset($email) ? 'checked' : '' }}> Ghi nhớ
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-12" style="text-align: center;">
                                <button type="submit" class="btn btn-primary" style="width: 100px;">
                                    <i class="fas fa-sign-in-alt"></i> &nbsp;Login
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

    <!--jQuery -->
    <script src="assets/lib/jquery/jquery.js"></script>

    <!--Bootstrap -->
    <script src="assets/lib/bootstrap/js/bootstrap.js"></script>
</body>
</html>
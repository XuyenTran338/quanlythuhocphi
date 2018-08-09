<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\TaiKhoanModel;
use Carbon\Carbon;
class LoginController extends Controller
{
    public function getlogin(Request $request)
    {
        $email      = $request->cookie('email');
        $password   = $request->cookie('password');
        if(session()->has('user')) 
        {
            return redirect()->route('home');
        }else
        {
            return view('admin.layouts.login',['email' => $email, 'password' => $password]);
        }
    }

   public function postlogin(LoginRequest $request)
    {
        $email=$request->txtEmail;
        $password=$request->txtPass;  

        $username=TaiKhoanModel::select()->where('email',$email)->where('phan_quyen',1)->first();
        $check= TaiKhoanModel::selectRaw('count(*) as total')->where('email', $email)->where('phan_quyen',1)->first();
        if(intval($check->total) > 0)
        {
            $getPass=TaiKhoanModel::select('mat_khau')->where('email',$email)->first();
            if(password_verify($password, $getPass->mat_khau)) /*password_verify ( chuỗi $password , chuỗi $hash )*/
            {
                if(isset($request->remember))
                {
                // Lưu cookie 
                $minutes = time()+3600;
                $email_cookie = cookie('email', $email, $minutes);
                $password_cookie = cookie('password', $password, $minutes);

                session()->put('user',$username);
                /*echo(session()->get('user.ten_tai_khoan'));*/
                return redirect()->route('home')->withCookie($email_cookie)->withCookie($password_cookie);
                }else
                {
                    session()->put('user',$username);
                    return redirect()->route('home');
                }
            }else
            {
                return redirect()->route('login')->with('message_error','Tài khoản email không tồn tại hoặc mật khẩu không đúng! Vui lòng đăng nhập lại!');  
            }
        }else
        {
            return redirect()->route('login')->with('message_error','Tài khoản email không tồn tại hoặc mật khẩu không đúng! Vui lòng đăng nhập lại!');  
        }
    	/*$email=$request->txtEmail;
    	$pass=$request->txtPass;*/
    	//$data=bkc08_model::except(array('_token'));

    	/*if(Auth::attempt(['email' => $email,'password' => $pass]))
    	{
    		return redirect('admin/list');
    	}
    	else
    	{
    		return redirect('login')->with('message_error','Tài khoản email không tồn tại hoặc mật khẩu không đúng! Vui lòng đăng nhập lại!');	
    	}*/
    }

    public function getlogout()
    {
    	/*Auth::logout();*/
        if(session()->has('user'))
        {
            $username=session()->get('user.ten_tai_khoan');
            Carbon::setLocale('vi');
            $last_access=Carbon::now();
            TaiKhoanModel::where('ten_tai_khoan',$username)->update(['lan_truy_cap_cuoi' => $last_access]);
            session()->forget('user');
            return  redirect()->route('login');
        }
        
    }
}

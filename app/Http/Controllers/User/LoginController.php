<?php

namespace App\Http\Controllers\User;

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
        $email      = $request->cookie('email_user');
        $password   = $request->cookie('password_user');
        if(session()->has('users')) 
        {
            return redirect()->route('index');
        }else
        {
            return view('users.layouts.login',['email' => $email, 'password' => $password]);
        }
    }

   public function postlogin(LoginRequest $request)
    {
        $email=$request->txtEmail;
        $password=$request->txtPass;  

        $username=TaiKhoanModel::select()->where('email',$email)->where('phan_quyen',2)->first();
        $check= TaiKhoanModel::selectRaw('count(*) as total')->where('email', $email)->where('phan_quyen',2)->first();
        if(intval($check->total) > 0)
        {
            $getPass=TaiKhoanModel::select('mat_khau')->where('email',$email)->first();
            if(password_verify($password, $getPass->mat_khau)) /*password_verify ( chuỗi $password , chuỗi $hash )*/
            {
                if(isset($request->remember))
                {
                // Lưu cookie 
                $minutes = time()+3600;
                $email_cookie = cookie('email_user', $email, $minutes);
                $password_cookie = cookie('password_user', $password, $minutes);

                session()->put('users',$username);
                return redirect()->route('index')->withCookie($email_cookie)->withCookie($password_cookie);
                }else
                {
                    session()->put('users',$username);
                    return redirect()->route('index');
                }
            }else
            {
                return redirect()->route('login_user')->with('message_error','Tài khoản email không tồn tại hoặc mật khẩu không đúng! Vui lòng đăng nhập lại!');  
            }
        }else
        {
            return redirect()->route('login_user')->with('message_error','Tài khoản email không tồn tại hoặc mật khẩu không đúng! Vui lòng đăng nhập lại!');  
        }

    }

    public function getlogout()
    {
    	/*Auth::logout();*/
        if(session()->has('users')) 
        {
            $username=session()->get('users.ten_tai_khoan');
            Carbon::setLocale('vi');
            $last_access=Carbon::now();
            TaiKhoanModel::where('ten_tai_khoan',$username)->update(['lan_truy_cap_cuoi' => $last_access]);
            session()->forget('users');
            return  redirect()->route('login_user');
        }
        
    }
}


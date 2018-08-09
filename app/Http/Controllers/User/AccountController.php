<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TaiKhoanModel;
use Validator;
class AccountController extends Controller
{
    public function get_user()
    {
    	/*$id=session()->get('users.ma_tai_khoan');*/
    	$list_user=TaiKhoanModel::getAll(0);
   		return view('users.taikhoan.list_user',['list_user' => $list_user]);
    }

    public function get_pass()
    {
    	return view('users.taikhoan.change_pass');
    }

    public function post_pass(Request $request,$id)
    {
        $obj= new TaiKhoanModel();

        $obj->ma_tai_khoan  =   $id;
        $obj->mat_khau      =   $request->txtPassNew;

        $pass_old = $request->txtPasscu;

        $getPass=TaiKhoanModel::select('mat_khau')->where('ma_tai_khoan',$id)->first();

        if(password_verify($pass_old, $getPass->mat_khau)) /*password_verify ( chuỗi $password , chuỗi $hash )*/
        {
            TaiKhoanModel::update_pass($obj);
            session()->forget('users');
            return  redirect()->route('login_user')->with('message','Bạn đã đổi mật khẩu thành công! Hãy đăng nhập lại để xác thực có phải là bạn? :)');
        }else
        {
            return redirect()->route('get_pass',$id)->with('message_error','Mật khẩu không đúng! Xin vui lòng nhập lại');  
        }
    }

    public function get_acc($id)
    {
        $account=TaiKhoanModel::select()->where('ma_tai_khoan',$id)->first();
        return view('admin.personal_account.view',['account' => $account]);
    }

    public function check_update(Request $request,$id)
    {
    	$validation = Validator::make($request->all(),
            [
                'txtTenTK'   => 'unique:tbl_taikhoan,ten_tai_khoan,'.$id.',ma_tai_khoan',
            	'txtEmail'  => 'email|unique:tbl_taikhoan,email,'.$id.',ma_tai_khoan',
            ],
            [
    
                'txtTenTK.unique'   => 'Vui lòng nhập lại tên tài khoản!',
                'txtEmail.unique'   => 'Địa chỉ đã tồn tại!Vui lòng nhập lại email!',
                'txtEmail.email'    => 'Email không đúng định dạng'
            ]
        );

        $error_array=array();

        if($validation->fails())
        {
            foreach ($validation->messages()->getMessages() as $field_name => $messages) {
                $error_array[]=$messages;
            }
            return response()->json(['error' => $error_array]);
        }else
        {
        	return response()->json(['error' => $error_array]);
        }
    }
    public function post_account(Request $request,$id)
    {
    	$obj=new TaiKhoanModel();
        $obj->ma_tai_khoan  =   $id;
        $obj->ten_tai_khoan =   $request->txtTenTK;
        $obj->email         =   $request->txtEmail;
        $obj->phan_quyen	=	session()->get('users.phan_quyen');
        $obj->ho_ten        =   $request->txtTen;
        $obj->gioi_tinh     =   $request->rdSex;
        $obj->SDT           =   $request->txtSDT;

        if($request->hasFile('txtFile'))
        {
            $file=$request->file('txtFile');
            // Delete ảnh cũ
            $anhcu=$request->txtAnhCu;
            if(file_exists(public_path().'admin/public/assets/img/'.$anhcu))
            {
                File::delete(public_path().'admin/public/assets/img/'.$anhcu);
            }

            $anh=time().'_'.$file->getClientOriginalName();
            $file->move('admin/public/assets/img/',$anh);
            $obj->image=$anh;

        }else
        {
            $obj->image=$request->txtAnhCu;
        }

        TaiKhoanModel::updateUsers($obj);

        $username=TaiKhoanModel::select()->where('ma_tai_khoan',$id)->first();
        session()->put('users',$username);
        return redirect()->route('index')->with('messages','Sửa thông tin tài khoản thành công');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TaiKhoanModel;
use App\Http\Requests\AccountRequest;
use App\Http\Requests\AccountEditRequest;
use File;
use Validator;
class AccountController extends Controller
{
    public function get_user()
    {
        $id=session()->get('user.ma_tai_khoan');
    	$list_user=TaiKhoanModel::getAll($id);
    	return view('admin.users.list',['list_user' => $list_user]);
    }

    public function get_insert()
    {
    	return view('admin.users.insert');
    }

    public function post_insert(AccountRequest $request)
    {
    	$obj=new TaiKhoanModel();
        $max_id=TaiKhoanModel::getID();

        $obj->ma_tai_khoan	=	$max_id;
    	$obj->email 		=	$request->txtEmail;
    	$obj->ten_tai_khoan	=	$request->txtUser;
        $obj->mat_khau		=	$request->txtPass;
        $obj->phan_quyen	=	$request->txtLevel;
        $obj->ho_ten 		=	$request->txtTen;
        $obj->gioi_tinh     =   $request->rdSex;
        $obj->SDT           =   $request->txtSDT;

        if($request->hasFile('txtFile'))
        {
            $file=$request->file('txtFile');
            $exten=$file->getClientOriginalExtension();
            if($exten != 'jpg' && $exten != 'png' && $exten != 'gif' && $exten!='jepg')
            {
                return redirect()->route('getInsert_user')->with('error_anh',"Đuôi file ảnh không đúng định dạng, vui lòng chọn lại!");
            }
            $anh=time().'_'.$file->getClientOriginalName();
            $file->move('admin/public/assets/img/',$anh);
            $obj->image=$anh;

        }else {
            $obj->image="";
        }
        /*$obj->save();*/

    	TaiKhoanModel::insert($obj);

    	return redirect()->route('getInsert_user')->with('messages','Thêm tài khoản thành công');
    }

    public function get_update($id)
    {
    	$obj=TaiKhoanModel::getByID($id);
        $list_distinct=TaiKhoanModel::get_distinct();

        $phan_quyen=TaiKhoanModel::select('phan_quyen')->where('ma_tai_khoan',$id)->first();
        if((session()->get('user.phan_quyen')!=1) ||($phan_quyen->phan_quyen == 1 && session()->get('user.ma_tai_khoan')!=$id))
        {
            return redirect()->route('list_user')->with('messages_error','Bạn không được phép sửa thành viên này');
        }else
        {
            return view('admin.users.update',['obj' => $obj,'list_distinct' => $list_distinct]);
        }
    }

    public function post_update(AccountEditRequest $request,$id)
    {
    	$obj=new TaiKhoanModel();
        $obj->ma_tai_khoan	=	$id;
    	$obj->email 		=	$request->txtEmail;
    	$obj->ten_tai_khoan	=	$request->txtUser;
        $obj->phan_quyen	=	$request->txtLevel;
        $obj->ho_ten 		=	$request->txtTen;
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

            $exten=$file->getClientOriginalExtension();
            if($exten != 'jpg' && $exten != 'png' && $exten != 'gif' && $exten!='jepg')
            {
                return redirect()->route('getInsert_user')->with('error_anh',"Đuôi file ảnh không đúng định dạng, vui lòng chọn lại!");
            }
            $anh=time().'_'.$file->getClientOriginalName();
            $file->move('admin/public/assets/img/',$anh);
            $obj->image=$anh;

        }else
        {
            $obj->image=$request->txtAnhCu;
        }

    	TaiKhoanModel::updateUsers($obj);
        if(session()->get('user.ma_tai_khoan')==$id)
        {
            $username=TaiKhoanModel::select()->where('ma_tai_khoan',$id)->first();
            session()->put('user',$username);
            return redirect()->route('list_user')->with('messages','Sửa tài khoản thành công');
        }else
        {
            return redirect()->route('list_user')->with('messages','Sửa tài khoản thành công');
        }
        
    }

    public function get_delete($id)
    {
        $phan_quyen=TaiKhoanModel::select('phan_quyen')->where('ma_tai_khoan',$id)->first();
        if((session()->get('user.phan_quyen')!=1) ||($phan_quyen->phan_quyen == 1 && session()->get('user.ma_tai_khoan')!=$id))
        {
            return redirect()->route('list_user')->with('messages_error','Bạn không được phép xóa thành viên này');
        }else
        {
        	TaiKhoanModel::deleteUsers($id);
        	return redirect()->route('list_user')->with('messages','Xóa tài khoản thành công');
        }
    }


    // Personal account
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
                'txtEmail.email'    => 'Email không đúng định dạng',
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
        $obj->phan_quyen    =   session()->get('user.phan_quyen');
        $obj->email         =   $request->txtEmail;
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

           /* $exten=$file->getClientOriginalExtension();
            if($exten != 'jpg' && $exten != 'png' && $exten != 'gif' && $exten!='jepg')
            {
                return redirect()->route('getInsert_user')->with('error_anh',"Đuôi file ảnh không đúng định dạng, vui lòng chọn lại!");
            }*/
            $anh=time().'_'.$file->getClientOriginalName();
            $file->move('admin/public/assets/img/',$anh);
            $obj->image=$anh;

        }else
        {
            $obj->image=$request->txtAnhCu;
        }

        TaiKhoanModel::updateUsers($obj);

        $username=TaiKhoanModel::select()->where('ma_tai_khoan',$id)->first();
        session()->put('user',$username);
        return redirect()->route('view_user',$id)->with('messages','Sửa thông tin tài khoản thành công');
    }

    public function get_pass($id)
    {
        return view('admin.personal_account.change_pass');
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
            session()->forget('user');
            return  redirect()->route('login')->with('message','Bạn đã đổi mật khẩu thành công! Hãy đăng nhập lại để xác thực có phải là bạn? :)');
        }else
        {
            return redirect()->route('getUpdate_pass',$id)->with('message_error','Mật khẩu không đúng! Xin vui lòng nhập lại');  
        }
        
    }
}

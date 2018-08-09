<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KhoaHocModel;
use App\Http\Requests\CourseRequest;
use App\Http\Requests\CourseEditRequest;
class CourseController extends Controller
{
    public function get_course()
    {
    	$khoahoc=KhoaHocModel::getAll();
    	return view('admin.khoahoc.list',['khoahoc' => $khoahoc]);
    }

    public function get_insert()
    {
    	return view('admin.khoahoc.insert');
    }

    public function post_insert(CourseRequest $request)
    {
    	$obj=new KhoaHocModel();

        $obj->ma_khoa_hoc	=	KhoaHocModel::getID();
    	$obj->ten_khoa_hoc 	=	$request->txtKhoaHoc;
    	$obj->ngay_bat_dau	=	$request->txtStart;
    	$obj->ngay_ket_thuc	=	$request->txtEnd;

        /*$obj->save();*/

    	KhoaHocModel::insert($obj);

    	return redirect()->route('getInsert_course')->with('messages','Thêm khóa học thành công');
    }

    public function get_update($id)
    {
    	$obj=KhoaHocModel::getByID($id);
       /* $user=session()->get('user');
        $data_session=bkc08_model::select('id','level')->where('username',$user)->first();
        if(($data_session->level!=0) &&($id == 1 || ($data->get('level') == 0 && $data_session->id!=$id)))
        {
            return redirect()->route('list')->with('errupdate','Bạn không được phép sửa thành viên này');
        }*/
    	return view('admin.khoahoc.update',['obj' => $obj]);
    }

    public function post_update(CourseEditRequest $request,$id)
    {
    	$obj=new KhoaHocModel();
    	$obj->ma_khoa_hoc	=	$id;
    	$obj->ten_khoa_hoc 	=	$request->txtKhoaHoc;
    	$obj->ngay_bat_dau	=	$request->txtStart;
    	$obj->ngay_ket_thuc	=	$request->txtEnd;
        $check=KhoaHocModel::where('ten_khoa_hoc','like',$obj->ten_khoa_hoc)->where('ma_khoa_hoc','<>',$id)->count();
        $check2=KhoaHocModel::where('ngay_bat_dau','like',$obj->ngay_bat_dau)->where('ma_khoa_hoc','<>',$id)->count();
        $check3=KhoaHocModel::where('ngay_ket_thuc','like',$obj->ngay_ket_thuc)->where('ma_khoa_hoc','<>',$id)->count();
                        
        if($check >0 || $check2 > 0 || $check3 > 0)
        {
            return redirect()->route('getUpdate_course',$id)->with('messages_error','Tên khóa hay ngày bắt đầu hoặc ngày kết thúc có vẻ đã trùng');
        }else {
            KhoaHocModel::updateKhoaHoc($obj);
            return redirect()->route('list_course')->with('messages','Sửa khóa thành công');
        }
    	
    }

    public function get_delete($id)
    {
    	KhoaHocModel::deleteKhoaHoc($id);
    	return redirect()->route('list_course')->with('messages','Xóa khóa thành công');
    }
}

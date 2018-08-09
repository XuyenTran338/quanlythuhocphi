<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LopModel;
use App\Models\NganhModel;
use App\Models\KhoaHocModel;
use App\Http\Requests\ClassRequest;
use App\Http\Requests\ClassEditRequest;
class ClassesController extends Controller
{
    public function get_class()
    {
    	$lop=LopModel::getAll();
    	return view('admin.lop.list',['lop' => $lop]);
    }

    public function get_insert()
    {
    	$nganh=NganhModel::getAll();
    	$khoahoc=KhoaHocModel::getAll();
    	return view('admin.lop.insert',['nganh' => $nganh,'khoahoc' => $khoahoc]);
    }

    public function post_insert(ClassRequest $request)
    {
    	$obj=new LopModel();
    	$max_id=LopModel::getID();

    	$obj->ma_lop 				=	$max_id;
    	$obj->ten_lop				=	$request->txtLop;
    	$obj->si_so					=	$request->txtSiSo;
    	$obj->giao_vien_chu_nhiem	=	$request->txtGVCN;
    	$obj->nganh_ma				=	$request->txtNganhHoc;
    	$obj->khoa_hoc_ma			=	$request->txtKhoa;
        
    	LopModel::insert($obj);
    	return redirect()->route('getInsert_classes')->with('messages','Thêm lớp học thành công');
    }

    public function get_update($id)
    {
    	$nganh=NganhModel::getAll();
    	$khoahoc=KhoaHocModel::getAll();
    	$obj=LopModel::getByID($id);
    	return view('admin.lop.update',['obj' => $obj,'nganh' => $nganh,'khoahoc' => $khoahoc]);
    }

    public function post_update(ClassEditRequest $request,$id)
    {
    	$obj=new LopModel();
    	$obj->ma_lop 				=	$id;
    	$obj->ten_lop				=	$request->txtLop;
    	$obj->si_so					=	$request->txtSiSo;
    	$obj->giao_vien_chu_nhiem	=	$request->txtGVCN;
        $obj->trang_thai            =   $request->rdTrangThai;
    	$obj->nganh_ma				=	$request->txtNganhHoc;
    	$obj->khoa_hoc_ma			=	$request->txtKhoa;
        $check=LopModel::where('ten_lop','like',$obj->ten_lop)->where('ma_lop','<>',$id)->count();
        if($check > 0 )
        {
            return redirect()->route('getUpdate_classes',$id)->with('messages_error','Tên lớp học đã tồn tại');
        }else {
            LopModel::updateLop($obj);
            return redirect()->route('list_classes')->with('messages','Sửa lớp học thành công');  
        }
    	
    }

    public function get_delete($id)
    {
    	LopModel::deleteLop($id);
    	return redirect()->route('list_classes')->with('messages','Xóa lớp học thành công');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\NganhModel;
use App\Models\KhoaHocModel;
use App\Models\LopModel;
use App\Models\SinhVienModel;
use App\Models\HocBongModel;
use App\Models\MucThuModel;
use App\Http\Requests\StudentRequest;
use App\Http\Requests\StudentEditRequest;
class StudentsController extends Controller
{
    public function get_student()
    {
        $nganh   = NganhModel::getAll();
    	$sinhvien=SinhVienModel::getAll();
    	return view('admin.sinhvien.list',['sinhvien' => $sinhvien,'nganh' => $nganh]);
    }

    public function get_insert()
    {
        $nganh     =  NganhModel::getAll();
    	$doituong  =  HocBongModel::getAll();
    	return view('admin.sinhvien.insert',['doituong' => $doituong,'nganh' => $nganh]);
    }

    public function post_insert(StudentRequest $request)
    {
    	$obj=new SinhVienModel();
    	$max_id=SinhVienModel::getID();

    	$obj->ma_sinh_vien     = $max_id;
        $obj->ten_sinh_vien    = $request->txtTen;
        $obj->ngay_sinh        = $request->txtBirth;
        $obj->email            = $request->txtEmail;
        $obj->gioi_tinh        = $request->rdSex;
        $obj->sdt              = $request->txtSDT;
        $obj->dia_chi          = $request->txtAdd;
        $obj->trang_thai       = 1;
        $obj->hoc_bong_ma      = $request->sltHB;
        $obj->lop_ma           = $request->sltLop;
        $obj->muc_thu_ma       = $request->sltMucThu;

    	SinhVienModel::insert_SV($obj);
    	return redirect()->route('getInsert_students')->with('messages','Thêm sinh viên thành công');
    }

    public function get_update($id)
    {
    $trang_thai  =   SinhVienModel::get_distinct();
    $nganh       =   NganhModel::getAll();
    $khoahoc     =   KhoaHocModel::getAll();
    $doituong    =   HocBongModel::getAll();
    $obj         =   SinhVienModel::getByID($id);

    $ma_khoa_hoc =   $obj->ma_khoa_hoc;
    $ma_nganh    =   $obj->ma_nganh;
    $ma_lop      =   $obj->lop_ma;
    $lop         =   LopModel::distinct_Lop($ma_nganh,$ma_khoa_hoc);
    $muc_thu     =   MucThuModel::get_MucThu_Nganh($ma_nganh);
	
    	
    	return view('admin.sinhvien.update',['obj' => $obj,'lop' => $lop,'doituong' => $doituong,'trang_thai' => $trang_thai,'nganh' => $nganh,'khoahoc' => $khoahoc,'muc_thu' => $muc_thu]);
    }

    public function post_update(StudentEditRequest $request,$id)
    {
    	$obj=new SinhVienModel();
    	$obj->ma_sinh_vien     = $id;
        $obj->ten_sinh_vien    = $request->txtTen;
        $obj->ngay_sinh        = $request->txtBirth;
        $obj->email            = $request->txtEmail;
        $obj->gioi_tinh        = $request->rdSex;
        $obj->sdt              = $request->txtSDT;
        $obj->dia_chi          = $request->txtAdd;
        $obj->trang_thai       = $request->rdTrangthai;
        $obj->hoc_bong_ma      = $request->sltHB;
        $obj->muc_thu_ma       = $request->sltMucThu;
    	SinhVienModel::updateSV($obj);
    	return redirect()->route('getUpdate_students',$id)->with('messages','Sửa sinh viên thành công');
    }

    public function get_delete($id)
    {
    	SinhVienModel::deleteSV($id);
    	return redirect()->route('list_students')->with('messages','Xóa sinh viên thành công');
    }

    
}

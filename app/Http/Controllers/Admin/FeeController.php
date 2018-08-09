<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MucThuModel;
use App\Models\NganhModel;
use App\Models\HinhThucModel;
use App\Models\PhieuThuModel;
use App\Http\Requests\FeeRequest;
use App\Http\Requests\FeeEditRequest;
class FeeController extends Controller
{
    public function get_fee()
    {
    	$hinhthuc=MucThuModel::getAll();
    	return view('admin.mucthu.list',['hinhthuc' => $hinhthuc]);
    }

    public function get_insert()
    {
    	$nganh=NganhModel::getAll();
    	$hinhthuc=HinhThucModel::getAll();
    	return view('admin.mucthu.insert',['nganh' => $nganh, 'hinhthuc' => $hinhthuc]);
    }

    public function post_insert(FeeRequest $request)
    {
    	$obj=new MucThuModel();
    	$max_id=MucThuModel::getID();

    	$obj->ma_muc_thu		=	$max_id;
        $obj->nganh_ma			=	$request->txtNganh;
        $obj->hinh_thuc_ma		=	$request->txtHinhThuc;
        $obj->muc_thu_qui_dinh  =   $request->txtMucThu;

        $check=MucThuModel::check_muc_thu($obj->nganh_ma,$obj->hinh_thuc_ma);
        if($check != 0)
        {
            return redirect()->route('getInsert_fee')->with('messages_error','Tên ngành và hình thức nộp đã tồn tại! Vui lòng nhập lại!');
        }else
        {
            MucThuModel::insert($obj);
            return redirect()->route('getInsert_fee')->with('messages','Thêm mức thu thành công');
        }
    }

    public function get_update($id)
    {
        $obj=MucThuModel::getByID($id);
        $check=PhieuThuModel::get_hinh_thuc($obj->hinh_thuc_ma);
        if(count($check) >  0)
        {
            return back()->with('messages_error','Bạn khổng thể sửa mức thu');
        }else {
        	$nganh=NganhModel::getAll();
        	$hinhthuc=HinhThucModel::getAll();
        	return view('admin.mucthu.update',['obj' => $obj,'nganh' => $nganh, 'hinhthuc' => $hinhthuc]);
        }
    }

    public function post_update(FeeEditRequest $request,$id)
    {
    	$obj=new MucThuModel();
    	$obj->ma_muc_thu		=	$id;
        $obj->nganh_ma          =   $request->txtNganh;
        $obj->hinh_thuc_ma      =   $request->txtHinhThuc;
        $obj->muc_thu_qui_dinh  =   $request->txtMucThu;
    	
        $check=MucThuModel::select("SELECT * from tbl_mucthu where nganh_ma='$obj->nganh_ma' and hinh_thuc_ma='$obj->hinh_thuc_ma' and ma_muc_thu <> '$obj->ma_muc_thu'");
        $count=count($check);

        if($count > 0)
        {
        	return redirect()->route('getUpdate_fee',$id)->with('messages_error','Tên ngành và hình thức nộp đã tồn tại! Vui lòng nhập lại!');
        }else
        {
            MucThuModel::updateMT($obj);
            return redirect()->route('list_fee')->with('messages','Sửa mức thu thành công');
        }

    }

    public function get_delete($id)
    {
        $obj=MucThuModel::getByID($id);
        $check=PhieuThuModel::get_hinh_thuc($obj->hinh_thuc_ma);
        if(count($check) >  0)
        {
            return back()->with('messages_error','Bạn khổng thể xóa mức thu');
        }else {
        	MucThuModel::deleteMT($id);
        	return redirect()->route('list_fee')->with('messages','Xóa mức thu thành công');
        }
    }
}

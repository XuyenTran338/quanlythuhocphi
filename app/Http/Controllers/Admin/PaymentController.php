<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\HinhThucModel;
use App\Models\PhieuThuModel;
use App\Http\Requests\PaymentRequest;
use App\Http\Requests\PaymentEditRequest;
class PaymentController extends Controller
{
    public function get_payment()
    {
    	$hinhthuc=HinhThucModel::getAll();
    	return view('admin.hinhthucnop.list',['hinhthuc' => $hinhthuc]);
    }

    public function get_insert()
    {
    	return view('admin.hinhthucnop.insert');
    }

    public function post_insert(PaymentRequest $request)
    {
    	$obj=new HinhThucModel();
    	$max_id=HinhThucModel::getID();

    	$obj->ma_hinh_thuc	=	$max_id;
    	$obj->ten_hinh_thuc	=	$request->txtHinhThuc;
    	$obj->so_thang		=	$request->txtSoThang;
    	$obj->ty_le_giam	=	$request->txtTyLeGiam;
    	$obj->ghi_chu		=	$request->txtNote;

    	HinhThucModel::insert($obj);
    	return redirect()->route('getInsert_payment')->with('messages','Thêm hình thức thanhd công');
    }

    public function get_update($id)
    {
        $check=PhieuThuModel::get_hinh_thuc($id);
        if(count($check) >  0)
        {
            return back()->with('messages_error','Bạn khổng thể sửa hình thức');
        }else {
            $obj=HinhThucModel::getByID($id);
            return view('admin.hinhthucnop.update',['obj' => $obj]);
        }
    }

    public function post_update(PaymentEditRequest $request,$id)
    {
    	$obj=new HinhThucModel();
    	$obj->ma_hinh_thuc	=	$id;
    	$obj->ten_hinh_thuc	=	$request->txtHinhThuc;
    	$obj->so_thang		=	$request->txtSoThang;
    	$obj->ty_le_giam	=	$request->txtTyLeGiam;
    	$obj->ghi_chu		=	$request->txtNote;
    	
    	HinhThucModel::updateHT($obj);
    	return redirect()->route('list_payment')->with('messages','Sửa hình thức thành công');
    }

    public function get_delete($id)
    {
        $check=PhieuThuModel::get_hinh_thuc($id);
        if(count($check) >  0)
        {
            return back()->with('messages_error','Bạn khổng thể xóa hình thức');
        }else {
        	HinhThucModel::deleteHT($id);
        	return redirect()->route('list_payment')->with('messages','Xóa hình thức thành công');
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\NganhModel;
use App\Http\Requests\MajorsRequest;
use App\Http\Requests\MajorsEditRequest;
class MajorsController extends Controller
{
    public function get_major()
    {
    	$nganh=NganhModel::getAll();
    	return view('admin.nganh.list',['nganh' => $nganh]);
    }

    public function get_insert()
    {
    	return view('admin.nganh.insert');
    }

    public function post_insert(MajorsRequest $request)
    {
    	$obj=new NganhModel();
        $max_id=NganhModel::getID();

        $obj->ma_nganh		=	$max_id;
    	$obj->ten_nganh 	=	$request->txtTenNganh;
    	$obj->he_dao_tao	=	$request->txtHe;

        /*$obj->save();*/

    	NganhModel::insert($obj);

    	return redirect()->route('getInsert_majors')->with('messages','Thêm ngành học thành công');
    }

    public function get_update($id)
    {
    	$obj=NganhModel::getByID($id);
    	return view('admin.nganh.update',['obj' => $obj]);
    }

    public function post_update(MajorsEditRequest $request,$id)
    {
    	$obj=new NganhModel();
    	$obj->ma_nganh		=	$id;
    	$obj->ten_nganh 	=	$request->txtTenNganh;
    	$obj->he_dao_tao	=	$request->txtHe;
        $check=NganhModel::where('ten_nganh','like',$obj->ten_nganh)->where('ma_nganh','<>',$id)->count();
        if($check > 0)
        {
            return redirect()->route('getUpdate_majors',$id)->with('messages_error','Tên ngành học đã tồn tại');
        }else {
            NganhModel::updateNganh($obj);
            return redirect()->route('list_majors')->with('messages','Sửa ngành học thành công');
        }
    	
    }

    public function get_delete($id)
    {
    	NganhModel::deleteNganh($id);
    	return redirect()->route('list_majors')->with('messages','Xóa ngành học thành công');
    }
}

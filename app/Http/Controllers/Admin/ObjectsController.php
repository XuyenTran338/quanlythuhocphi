<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\HocBongModel;
use App\Http\Requests\ObjectRequest;
use App\Http\Requests\ObjectEditRequest;
class ObjectsController extends Controller
{
    public function get_object()
    {
    	$doituong=HocBongModel::getAll();
    	return view('admin.doituong.list',['doituong' => $doituong]);
    }

    public function get_insert()
    {
    	return view('admin.doituong.insert');
    }

    public function post_insert(ObjectRequest $request)
    {
    	$obj=new HocBongModel();
        $max_id=HocBongModel::getID();

        $obj->ma_hoc_bong		=	$max_id;
    	$obj->ten_hoc_bong 		=	$request->txtTenHB;
    	$obj->ty_le_phan_tram	=	$request->txtTyLeHB;

        /*$obj->save();*/

    	HocBongModel::insert($obj);

    	return redirect()->route('getInsert_objects')->with('messages','Thêm học bổng thành công');
    }

    public function get_update($id)
    {
    	$data=HocBongModel::getByID($id);
        $obj=new HocBongModel();
        $obj=$data[0];
       /* $user=session()->get('user');
        $data_session=bkc08_model::select('id','level')->where('username',$user)->first();
        if(($data_session->level!=0) &&($id == 1 || ($data->get('level') == 0 && $data_session->id!=$id)))
        {
            return redirect()->route('list')->with('errupdate','Bạn không được phép sửa thành viên này');
        }*/
    	return view('admin.doituong.update',['obj' => $obj]);
    }

    public function post_update(ObjectEditRequest $request,$id)
    {
    	$obj=new HocBongModel();
    	$obj->ma_hoc_bong		=	$id;
    	$obj->ten_hoc_bong 		=	$request->txtTenHB;
    	$obj->ty_le_phan_tram	=	$request->txtTyLeHB;
    	HocBongModel::updateDoiTuong($obj);
    	return redirect()->route('list_objects')->with('messages','Sửa học bổng thành công');
    }

    public function get_delete($id)
    {
    	HocBongModel::deleteDoiTuong($id);
    	return redirect()->route('list_objects')->with('messages','Xóa học bổng thành công');
    }
}

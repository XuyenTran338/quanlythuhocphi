<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LopModel;
use App\Models\SinhVienModel;
use Response;
use Datatables;
class AjaxLopController extends Controller
{
    public function get_khoa($id)
    {
    	$khoa_hoc=LopModel::distinct_Khoa_Hoc($id);
        return response()->json($khoa_hoc);
    }

    public function get_lop_chi_tiet($ma_nganh,$ma_khoa)
    {

        $lop=LopModel::distinct_Lop_chi_tiet($ma_nganh,$ma_khoa);
	    $data = array();
	    $nested=array();
	    $i=1;
	    foreach ($lop as $value) {
	    	$nested['stt']=$i++;
	    	$nested['ma_lop']=$value->ma_lop;
	    	$nested['ten_lop']=$value->ten_lop;
	    	$count_sv=SinhVienModel::where('lop_ma',$value->ma_lop)->count();
            $nested['si_so']=$count_sv.'/'.$value->si_so;
	    	if($value->giao_vien_chu_nhiem == 1 )
		       $nested['giao_vien_chu_nhiem']= 'Phạm Văn Hiệp';
		    elseif($value->giao_vien_chu_nhiem == 2 )
		        $nested['giao_vien_chu_nhiem']='Nguyễn Thị Nga';
		    elseif($value->giao_vien_chu_nhiem == 3 )
		        $nested['giao_vien_chu_nhiem']='Vũ Thị Lan Anh';
		    elseif($value->giao_vien_chu_nhiem == 4 )
		       $nested['giao_vien_chu_nhiem']= 'Trần Quốc Tuấn';
		    else $nested['giao_vien_chu_nhiem']='Nguyễn Văn Duy';

	    	$nested['ngay_bat_dau']=date('d-m-Y', strtotime($value->ngay_bat_dau));
	    	$nested['ngay_ket_thuc']=date('d-m-Y', strtotime($value->ngay_ket_thuc));
	    	$nested['ten_nganh']=$value->ten_nganh;
	    	$nested['he_dao_tao']=$value->he_dao_tao;
	    	$nested['ten_khoa_hoc']=$value->ten_khoa_hoc;
	    	if($value->trang_thai == 1 )
	    	{
		       $nested['trang_thai']= 'Còn học';
	    	}
		    else{
		        $nested['trang_thai']='Kết thúc';
		    }
	    	$data[]=$nested;
	    }

        if($data == null)
        {
        	return Datatables::of($data)->make(false);
        }else {
        	return Datatables::of($data)->make(true);
        }

    }

    public function get_class_print($ma_nganh,$ma_khoa)
    {
        $lop=LopModel::distinct_Lop_chi_tiet($ma_nganh,$ma_khoa);
        return json_encode($lop);
    }

    public function get_title($ma_nganh,$ma_khoa)
    {
    	$title=LopModel::get_title($ma_nganh,$ma_khoa);
    	echo "<b>Chuyên ngành: </b>".$title->ten_nganh."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		echo "<b>Khóa: </b>".$title->ten_khoa_hoc." - ".$title->ma_khoa_hoc."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		echo "<b>Hệ đào tạo:  </b>".$title->he_dao_tao;

    }
}

<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PhieuThuModel;
use App\Models\MucThuModel;
use App\Models\SinhVienModel;
use App\Models\NganhModel;
use App\Models\KhoaHocModel;
use App\Models\LopModel;
use App\Models\HinhThucModel;
use Validator;
use Carbon\Carbon;
class HomeController extends Controller
{
    public function get_home()
    {
    	$phieuthu=PhieuThuModel::getAll();
    	/*$data=array();
    	$nested=array();
    	foreach ($phieuthu as $obj) {
	        $dot_thu=PhieuThuModel::dot_thu_group($obj->lan_thu,$obj->sinh_vien_ma);
	        $add_dot_thu=array();
	        $thang_arr=array();
	        foreach ($dot_thu as $value) {
	            $add_dot_thu[]=$value->dot_thu;
	            $nam=$value->nam_hoc;
	            $thang_arr[]=$value->thang_da_nop;
	        }
	        $count=count($thang_arr);

	        if($count == 5)
	        {
	            $dot_thu_max=PhieuThuModel::where('sinh_vien_ma',$obj->sinh_vien_ma)->where('lan_thu',$obj->lan_thu)->max('dot_thu');
	            if($dot_thu_max == 5)
	            {
	                $nested['dot_thu']='Học kỳ 1';
	            }elseif ($dot_thu_max == 10) {
	                $nested['dot_thu']='Học kỳ 2';
	            }elseif ($dot_thu_max == 15) {
	                $nested['dot_thu']='Học kỳ 3';
	            }elseif ($dot_thu_max == 20) {
	                $nested['dot_thu']='Học kỳ 4';
	            }elseif ($dot_thu_max == 25) {
	                $nested['dot_thu']='Học kỳ 5';
	            }else{
	                $nested['dot_thu']='Học kỳ 6';
	            }
	        }elseif ($count == 10) {
	            $nam_hoc_group=PhieuThuModel::nam_hoc_group($obj->lan_thu,$obj->sinh_vien_ma);
	            $nam_hoc_arr=array();
	            foreach ($nam_hoc_group as $value_nam_hoc) {
	                $nam_hoc_arr[]=$value_nam_hoc->nam_hoc;
	            }
	            $nested['dot_thu']='Năm học '.implode("-", $nam_hoc_arr);//lấy 2 số năm của đợt  đóng theo năm
	        }elseif ($count == 30) {
	            $time=KhoaHocModel::getByID($obj->khoa_hoc_ma);
	            $start=date('Y',strtotime($time->ngay_bat_dau));
	            $end=date('Y',strtotime($time->ngay_ket_thuc));
	            $nested['dot_thu']='Niên học '.$start.'-'.$end;// lấy year của ngay_bat_dau và ngay_ket_thuc
	        }else {
	            $nested['dot_thu']='Đợt '.implode("+", $add_dot_thu).'(Tháng '.implode("+", $thang_arr).'/'.$nam.')';
	        }
	        $nested['sinh_vien_ma']=$obj->sinh_vien_ma;
	        $nested['ten_sinh_vien']=$obj->ten_sinh_vien;
	        $nested['ten_lop']=$obj->ten_lop;
	        $nested['nguoi_thu']=$obj->nguoi_thu;
	        $nested['thoi_gian_thu']=date('d-m-Y', strtotime($obj->thoi_gian_thu));
            Carbon::setLocale('vi');
            $nested['doc_time']=  Carbon::createFromTimeStamp(strtotime($obj->thoi_gian_thu))->diffForHumans();
	        $nested['ten_hinh_thuc']=$obj->ten_hinh_thuc;
	        $nested['so_tien_thu']=number_format($obj->so_tien_thu,0,",",".");

	        $data[]=$nested;
	    }
	    $object = json_decode(json_encode($data), FALSE);*/
    	return view('users.layouts.index',['obj' => $phieuthu]);
    }
}

<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LopModel;
use App\Models\NganhModel;
use App\Models\KhoaHocModel;
use App\Models\SinhVienModel;
use Datatables;
class ClassesController extends Controller
{
    public function get_class()
    {
    	$lop=LopModel::getAll();
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
               $nested['trang_thai']= "Còn học";
            }
            else{
                $nested['trang_thai']="Kết thúc";
            }
            $data[]=$nested;
        }
    	return Datatables::of($data)->make(true);
    }

    public function list_class()
    {
    	$nganh=NganhModel::getAll();
    	return view('users.lop.list_class',['nganh' => $nganh]);
    }

    public function get_class_print()
    {
        $lop_all=LopModel::getAll();
        return json_encode($lop_all);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\SinhVienModel;
use App\Models\NganhModel;
use App\Models\KhoaHocModel;
use App\Models\LopModel;
use App\Models\TaiKhoanModel;
use App\Models\PhieuThuModel;
use App\Models\MucThuModel;
use App\Models\HinhThucModel;
use Carbon\Carbon;
class HomeController extends Controller
{
    public function get_home()
    {
    	$count_user		=TaiKhoanModel::select()->count();
		$count_lop		=LopModel::select()->count();
		$count_sinhvien	=SinhVienModel::select()->count();
		$count_phieuthu	=PhieuThuModel::select()->count();

		$sinh_vien=SinhVienModel::getAll_TinhTrang();
        $data=array();
        $nested=array();
        $count=count($sinh_vien);
        if($count > 0)
        {
            $month_now=date('m');
            $year_now=date('Y');
            $arr_sinh_vien=array();
            foreach ($sinh_vien as $value) {
                $arr_sinh_vien[]=$value->ma_sinh_vien;
            }
            for($i=0; $i<count($arr_sinh_vien); $i++)
            {
                $obj=SinhVienModel::getByID($arr_sinh_vien[$i]);
                $hoc_phi=MucThuModel::get_muc_thu_thang($obj->ma_nganh,1);
                $phi_qui_dinh=$hoc_phi->muc_thu_qui_dinh;
                $hoc_bong=$obj->ty_le_phan_tram/100;
                $phi_giam=$hoc_phi->ty_le_giam/100;
                $so_tien_can_nop=$phi_qui_dinh-($phi_qui_dinh*($hoc_bong+$phi_giam));

                $dot_thu_max=PhieuThuModel::where('sinh_vien_ma',$obj->ma_sinh_vien)->max('dot_thu');
                if(count($dot_thu_max) >0)
                {
                    $date=PhieuThuModel::select('thang_da_nop','nam_hoc')->where('dot_thu',$dot_thu_max)->first();
                    $thang_da_nop=$date->thang_da_nop;
                    $nam_hoc=$date->nam_hoc;
                    if($thang_da_nop < 10)
                    {
                        $thang_da_nop='0'.$thang_da_nop;
                    }
                    $date_string=$nam_hoc.'-'.$thang_da_nop.'01';
                    $today= date('Y-m-d');

                    if($today <= $date_string)
                    {
                       $nested=0;
                    }else {
                        if($month_now > 5 && $month_now < 8)
                        {
                            $year_num=($year_now-$nam_hoc)*12;
                            $month_num=5-$thang_da_nop;
                            $so_thang_chua_nop=$year_num+$month_num;
                            $nested=number_format(round($so_tien_can_nop*$so_thang_chua_nop, -3, PHP_ROUND_HALF_UP),0,",",".");
                        }
                        else {
                            if($month_now >=8)
                            {
                                $year_num=($year_now-$nam_hoc)*12;
                                $month_du=2;
                                if($year_now-$nam_hoc == 2)
                                {
                                    $month_num=$month_now-$thang_da_nop-($month_du*2);
                                }elseif ($year_now-$nam_hoc == 3) {
                                    $month_num=$month_now-$thang_da_nop-($month_du*3);
                                }else {
                                    $month_num=$month_now-$thang_da_nop-$month_du;
                                }
                                $so_thang_chua_nop=$year_num+$month_num;
                                $nested=number_format(round($so_tien_can_nop*$so_thang_chua_nop, -3, PHP_ROUND_HALF_UP),0,",",".");
                            }else {
                                $year_num=($year_now-$nam_hoc)*12;
                                $month_num=$month_now-$thang_da_nop;
                                $so_thang_chua_nop=$year_num+$month_num;
                                $nested=number_format(round($so_tien_can_nop*$so_thang_chua_nop, -3, PHP_ROUND_HALF_UP),0,",",".");
                            }
                        }    
                    }
                    
                    
                }else {
                    $date=SinhVienModel::getByID($obj->ma_sinh_vien);
                    $thang_bat_dau=date('m',strtotime($date->ngay_bat_dau));
                    $nam_hoc=date('Y',strtotime($date->ngay_bat_dau));
                    if($month_now > 5 && $month_now < 8)
                    {
                        $year_num=($year_now-$nam_hoc)*12;
                        $month_num=5-$thang_bat_dau;
                        $so_thang_chua_nop=$year_num+$month_num+1;
                        $nested=number_format(round($so_tien_can_nop*$so_thang_chua_nop, -3, PHP_ROUND_HALF_UP),0,",",".");
                    }else {
                        if($month_now >=8)
                        {
                            $year_num=($year_now-$nam_hoc)*12;
                            $month_du=2;
                            if($year_now-$nam_hoc == 2)
                            {
                                $month_num=$month_now-$thang_bat_dau-($month_du*2);
                            }elseif ($year_now-$nam_hoc == 3) {
                                $month_num=$month_now-$thang_bat_dau-($month_du*3);
                            }else {
                                $month_num=$month_now-$thang_bat_dau-$month_du;
                            }
                            $so_thang_chua_nop=$year_num+$month_num+1;
                            $nested=number_format(round($so_tien_can_nop*$so_thang_chua_nop, -3, PHP_ROUND_HALF_UP),0,",",".");
                        }else {
                            $year_num=($year_now-$nam_hoc)*12;
                            $month_num=$month_now-$thang_bat_dau;
                            $so_thang_chua_nop=$year_num+$month_num+1;
                            $nested=number_format(round($so_tien_can_nop*$so_thang_chua_nop, -3, PHP_ROUND_HALF_UP),0,",",".");
                        }
                    }   

                }
                $data[]=$nested;
            }
            $arr_no=array();
            for($i=0; $i<count($data); $i++)
            {
                if($data[$i] != 0)
                {
                    $arr_no[]=$data[$i];
                }
            }
            $count_no_phi=count($arr_no);
        }else {
            $count_no_phi=0;
        }

        $nganh=NganhModel::getAll();
        
		return view('admin.layouts.home',['user' => $count_user,'lop' => $count_lop,'sinhvien' => $count_sinhvien,'phieuthu' => $count_phieuthu,'count_no_phi' => $count_no_phi,'nganh' => $nganh]);
    }
}

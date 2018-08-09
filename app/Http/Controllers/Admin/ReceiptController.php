<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PhieuThuModel;
use App\Models\SinhVienModel;
use App\Models\MucThuModel;
class ReceiptController extends Controller
{
    public function get_receipt()
    {
    	$phieuthu=PhieuThuModel::getAll();
    	return view('admin.phieuthu.list',['phieuthu' => $phieuthu]);
    }

    public function get_infor($ma_sinh_vien,$lan_thu)
    {
    	$obj=PhieuThuModel::getByID($ma_sinh_vien,$lan_thu);
        $bang_chu=PhieuThuModel::doc_tien($obj->so_tien_thu);
    	return view('admin.phieuthu.infor',['obj' => $obj,"bang_chu" => $bang_chu]);
    }

    public function get_receipt_sinhvien($id)
    {
        $sinh_vien=SinhVienModel::getByID($id);
        $nganh_ma=$sinh_vien->ma_nganh;
        $muc_thu_qd=MucThuModel::where('nganh_ma',$nganh_ma)->max('muc_thu_qui_dinh');
        $ty_le_giam=$sinh_vien->ty_le_giam;
        $hoc_bong=$sinh_vien->ty_le_phan_tram;

        $muc_thu_qui_dinh=$muc_thu_qd-($muc_thu_qd*(($ty_le_giam+$hoc_bong)/100));

        //lấy tổng số tiền nợ đến thời điểm hiện tại
        $month_now=date('m');
        $year_now=date('Y');
        $hoc_phi=MucThuModel::get_muc_thu_thang($sinh_vien->ma_nganh,1);
        $phi_qui_dinh=$hoc_phi->muc_thu_qui_dinh;
        $hoc_bong=$sinh_vien->ty_le_phan_tram/100;
        $phi_giam=$hoc_phi->ty_le_giam/100;
        $so_tien_can_nop=$phi_qui_dinh-($phi_qui_dinh*($hoc_bong+$phi_giam));

        $dot_thu_max=PhieuThuModel::where('sinh_vien_ma',$id)->max('dot_thu');
        
        if(count($dot_thu_max) > 0)
        {
            $so_tien_da_nop=PhieuThuModel::da_nop($id);
            $so_tien_con_lai=$muc_thu_qui_dinh-$so_tien_da_nop->da_nop;
            $so_tien_con_lai=number_format(round($so_tien_con_lai, -3, PHP_ROUND_HALF_UP),0,",",".");
            $so_tien_da_nop=number_format($so_tien_da_nop->da_nop,0,",",".");// lấy số tiền đã nộp
            

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
               $so_tien_can_nop=0;
               $so_thang_chua_nop=0; 
            }else {
                if($month_now > 5 && $month_now < 8)
                {
                    $year_num=($year_now-$nam_hoc)*12;
                    $month_num=5-$thang_da_nop;
                    $so_thang_chua_nop=$year_num+$month_num;
                    $so_tien_can_nop=number_format(round($so_tien_can_nop*$so_thang_chua_nop, -3, PHP_ROUND_HALF_UP),0,",",".");
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
                        $so_tien_can_nop=number_format(round($so_tien_can_nop*$so_thang_chua_nop, -3, PHP_ROUND_HALF_UP),0,",",".");
                    }else {
                        $year_num=($year_now-$nam_hoc)*12;
                        $month_num=$month_now-$thang_da_nop;
                        $so_thang_chua_nop=$year_num+$month_num;
                        $so_tien_can_nop=number_format(round($so_tien_can_nop*$so_thang_chua_nop, -3, PHP_ROUND_HALF_UP),0,",",".");
                    }
                }    
            }
        }else {
            $dot_thu_max=0;
            $so_tien_da_nop=0;// lấy số tiền đã nộp
            $so_tien_con_lai=number_format(round($muc_thu_qui_dinh, -3, PHP_ROUND_HALF_UP),0,",",".");;

            $date=SinhVienModel::getByID($id);
            $thang_bat_dau=date('m',strtotime($date->ngay_bat_dau));
            $nam_hoc=date('Y',strtotime($date->ngay_bat_dau));
            if($month_now > 5 && $month_now < 8)
            {
                $year_num=($year_now-$nam_hoc)*12;
                $month_num=5-$thang_bat_dau;
                $so_thang_chua_nop=$year_num+$month_num+1;
                $so_tien_can_nop=number_format(round($so_tien_can_nop*$so_thang_chua_nop, -3, PHP_ROUND_HALF_UP),0,",",".");
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
                    $so_tien_can_nop=number_format(round($so_tien_can_nop*$so_thang_chua_nop, -3, PHP_ROUND_HALF_UP),0,",",".");
                }else {
                    $year_num=($year_now-$nam_hoc)*12;
                    $month_num=$month_now-$thang_bat_dau;
                    $so_thang_chua_nop=$year_num+$month_num+1;
                    $so_tien_can_nop=number_format(round($so_tien_can_nop*$so_thang_chua_nop, -3, PHP_ROUND_HALF_UP),0,",",".");
                }
            }   
        }

        $phieu_thu=PhieuThuModel::get_phieu_thu_sv($id);
        $data = array();
        $nested=array();
        foreach ($phieu_thu as $value) {
            $hoc_bong=$value->ty_le_phan_tram/100;
            $ty_le_uu_dai=$value->ty_le_giam/100;
            $phi_qui_dinh=round($value->muc_thu_qui_dinh, -3, PHP_ROUND_HALF_UP);

            $nested['nguoi_thu']=$value->nguoi_thu;
            $nested['thoi_gian_thu']=date('d-m-Y h:i:s A', strtotime($value->thoi_gian_thu));
            $nested['ten_hinh_thuc']=$value->ten_hinh_thuc;
           /* $nested['muc_thu_qui_dinh']=number_format($phi_qui_dinh,0,",",".");*/

            $phi_giam=$phi_qui_dinh*$hoc_bong;
            $phi_giam=round($phi_giam, -3, PHP_ROUND_HALF_UP);
            $nested['hoc_bong']=number_format($phi_giam,0,",",".");


            $ty_le_uu_dai=$phi_qui_dinh*$ty_le_uu_dai;
            $ty_le_uu_dai=round($ty_le_uu_dai, -3, PHP_ROUND_HALF_UP);
            $nested['so_tien_giam']=number_format($ty_le_uu_dai,0,",",".");

            $nested['so_tien_thu']=number_format($value->so_tien_thu,0,",",".");

            $nested['noi_dung']=$value->noi_dung;
            $nested['lan_thu']=$value->lan_thu;
            $data[]=$nested;
        }

        return response()->json([
            'sinh_vien' =>  $sinh_vien,
            'so_tien_da_nop' => $so_tien_da_nop,
            'so_tien_con_lai'   =>  $so_tien_con_lai,
            'so_tien_can_nop'   =>  $so_tien_can_nop,
            'so_thang_chua_nop' =>  $so_thang_chua_nop,
            'dot_thu_max'       =>  $dot_thu_max,
            'data'  =>  $data
        ]);
    }
}

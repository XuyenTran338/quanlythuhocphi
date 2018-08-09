<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PhieuThuModel;
use App\Models\MucThuModel;
use App\Models\HinhThucModel;
use App\Models\SinhVienModel;
use App\Models\NganhModel;
use App\Models\KhoaHocModel;
use App\Models\LopModel;
use Datatables;
class AjaxReceiptController extends Controller
{
    public function get_khoa($id)
    {
    	$khoa_hoc=LopModel::distinct_Khoa_Hoc($id);
        return response()->json($khoa_hoc);
    }

    public function get_lop($ma_nganh,$ma_khoa)
    {
        $lop=LopModel::distinct_Lop($ma_nganh,$ma_khoa);
        return response()->json($lop);
    }

    public function get_sinhvien($id)
    {
        $sinh_vien=SinhVienModel::list_SV($id);
        $check=count($sinh_vien);
        $data=array();
        foreach ($sinh_vien as $value) {
            $nested['ma_sinh_vien']=$value->ma_sinh_vien;
            $nested['ten_sinh_vien']=$value->ten_sinh_vien;
            $nested['ngay_sinh']=date('d-m-Y', strtotime($value->ngay_sinh));
            $nested['sdt']      =$value->sdt;
            $data[]=$nested;
        }
        return response()->json(['sinhvien' => $data,'check' => $check]);
    }

    public function check($id)
    {
        $dot_thu=PhieuThuModel::where('sinh_vien_ma',$id)->max('dot_thu');
        return response()->json($dot_thu);
    }

    public function get_phieu_thu($id)
    {
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

        if($data == null)
        {
            return Datatables::of($data)->make(false);
        }else {
            return Datatables::of($data)->make(true);
        }
    }

    public function get_hinh_thuc($id)
    {
    	$sinh_vien=SinhVienModel::getByID($id);
        $so_thang_sv=$sinh_vien->so_thang;
        $ma_nganh=$sinh_vien->ma_nganh;
        $lan_thu=PhieuThuModel::where('sinh_vien_ma',$id)->max('lan_thu');
        $count_lan_thu=count($lan_thu);
        $dot_thu_max=PhieuThuModel::where('sinh_vien_ma',$id)->max('dot_thu');
        $count_dot_thu=count($dot_thu_max);
        if($count_dot_thu > 0)
        {
            $dot_thu_con_lai=30-$dot_thu_max;
            
            $value=PhieuThuModel::select('thang_da_nop','muc_thu_ma')->where('dot_thu',$dot_thu_max)->where('sinh_vien_ma',$id)->first();
            $thang_da_nop=$value->thang_da_nop;
            if($thang_da_nop ==12)
            {
                $thang_da_nop=1;   
            }elseif($thang_da_nop==5)
            {
                $thang_da_nop=8; 
            }
            else
            {
                $thang_da_nop=$thang_da_nop+1;
            }
             
           
            if($count_lan_thu>0)
            {
                if($thang_da_nop==8 || $thang_da_nop ==1)// kiểm tra xem có phải tháng đầu mỗi học kỳ
                {
                    if($dot_thu_con_lai >= 10)
                    {
                        if($dot_thu_max == 10 || $dot_thu_max == 20)
                        {
                            $so_thang_max=HinhThucModel::max_thang();
                            $hinh_thuc=MucThuModel::get_MucThu_Nganh_fliter($ma_nganh,$so_thang_sv,$so_thang_max,0);
                            $count=count($hinh_thuc);

                            return response()->json([
                                'sinh_vien' => $sinh_vien,
                                'hinh_thuc' => $hinh_thuc,
                                'count'     => $count
                            ]);
                        }elseif ($dot_thu_max == 5 || $dot_thu_max == 10 || $dot_thu_max == 15 || $dot_thu_max == 20 || $dot_thu_max == 25) {
                            $so_thang_max=HinhThucModel::max_thang();
                            $hinh_thuc=MucThuModel::get_MucThu_Nganh_khoang($ma_nganh,$so_thang_sv,$so_thang_max,5);
                            $count=count($hinh_thuc);

                            return response()->json([
                                'sinh_vien' => $sinh_vien,
                                'hinh_thuc' => $hinh_thuc,
                                'count'     => $count
                            ]);
                        }
                        else
                        {
                            $hinh_thuc=MucThuModel::get_MucThu($value->muc_thu_ma);
                            $count=count($hinh_thuc);

                            return response()->json([
                                'sinh_vien' => $sinh_vien,
                                'hinh_thuc' => $hinh_thuc,
                                'count'     => $count
                            ]);
                        }
                        
                    }elseif($dot_thu_con_lai >=5 && $dot_thu_con_lai < 10)
                    {
                        $so_thang_max=HinhThucModel::max_thang();
                        $hinh_thuc=MucThuModel::get_MucThu_Nganh_fliter($ma_nganh,$so_thang_sv,$so_thang_max,10);
                        $count=count($hinh_thuc);

                        return response()->json([
                            'sinh_vien' => $sinh_vien,
                            'hinh_thuc' => $hinh_thuc,
                            'count'     => $count
                        ]);
                    }   
                    elseif($dot_thu_con_lai < 5)
                        {
                            $hinh_thuc=MucThuModel::get_MucThu($value->muc_thu_ma);
                            $count=count($hinh_thuc);

                            return response()->json([
                                'sinh_vien' => $sinh_vien,
                                'hinh_thuc' => $hinh_thuc,
                                'count'     => $count
                            ]);
                        }
                    
                }else
                {
                    $hinh_thuc=MucThuModel::get_MucThu($value->muc_thu_ma);
                    $count=count($hinh_thuc);

                    return response()->json([
                        'sinh_vien' => $sinh_vien,
                        'hinh_thuc' => $hinh_thuc,
                        'count'     => $count
                    ]); 
                }
            }
            else
            {
                if($thang_da_nop==8 || $thang_da_nop ==1)
                {
                    if($dot_thu_con_lai >= 10)
                    {
                        $hinh_thuc=MucThuModel::get_MucThu_Nganh_fliter($ma_nganh,$so_thang_sv,0,0);
                        $count=count($hinh_thuc);

                        return response()->json([
                            'sinh_vien' => $sinh_vien,
                            'hinh_thuc' => $hinh_thuc,
                            'count'     => $count
                        ]);
                    }elseif($dot_thu_con_lai >=5 && $dot_thu_con_lai < 10)
                    {
                        $so_thang_max=HinhThucModel::max_thang();
                        $hinh_thuc=MucThuModel::get_MucThu_Nganh_fliter($ma_nganh,$so_thang_sv,0,10);
                        $count=count($hinh_thuc);

                        return response()->json([
                            'sinh_vien' => $sinh_vien,
                            'hinh_thuc' => $hinh_thuc,
                            'count'     => $count
                        ]);
                    }elseif($dot_thu_con_lai < 5)
                        {
                            $hinh_thuc=MucThuModel::get_MucThu($value->muc_thu_ma);
                            $count=count($hinh_thuc);

                            return response()->json([
                                'sinh_vien' => $sinh_vien,
                                'hinh_thuc' => $hinh_thuc,
                                'count'     => $count
                            ]);
                        }
                }else
                {
                    $hinh_thuc=MucThuModel::get_MucThu($value->muc_thu_ma);
                    $count=count($hinh_thuc);

                    return response()->json([
                        'sinh_vien' => $sinh_vien,
                        'hinh_thuc' => $hinh_thuc,
                        'count'     => $count
                    ]);
                }
            }
        }else
            {
                $hinh_thuc=MucThuModel::get_MucThu_Nganh_fliter($ma_nganh,$so_thang_sv,0,0);
                $count=count($hinh_thuc);

                return response()->json([
                    'sinh_vien' => $sinh_vien,
                    'hinh_thuc' => $hinh_thuc,
                    'count'     => $count
                ]);
            }
    	
    }

    public function get_phi_thu($ma_muc_thu,$ma_sv)
    {
    	$sinh_vien=SinhVienModel::getByID($ma_sv);

        $so_thang_sv=$sinh_vien->so_thang;
        $nganh_ma=$sinh_vien->ma_nganh;
        $muc_thu_qui_dinh=MucThuModel::where('nganh_ma',$nganh_ma)->max('muc_thu_qui_dinh');

        $dot_thu_max=PhieuThuModel::where('sinh_vien_ma',$ma_sv)->max('dot_thu');
        $count_dot_thu=count($dot_thu_max);

        if($count_dot_thu > 0)
        {
            $count_money=PhieuThuModel::da_nop($ma_sv);
            $money_da_nop=number_format(round($count_money->da_nop, -3, PHP_ROUND_HALF_UP),0,",",".");
            $value=PhieuThuModel::select('thang_da_nop','muc_thu_ma','nam_hoc','lan_thu')->where('dot_thu',$dot_thu_max)->first();
            $thang_da_nop=$value->thang_da_nop;
            $nam=$value->nam_hoc;
            $lan_thu=$value->lan_thu;
            if($so_thang_sv == 3 && ($thang_da_nop ==10 || $thang_da_nop==3))// kểm tra hình thức thu theo quý
            {
                $muc_thu=MucThuModel::get_muc_thu_thang($nganh_ma,1);
                $phi_qui_dinh       =   $muc_thu->muc_thu_qui_dinh;
                $ty_le_uu_dai       =   $muc_thu->ty_le_giam/100;
                $hoc_bong           =   $sinh_vien->ty_le_phan_tram/100;
                $thucthu=($phi_qui_dinh-($phi_qui_dinh*($hoc_bong+$ty_le_uu_dai)))*2;
                $thuc_thu1=round($thucthu, -3, PHP_ROUND_HALF_UP);
                $thuc_thu=number_format($thuc_thu1,0,",",".");

                $so_tien_qui_dinh=$muc_thu_qui_dinh-($muc_thu_qui_dinh*($hoc_bong+$ty_le_uu_dai));
                $so_tien_con_lai=$so_tien_qui_dinh-$count_money->da_nop;
                $so_tien_con_lai=number_format(round($so_tien_con_lai, -3, PHP_ROUND_HALF_UP),0,",",".");

                $nested='';
                $add_dot_thu=array();
                $thang_arr=array();
                for($i=0; $i<2; $i++)
                {
                    $add_dot_thu[]=++$dot_thu_max;
                    $thang_arr[]=++$thang_da_nop;
                }
                $nested='Đợt '.implode("+", $add_dot_thu).'(Tháng '.implode("+", $thang_arr).'/'.$nam.')';
                return response()->json([
                    'muc_thu'   => $muc_thu,
                    'so_thang_sv' => $so_thang_sv,
                    'thucthu'   => $thuc_thu,
                    'thuc_thu'  => $thuc_thu1,
                    'da_nop'    => $money_da_nop,
                    'con_lai'   => $so_tien_con_lai,
                    'noi_dung' => $nested
                ]);
                
            }else
            {
                $muc_thu=MucThuModel::getByID($ma_muc_thu);
                $phi_qui_dinh       =   $muc_thu->muc_thu_qui_dinh;
                $ty_le_uu_dai       =   $muc_thu->ty_le_giam/100;
                $hoc_bong           =   $sinh_vien->ty_le_phan_tram/100;
                $thucthu=$phi_qui_dinh-($phi_qui_dinh*($hoc_bong+$ty_le_uu_dai));
                $thuc_thu1=round($thucthu, -3, PHP_ROUND_HALF_UP);
                $thuc_thu=number_format($thuc_thu1,0,",",".");

                $so_tien_qui_dinh=$muc_thu_qui_dinh-($muc_thu_qui_dinh*($hoc_bong+$ty_le_uu_dai));
                $so_tien_con_lai=$so_tien_qui_dinh-$count_money->da_nop;
                $so_tien_con_lai=number_format(round($so_tien_con_lai, -3, PHP_ROUND_HALF_UP),0,",",".");

                $so_thang=$muc_thu->so_thang;
                $nested='';
                $add_dot_thu=array();
                $thang_arr=array();

                if($thang_da_nop == 12)
                {
                    $thang_da_nop=1;
                    $nam_hoc=$nam+1;
                }else if($thang_da_nop ==5){
                    $thang_da_nop=8;
                    $nam_hoc=$nam;
                }else {
                    $thang_da_nop=$value->thang_da_nop+1;
                    $nam_hoc=$nam;
                }

                for($i=0; $i < $so_thang; $i++)
                {
                    $add_dot_thu[]=++$dot_thu_max;
                    $thang_arr[]=$thang_da_nop++; 
                }
                $count_thang=count($thang_arr);
                if($count_thang == 5)
                {
                    
                    if($dot_thu_max == 5)
                    {
                        $nested='Học kỳ 1';
                    }elseif ($dot_thu_max == 10) {
                        $nested='Học kỳ 2';
                    }elseif ($dot_thu_max == 15) {
                        $nested='Học kỳ 3';
                    }elseif ($dot_thu_max == 20) {
                        $nested='Học kỳ 4';
                    }elseif ($dot_thu_max == 25) {
                        $nested='Học kỳ 5';
                    }else {
                        $nested='Học kỳ 6';
                    }
                }elseif ($count_thang == 10) {
                    $nam_hoc_group=PhieuThuModel::nam_hoc_group($lan_thu,$ma_sv);
                    $nam_hoc_arr=array();
                    foreach ($nam_hoc_group as $value_nam_hoc) {
                        $nam_hoc_arr[]=($value_nam_hoc->nam_hoc)+1;
                    }
                    $nested='Năm học '.implode("-", $nam_hoc_arr);//lấy 2 số năm của đợt  đóng theo năm
                }else {
                    $nested='Đợt '.implode("+", $add_dot_thu).'(Tháng '.implode("+", $thang_arr).'/'.$nam_hoc.')';
                }

                return response()->json([
                    'muc_thu'   => $muc_thu,
                    'so_thang_sv' => $so_thang_sv,
                    'thucthu'   => $thuc_thu,
                    'thuc_thu'  => $thuc_thu1,
                    'da_nop'    => $money_da_nop,
                    'con_lai'   => $so_tien_con_lai,
                    'noi_dung' => $nested
                ]);
            }
        }else {
            $count_money=0;
            $money_da_nop=number_format(round($count_money, -3, PHP_ROUND_HALF_UP),0,",",".");
            $muc_thu=MucThuModel::getByID($ma_muc_thu);
            $phi_qui_dinh       =   $muc_thu->muc_thu_qui_dinh;
            $ty_le_uu_dai       =   $muc_thu->ty_le_giam/100;
            $hoc_bong           =   $sinh_vien->ty_le_phan_tram/100;
            $thucthu=$phi_qui_dinh-($phi_qui_dinh*($hoc_bong+$ty_le_uu_dai));
            $thuc_thu1=round($thucthu, -3, PHP_ROUND_HALF_UP);
            $thuc_thu=number_format($thuc_thu1,0,",",".");

            $so_tien_qui_dinh=$muc_thu_qui_dinh-($muc_thu_qui_dinh*($hoc_bong+$ty_le_uu_dai));
            $so_tien_con_lai=$so_tien_qui_dinh-$count_money;
            $so_tien_con_lai=number_format(round($so_tien_con_lai, -3, PHP_ROUND_HALF_UP),0,",",".");

            $so_thang=$muc_thu->so_thang;
            $nested='';
            $add_dot_thu=array();
            $thang_arr=array();
           
            $thang_da_nop=8;
            $nam=date('Y', strtotime($sinh_vien->ngay_bat_dau));
            $dot_thu_max=1;
            for($i=0; $i < $so_thang; $i++)
            {
                $add_dot_thu[]=$dot_thu_max++;
                $thang_arr[]=$thang_da_nop++;  
            }
            $count_thang=count($thang_arr);
            if($count_thang == 5)
            {
                $nested='Học kỳ 1';
            }elseif ($count_thang == 10) {
                $nested='Năm học '.$nam.'-'.($nam+1);//lấy 2 số năm của đợt  đóng theo năm
            }elseif ($count_thang == 30) {
                $time=KhoaHocModel::getByID($sinh_vien->ma_khoa_hoc);
                $start=date('Y',strtotime($time->ngay_bat_dau));
                $end=date('Y',strtotime($time->ngay_ket_thuc));
                $nested='Niên học '.$start.'-'.$end;// lấy year của ngay_bat_dau và ngay_ket_thuc
            }else {
                $nested='Đợt '.implode("+", $add_dot_thu).'(Tháng '.implode("+", $thang_arr).'/'.$nam.')';
            }

            return response()->json([
                'muc_thu'       => $muc_thu,
                'so_thang_sv'   => $so_thang_sv,
                'thucthu'   => $thuc_thu,
                'thuc_thu'  => $thuc_thu1,
                'da_nop'    => $money_da_nop,
                'con_lai'   => $so_tien_con_lai,
                'noi_dung'  => $nested
            ]);
        }
        
        
    }

    public function search($keyword)
    {
        $sinh_vien=SinhVienModel::get_keyword($keyword);
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
                       $nested['so_tien_can_nop']=0;
                       $nested['so_thang']=0; 
                    }else {
                        if($month_now > 5 && $month_now < 8)
                        {
                            $year_num=($year_now-$nam_hoc)*12;
                            $month_num=5-$thang_da_nop;
                            $so_thang_chua_nop=$year_num+$month_num;
                            $nested['so_tien_can_nop']=number_format(round($so_tien_can_nop*$so_thang_chua_nop, -3, PHP_ROUND_HALF_UP),0,",",".");
                            $nested['so_thang']=$so_thang_chua_nop;
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
                                $nested['so_tien_can_nop']=number_format(round($so_tien_can_nop*$so_thang_chua_nop, -3, PHP_ROUND_HALF_UP),0,",",".");
                                $nested['so_thang']=$so_thang_chua_nop;
                            }else {
                                $year_num=($year_now-$nam_hoc)*12;
                                $month_num=$month_now-$thang_da_nop;
                                $so_thang_chua_nop=$year_num+$month_num;
                                $nested['so_tien_can_nop']=number_format(round($so_tien_can_nop*$so_thang_chua_nop, -3, PHP_ROUND_HALF_UP),0,",",".");
                                $nested['so_thang']=$so_thang_chua_nop;
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
                        $nested['so_tien_can_nop']=number_format(round($so_tien_can_nop*$so_thang_chua_nop, -3, PHP_ROUND_HALF_UP),0,",",".");
                        $nested['so_thang']=$so_thang_chua_nop;
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
                            $nested['so_tien_can_nop']=number_format(round($so_tien_can_nop*$so_thang_chua_nop, -3, PHP_ROUND_HALF_UP),0,",",".");
                            $nested['so_thang']=$so_thang_chua_nop;
                        }else {
                            $year_num=($year_now-$nam_hoc)*12;
                            $month_num=$month_now-$thang_bat_dau;
                            $so_thang_chua_nop=$year_num+$month_num+1;
                            $nested['so_tien_can_nop']=number_format(round($so_tien_can_nop*$so_thang_chua_nop, -3, PHP_ROUND_HALF_UP),0,",",".");
                            $nested['so_thang']=$so_thang_chua_nop;
                        }
                    }   

                }

                $nested['ma_sinh_vien']     = $obj->ma_sinh_vien;
                $nested['ten_sinh_vien']    = $obj->ten_sinh_vien;
                $nested['ngay_sinh']        = date('d/m/Y',strtotime($obj->ngay_sinh));
                if($obj->gioi_tinh==1)
                    $nested['gioi_tinh']='Nam';
                else {
                    $nested['gioi_tinh']='Nữ';
                }
                $nested['email']            = $obj->email;
                $nested['sdt']              = $obj->sdt;
                $nested['ten_lop']          = $obj->ten_lop;
                $nested['ten_nganh']        = $obj->ten_nganh;

                $data[]=$nested;
            }
            
        }else {
            $count=0;
        }

        return response()->json([
            'search' => $data,
            'count'  => $count
        ]);    

    }
}

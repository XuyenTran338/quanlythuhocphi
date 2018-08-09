<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LopModel;
use App\Models\SinhVienModel;
use App\Models\MucThuModel;
use Datatables;
class AjaxSinhVienController extends Controller
{
    public function get_khoa($id)
    {
      $khoa_hoc=LopModel::distinct_Khoa_Hoc($id);
      $muc_thu = MucThuModel::get_MucThu_Nganh($id);
      $data=array();
      foreach ($muc_thu as $value) {
        $nested['ma_muc_thu']=$value->ma_muc_thu;
        $nested['ten_hinh_thuc']=$value->ten_hinh_thuc;
        $nested['muc_thu_qui_dinh']=number_format($value->muc_thu_qui_dinh,0,",",".");
        $data[]=$nested;
      }
      return response()->json(['khoa' => $khoa_hoc,'mucthu' => $data]);
    }

    public function get_lop($ma_nganh,$ma_khoa)
    {
        $lop=LopModel::distinct_Lop($ma_nganh,$ma_khoa);
        $arr_lop=array();
        $arr_si_so=array();
        $data=array();
        $nested=array();
        foreach ($lop as $value) {
            $arr_lop[]=$value->ma_lop;
        }
        for($i=0; $i<count($arr_lop); $i++)
        {
            $count_sv=SinhVienModel::where('lop_ma',$arr_lop[$i])->count();
            $lop_ma=LopModel::select('ma_lop','ten_lop','si_so')->where('ma_lop',$arr_lop[$i])->first();
            $nested['ma_lop']=$lop_ma->ma_lop;
            $nested['ten_lop']=$lop_ma->ten_lop;
            $nested['si_so']=$lop_ma->si_so;
            $nested['si_so_now']=$count_sv;

            $data[]=$nested;
        }
        return response()->json($data);
    }

    public function get_sinhvien($id)
    {
        $sinh_vien=SinhVienModel::list_SV_chi_tiet($id);
        $data = array();
        foreach ($sinh_vien as $value) {
            $nested['ma_sinh_vien']=$value->ma_sinh_vien;
            $nested['ten_sinh_vien']=$value->ten_sinh_vien;
            $nested['ty_le_phan_tram']=$value->ty_le_phan_tram." %";
            $nested['ngay_sinh']=date('d-m-Y', strtotime($value->ngay_sinh));
            $nested['email']=$value->email;
            $nested['gioi_tinh']=$value->gioi_tinh;
            $nested['sdt']=$value->sdt;
            $nested['hinh_thuc']=$value->ten_hinh_thuc;
            $nested['trang_thai']= $value->trang_thai;
            $data[]=$nested;
        }

        return response()->json($data);
      
    }

    public function get_search($keyword)
    {
        $ma_sinh_vien=SinhVienModel::get_keyword($keyword);
        $data=array();
        $nested=array();
        foreach ($ma_sinh_vien as $value) {
            $sinh_vien=SinhVienModel::getByID($value->ma_sinh_vien);
            $nested['ma_sinh_vien']=$sinh_vien->ma_sinh_vien;
            $nested['ten_sinh_vien']=$sinh_vien->ten_sinh_vien;
            $nested['ty_le_phan_tram']=$sinh_vien->ty_le_phan_tram."%";
            $nested['ngay_sinh']=date('d-m-Y', strtotime($sinh_vien->ngay_sinh));
            $nested['email']=$sinh_vien->email;
            if($sinh_vien->gioi_tinh == 1 )
            {
               $nested['gioi_tinh']= "Nam";
            }
            else{
                $nested['gioi_tinh']="Nữ";
            }
            $nested['sdt']=$sinh_vien->sdt;
            $nested['hinh_thuc']=$sinh_vien->ten_hinh_thuc;

            $data[]=$nested;
        }

        return response()->json(['search' => $data, 'count' => count($data)]);
    }
     
}

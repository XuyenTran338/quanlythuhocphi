<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SinhVienModel;
use App\Models\LopModel;
use App\Models\NganhModel;
use App\Models\KhoaHocModel;
use Datatables;
class StudentsController extends Controller
{
	public function list_student()
	{
		$nganh=NganhModel::getAll();
	    return view('users.sinhvien.list_student',['nganh' => $nganh]);
	}

	public function get_student($id)
	{
		$sinh_vien=SinhVienModel::list_SV_chi_tiet($id);
        return json_encode($sinh_vien);
	}

    public function check_student($id)
    {
        $check = SinhVienModel::where('lop_ma',$id)->count();
        $lop=LopModel::select('ten_lop')->where('ma_lop',$id)->first();
        $ten_lop=$lop->ten_lop;
        return response()->json(['check' => $check, 'ten_lop' => $ten_lop]);
    }

	public function get_khoa($id)
    {
    	$khoa_hoc=LopModel::distinct_Khoa_Hoc($id);
        return response()->json($khoa_hoc);
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
            $lop_ma=LopModel::getByID($arr_lop[$i]);
            $nested['ma_lop']=$lop_ma->ma_lop;
            $nested['ten_lop']=$lop_ma->ten_lop;
            $nested['si_so']=$lop_ma->si_so;
            $nested['si_so_now']=$count_sv;
            $nested['ngay_bat_dau']=$lop_ma->ngay_bat_dau;
            $nested['ngay_ket_thuc']=$lop_ma->ngay_ket_thuc;

            $data[]=$nested;
        }
        return response()->json($data);
    }

    public function get_sinhvien($id)
    {
    	$sinh_vien=SinhVienModel::list_SV_chi_tiet($id);
        $data = array();
        $nested=array();
        $i=1;
        foreach ($sinh_vien as $value) {
            $nested['stt']=$i++;
            $nested['ma_sinh_vien']=$value->ma_sinh_vien;
            $nested['ten_sinh_vien']=$value->ten_sinh_vien;
            $nested['ty_le_phan_tram']=$value->ty_le_phan_tram." %";
            $nested['ngay_sinh']=date('d-m-Y', strtotime($value->ngay_sinh));
            $nested['email']=$value->email;
            if($value->gioi_tinh == 1 )
            {
               $nested['gioi_tinh']= "Nam";
            }
            else{
                $nested['gioi_tinh']="Nữ";
            }
            $nested['sdt']=$value->sdt;
            $nested['hinh_thuc']=$value->ten_hinh_thuc;
            if($value->trang_thai == 1 )
            {
               $nested['trang_thai']= "Còn học";
            }
            else{
                $nested['trang_thai']="Đã nghỉ";
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

    public function get_title($id)
    {
        $title=SinhVienModel::get_title($id);
        $count=count($title);
        if($count > 0)
        {
            $si_so=SinhVienModel::where('lop_ma',$id)->count();
            $start=date('Y', strtotime($title->ngay_bat_dau));
            $end=date('Y', strtotime($title->ngay_ket_thuc));
            $gv='';
            if($title->giao_vien_chu_nhiem == 1 )
               $gv= 'Phạm Văn Hiệp';
            elseif($title->giao_vien_chu_nhiem == 2 )
                $gv='Nguyễn Thị Nga';
            elseif($title->giao_vien_chu_nhiem == 3 )
                $gv='Vũ Thị Lan Anh';
            elseif($title->giao_vien_chu_nhiem == 4 )
               $gv= 'Trần Quốc Tuấn';
            else $gv='Nguyễn Văn Duy';
            echo "<p>";
                echo "<b>Chuyên ngành: </b>".$title->ten_nganh."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                echo "<b>Khóa: </b>".$title->ten_khoa_hoc." - ".$title->ma_khoa_hoc."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                echo "<b>Niên học: </b>".$start."-".$end;
            echo "</p>";
            echo "<p>";
                echo "<b>Lớp: </b>".$title->ten_lop."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ";
                echo "<b>Sĩ số: </b>".$si_so."&nbsp;&nbsp&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ";
                echo "<b>GVCN: </b>".$gv;
            echo "</p>";
        }else
        {
            echo "<h4 class='text-center'>Lớp chưa có sinh viên</h4>";
        }
    }
}

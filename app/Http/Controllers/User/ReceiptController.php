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

class ReceiptController extends Controller
{
    public function get_receipt()
    {     
        $nganh=NganhModel::getAll();
        return view('users.thuphi.list_receipt',['nganh' => $nganh]);
	
    }

    public function post_insert(Request $request,$muc_thu,$ma_sv)
    {
        /*$validation = Validator::make($request->all(),
            [
                'txtContent'    => 'required'
            ],
            [
    
                'txtContent.required'   => 'Vui lòng nhập nội dung thu!'
            ]
        );

        $error_array=array();
        $success='';

        if($validation->fails())
        {
            foreach ($validation->messages()->getMessages() as $field_name => $messages) {
                $error_array[]=$messages;
            }
        }else
        {*/$success='';
            if($request->get('button_action') == "insert")
            {
                $obj=new PhieuThuModel();
                $max_id= PhieuThuModel::getID();
                $dot_thu= PhieuThuModel::dot_thu($ma_sv);
                $lan_thu=PhieuThuModel::where('sinh_vien_ma',$ma_sv)->max('lan_thu');

                $sinh_vien=SinhVienModel::getByID($ma_sv);
                $muc_thu_ht=MucThuModel::getByID($muc_thu);
                $so_thang=$muc_thu_ht->so_thang;

                $dot_thu_max=PhieuThuModel::where('sinh_vien_ma',$ma_sv)->max('dot_thu');
                
                if(count($dot_thu_max) == 0)
                {
                    $thang_da_nop=8;
                    $nam_hoc=date('Y', strtotime($sinh_vien->ngay_bat_dau));

                    if($lan_thu == '')
                    {
                        $lan_thu=1;
                    }else{
                        $lan_thu=$lan_thu+1;
                    }
                    $nguoi_thu= session()->get('users.ho_ten');
                    
                    $limit_so_lan_nop=30;  // mặc định số lần phải nộp chung tất cả các hình thức

                    if($so_thang == 10)// kiểm tra hình thức nộp theo năm
                    {
                        $obj->thoi_gian_thu  =   new Carbon();
                        $obj->nguoi_thu      =   $nguoi_thu;   
                        $obj->so_tien_thu    =   $request->txtSoTienThu/$so_thang;
                        $obj->noi_dung       =   $request->txtContent;
                        
                        $obj->sinh_vien_ma   =   $ma_sv;
                        $obj->muc_thu_ma     =   $muc_thu;
                        $obj->ma_phieu_thu   =   $max_id;
                        $obj->dot_thu        =   $dot_thu;
                        $obj->lan_thu        =   $lan_thu;
                        $obj->thang_da_nop   =   $thang_da_nop;
                        $obj->nam_hoc        =   $nam_hoc;
                        for($i = 0; $i < $so_thang; $i++)
                        {
                            $obj->dot_thu    =$dot_thu++;
                            if($obj->thang_da_nop ==12)
                            {
                                $obj->thang_da_nop  =1;
                                $nam_hoc++;
                                $obj->nam_hoc       =  $nam_hoc;
                            }elseif ($obj->thang_da_nop ==1) {
                                $obj->thang_da_nop  =2;
                                $obj->nam_hoc       =  $nam_hoc;
                            }elseif ($obj->thang_da_nop ==2) {
                                $obj->thang_da_nop  =3;
                                $obj->nam_hoc       =  $nam_hoc;
                            }elseif ($obj->thang_da_nop ==3) {
                                $obj->thang_da_nop  =4;
                                $obj->nam_hoc       =  $nam_hoc;
                            }elseif ($obj->thang_da_nop ==4) {
                                $obj->thang_da_nop  =5;
                                $obj->nam_hoc       =  $nam_hoc;
                            }
                            else if($obj->thang_da_nop==5)
                            {
                                $obj->thang_da_nop=8;
                                $obj->nam_hoc     =  $nam_hoc;
                            }
                            else
                            {
                                $obj->thang_da_nop  =  $thang_da_nop++;
                                $obj->nam_hoc       =  $nam_hoc;
                            }
                            $obj->ma_phieu_thu  =  $max_id++;
                            PhieuThuModel::insert($obj);
                            SinhVienModel::update_muc_thu($ma_sv,$muc_thu);
                        }
                    }elseif ($so_thang==30) //// kiểm tra hình thức nộp theo niên học
                    {
                        $obj->thoi_gian_thu  =   new Carbon();
                        $obj->nguoi_thu      =   $nguoi_thu;   
                        $obj->so_tien_thu    =   $request->txtSoTienThu/$so_thang;
                        $obj->noi_dung       =   $request->txtContent;
                        
                        $obj->sinh_vien_ma   =   $ma_sv;
                        $obj->muc_thu_ma     =   $muc_thu;
                        $obj->ma_phieu_thu   =   $max_id;
                        $obj->dot_thu        =   $dot_thu;
                        $obj->lan_thu        =   $lan_thu;
                        $obj->thang_da_nop   =   $thang_da_nop;
                        $obj->nam_hoc        =   $nam_hoc;
                        for($i = 0; $i < $so_thang-20; $i++)
                        {
                            $obj->dot_thu    =$dot_thu++;
                            if($obj->thang_da_nop ==12)
                            {
                                $obj->thang_da_nop  =1;
                                $nam_hoc++;
                                $obj->nam_hoc       =  $nam_hoc;
                            }elseif ($obj->thang_da_nop ==1) {
                                $obj->thang_da_nop  =2;
                                $obj->nam_hoc       =  $nam_hoc;
                            }elseif ($obj->thang_da_nop ==2) {
                                $obj->thang_da_nop  =3;
                                $obj->nam_hoc       =  $nam_hoc;
                            }elseif ($obj->thang_da_nop ==3) {
                                $obj->thang_da_nop  =4;
                                $obj->nam_hoc       =  $nam_hoc;
                            }elseif ($obj->thang_da_nop ==4) {
                                $obj->thang_da_nop  =5;
                                $obj->nam_hoc       =  $nam_hoc;
                            }
                            else if($obj->thang_da_nop==5)
                            {
                                $obj->thang_da_nop=8;
                                $obj->nam_hoc     =  $nam_hoc;
                            }
                            else
                            {
                                $obj->thang_da_nop  =  $thang_da_nop++;
                                $obj->nam_hoc       =  $nam_hoc;
                            }
                            $obj->ma_phieu_thu  =  $max_id++;
                            PhieuThuModel::insert($obj);
                        }

                        for($i = 0; $i < $so_thang-10; $i++)
                        {
                            $obj->dot_thu    =$dot_thu++;
                            if($obj->thang_da_nop ==12)
                            {
                                $obj->thang_da_nop  =1;
                                $nam_hoc++;
                                $obj->nam_hoc       =  $nam_hoc;
                            }elseif ($obj->thang_da_nop ==1) {
                                $obj->thang_da_nop  =2;
                                $obj->nam_hoc       =  $nam_hoc;
                            }elseif ($obj->thang_da_nop ==2) {
                                $obj->thang_da_nop  =3;
                                $obj->nam_hoc       =  $nam_hoc;
                            }elseif ($obj->thang_da_nop ==3) {
                                $obj->thang_da_nop  =4;
                                $obj->nam_hoc       =  $nam_hoc;
                            }elseif ($obj->thang_da_nop ==4) {
                                $obj->thang_da_nop  =5;
                                $obj->nam_hoc       =  $nam_hoc;
                            }else if($obj->thang_da_nop==5)
                            {
                                $obj->thang_da_nop=8;
                                $obj->nam_hoc     =  $nam_hoc;
                            }else if($obj->thang_da_nop ==8)
                            {
                                $obj->thang_da_nop  =9;
                                $obj->nam_hoc       =  $nam_hoc;
                            }else if ($obj->thang_da_nop ==9) {
                                $obj->thang_da_nop  =10;
                                $obj->nam_hoc       =  $nam_hoc;
                            }elseif ($obj->thang_da_nop ==10) {
                                $obj->thang_da_nop  =11;
                                $obj->nam_hoc       =  $nam_hoc;
                            }elseif ($obj->thang_da_nop ==11) {
                                $obj->thang_da_nop  =12;
                                $obj->nam_hoc       =  $nam_hoc;
                            }else
                            {
                                $obj->thang_da_nop  =  $thang_da_nop++;
                                $obj->nam_hoc       =  $nam_hoc;
                            }
                            $obj->ma_phieu_thu  =  $max_id++;
                            PhieuThuModel::insert($obj);
                            SinhVienModel::update_muc_thu($ma_sv,$muc_thu);
                        }
                    }else {
                        $obj->thoi_gian_thu  =   new Carbon();
                        $obj->nguoi_thu      =   $nguoi_thu;   
                        $obj->so_tien_thu    =   $request->txtSoTienThu/$so_thang;
                        $obj->noi_dung       =   $request->txtContent;
                        
                        $obj->sinh_vien_ma   =   $ma_sv;
                        $obj->muc_thu_ma     =   $muc_thu;
                        $obj->ma_phieu_thu   =   $max_id;
                        $obj->dot_thu        =   $dot_thu;
                        $obj->lan_thu        =   $lan_thu;
                        $obj->thang_da_nop   =   $thang_da_nop;
                        $obj->nam_hoc        =   $nam_hoc;
                        for($i = 0; $i < $so_thang; $i++)
                        {
                            $obj->dot_thu    =$dot_thu++;
                            if($obj->thang_da_nop ==12)
                            {
                                $obj->thang_da_nop  =1;
                                $obj->nam_hoc       =  $nam_hoc++;
                            }
                            else if($obj->thang_da_nop==5)
                            {
                                $obj->thang_da_nop=8;
                                $obj->nam_hoc        =   $nam_hoc;
                            }
                            else
                            {
                                $obj->thang_da_nop  =  $thang_da_nop++;
                                $obj->nam_hoc        =   $nam_hoc;
                            }
                            $obj->ma_phieu_thu  =  $max_id++;
                            PhieuThuModel::insert($obj);
                            SinhVienModel::update_muc_thu($ma_sv,$muc_thu);
                        }
                    }

                    
                    $success="Thu phí thành thành công";    

                }else
                {
                    $value=PhieuThuModel::select('thang_da_nop','nam_hoc')->where('dot_thu',$dot_thu_max)->first();
                    $thang_da_nop=$value->thang_da_nop;
                    $nam_hoc=$value->nam_hoc;
                    if($thang_da_nop ==12)
                    {
                        $thang_da_nop=1;
                        $nam_hoc=$value->nam_hoc+1;
                    }else if($thang_da_nop==5)
                    {
                        $thang_da_nop=8;
                        $nam_hoc=$value->nam_hoc;
                    }
                    else
                    {
                        $thang_da_nop=$value->thang_da_nop+1;
                        $nam_hoc=$value->nam_hoc;
                    }
                      
                    if($lan_thu == '')
                    {
                        $lan_thu=1;
                    }else{
                        $lan_thu=$lan_thu+1;
                    }
                    $nguoi_thu= session()->get('users.ho_ten');
                    
                    $limit_so_lan_nop=30;  // mặc định số lần phải nộp chung tất cả các hình thức

                    $so_lan_nop_con_lai=$limit_so_lan_nop - $dot_thu;

                    if($so_thang == 3 && ($value->thang_da_nop ==10 || $value->thang_da_nop ==3))// kiểm tra hình thức nộp theo quý
                    {
                        $obj->thoi_gian_thu  =   new Carbon();
                        $obj->nguoi_thu      =   $nguoi_thu;   
                        $obj->so_tien_thu    =   $request->txtSoTienThu/2;
                        $obj->noi_dung       =   $request->txtContent;
                        
                        $obj->sinh_vien_ma   =   $ma_sv;
                        $obj->muc_thu_ma     =   $muc_thu;
                        $obj->ma_phieu_thu   =   $max_id;
                        $obj->dot_thu        =   $dot_thu;
                        $obj->lan_thu        =   $lan_thu;
                        $obj->thang_da_nop   =   $thang_da_nop;
                        $obj->nam_hoc        =   $nam_hoc;
                    
                        
                        for($i = 0; $i < 2; $i++)
                        {
                            $obj->dot_thu           =  $dot_thu++;
                            $obj->thang_da_nop      =  $thang_da_nop++;
                            $obj->nam_hoc           =   $nam_hoc;
                            $obj->ma_phieu_thu      =  $max_id++;
                            PhieuThuModel::insert($obj);
                            SinhVienModel::update_muc_thu($ma_sv,$muc_thu);
                        }
                        
                    }
                    elseif($so_thang == 10) {
                        $obj->thoi_gian_thu  =   new Carbon();
                        $obj->nguoi_thu      =   $nguoi_thu;   
                        $obj->so_tien_thu    =   $request->txtSoTienThu/$so_thang;
                        $obj->noi_dung       =   $request->txtContent;
                        
                        $obj->sinh_vien_ma   =   $ma_sv;
                        $obj->muc_thu_ma     =   $muc_thu;
                        $obj->ma_phieu_thu   =   $max_id;
                        $obj->dot_thu        =   $dot_thu;
                        $obj->lan_thu        =   $lan_thu;
                        $obj->thang_da_nop   =   $thang_da_nop;
                        $obj->nam_hoc        =   $nam_hoc;
                        for($i = 0; $i < $so_thang; $i++)
                        {
                            $obj->dot_thu    =$dot_thu++;
                            if($obj->thang_da_nop ==12)
                            {
                                $obj->thang_da_nop  =1;
                                $nam_hoc++;
                                $obj->nam_hoc       =  $nam_hoc;
                            }elseif ($obj->thang_da_nop ==1) {
                                $obj->thang_da_nop  =2;
                                $obj->nam_hoc       =  $nam_hoc;
                            }elseif ($obj->thang_da_nop ==2) {
                                $obj->thang_da_nop  =3;
                                $obj->nam_hoc       =  $nam_hoc;
                            }elseif ($obj->thang_da_nop ==3) {
                                $obj->thang_da_nop  =4;
                                $obj->nam_hoc       =  $nam_hoc;
                            }elseif ($obj->thang_da_nop ==4) {
                                $obj->thang_da_nop  =5;
                                $obj->nam_hoc       =  $nam_hoc;
                            }
                            else if($obj->thang_da_nop==5)
                            {
                                $obj->thang_da_nop=8;
                                $obj->nam_hoc     =  $nam_hoc;
                            }
                            else
                            {
                                $obj->thang_da_nop  =  $thang_da_nop++;
                                $obj->nam_hoc       =  $nam_hoc;
                            }
                            $obj->ma_phieu_thu  =  $max_id++;
                            PhieuThuModel::insert($obj);
                            SinhVienModel::update_muc_thu($ma_sv,$muc_thu);
                        }
                        
                    }else {
                        $obj->thoi_gian_thu  =   new Carbon();
                        $obj->nguoi_thu      =   $nguoi_thu;   
                        $obj->so_tien_thu    =   $request->txtSoTienThu/$so_thang;
                        $obj->noi_dung       =   $request->txtContent;
                        
                        $obj->sinh_vien_ma   =   $ma_sv;
                        $obj->muc_thu_ma     =   $muc_thu;
                        $obj->ma_phieu_thu   =   $max_id;
                        $obj->dot_thu        =   $dot_thu;
                        $obj->lan_thu        =   $lan_thu;
                        $obj->thang_da_nop   =   $thang_da_nop;
                        $obj->nam_hoc        =   $nam_hoc;
                        for($i = 0; $i < $so_thang; $i++)
                        {
                            $obj->dot_thu    =$dot_thu++;
                            $obj->thang_da_nop  =  $thang_da_nop++;
                            $obj->nam_hoc       =  $nam_hoc;
                            $obj->ma_phieu_thu  =  $max_id++;
                            PhieuThuModel::insert($obj);
                            SinhVienModel::update_muc_thu($ma_sv,$muc_thu);
                        }
                    }
                $success="Thu phí thành thành công";  
                }
                 

            }
       /* }*/

        return response()->json([
            /*'error' => $error_array,*/
            'success' => $success
        ]);
       
    }

    public function get_print($id)
    {
        $lan_thu=PhieuThuModel::where('sinh_vien_ma',$id)->max('lan_thu');
        $print_phieu_thu=PhieuThuModel::get_print_PT($id,$lan_thu);
        /*$dot_thu=PhieuThuModel::dot_thu_group($lan_thu,$id);
        $add_dot_thu=array();
        $nested=array();
        $thang_arr=array();
        foreach ($dot_thu as $obj) {
            $add_dot_thu[]=$obj->dot_thu;
            $nam=$obj->nam_hoc;
            $thang_arr[]=$obj->thang_da_nop;
        }
        $count=count($thang_arr);
        if($count == 5)
        {
            $dot_thu_max=PhieuThuModel::where('sinh_vien_ma',$id)->where('lan_thu',$lan_thu)->max('dot_thu');
            if($dot_thu_max == 5)
            {
                $nested='học kỳ 1';
            }elseif ($dot_thu_max == 10) {
                $nested='học kỳ 2';
            }elseif ($dot_thu_max == 15) {
                $nested='học kỳ 3';
            }elseif ($dot_thu_max == 20) {
                $nested='học kỳ 4';
            }elseif ($dot_thu_max == 25) {
                $nested='học kỳ 5';
            }else{
                $nested='học kỳ 6';
            }
        }elseif ($count == 10) {
            $nam_hoc_group=PhieuThuModel::nam_hoc_group($lan_thu,$id);
            $nam_hoc_arr=array();
            foreach ($nam_hoc_group as $value_nam_hoc) {
                $nam_hoc_arr[]=$value_nam_hoc->nam_hoc;
            }
            $nested='năm học '.implode("-", $nam_hoc_arr);//lấy 2 số năm của đợt  đóng theo năm
        }elseif ($count == 30) {
            $time=KhoaHocModel::getByID($print_phieu_thu->khoa_hoc_ma);
            $start=date('Y',strtotime($time->ngay_bat_dau));
            $end=date('Y',strtotime($time->ngay_ket_thuc));
            $nested='niên học '.$start.'-'.$end;// lấy year của ngay_bat_dau và ngay_ket_thuc
        }else {
            $nested='đợt '.implode("+", $add_dot_thu).' (Tháng '.implode("+", $thang_arr).'/'.$nam.')';
        }*/

        $ma_nganh=$print_phieu_thu->nganh_ma;

        $max_muc_thu_theo_nganh=MucThuModel::where("nganh_ma",$ma_nganh)->max('muc_thu_qui_dinh');

        return response()->json([
            "phieu_thu" => $print_phieu_thu,
           /* "dot_thu"   => $nested,*/
            "max_muc_thu" => $max_muc_thu_theo_nganh
        ]);

    }


    public function get_phi_nganh()
    {
    	$nganh=NganhModel::getAll();
    	return view('users.thong_ke.thu_phi_theo_nganh',['nganh' => $nganh]);
    }

    public function get_phi_lop()
    {
    	$nganh=NganhModel::getAll();
    	return view('users.thong_ke.thong_ke_theo_lop',['nganh' => $nganh]);
    }

    public function get_no_phi()
    {
    	$nganh=NganhModel::getAll();
    	return view('users.thong_ke.list_no_phi',['nganh' => $nganh]);
    }

    public function get_mop_muon()
    {
    	$nganh=NganhModel::getAll();
    	return view('users.thong_ke.hoc_vien_nop_muon',['nganh' => $nganh]);
    }

    public function list_chua_nop($ma_lop,$start)
    {
        /*  Cách tính lấy số tháng chưa nộp */
        $month_now=date('m');
        $year_now=date('Y');
        $month=date('m',strtotime($start));
        $year=date('Y',strtotime($start));
        //---------------------------------------
        $da_nop=PhieuThuModel::get_da_nop($ma_lop,$month,$year,$month_now,$year_now);
        $count=count($da_nop);
       if($count == 0)
        {
            $sinh_vien=SinhVienModel::list_SV_chi_tiet($ma_lop);
        }else {
            $ma_sv=array();
            foreach ($da_nop as $value) {
                $ma_sv[]=$value->sinh_vien_ma;
            }

            $ma_sv_da_nop=array();
            for($i=0; $i<$count ; $i++)
            {
                $so_thang_hien_tai=PhieuThuModel::select('thang_da_nop','sinh_vien_ma')->where('sinh_vien_ma',$ma_sv[$i])->where('thang_da_nop',$month_now)->where('nam_hoc',$year_now)->first();
                if(count($so_thang_hien_tai) >0)
                {
                    $ma_sv_da_nop[]="'".$so_thang_hien_tai->sinh_vien_ma."'";
                }else {
                    $ma_sv_da_nop[]="' '";
                } 
            }
            $limit=implode(",", $ma_sv_da_nop);
            $sinh_vien=SinhVienModel::chua_nop($ma_lop,$limit);
        }
        /*DB::enableQueryLog();
        dd(DB::getQueryLog());*/
        $data=array();
        $nested=array();
        foreach ($sinh_vien as $obj) {
            $nested['ma_sinh_vien']     =$obj->ma_sinh_vien;
            $nested['ten_sinh_vien']    =$obj->ten_sinh_vien;
            $nested['ngay_sinh']        =date('d/m/Y',strtotime($obj->ngay_sinh));
            $nested['email']            =$obj->email;
            $nested['sdt']              =$obj->sdt;
            if($obj->gioi_tinh == 1 )
            {
               $nested['gioi_tinh']= "Nam";
            }
            else{
                $nested['gioi_tinh']="Nữ";
            }
            $nested['ten_lop']      = $obj->ten_lop;
            $nested['ten_nganh']    = $obj->ten_nganh;
            $nested['ten_khoa_hoc'] = $obj->ten_khoa_hoc;
            $nested['khoa_hoc_ma']  = $obj->khoa_hoc_ma;
            
            $hoc_phi=MucThuModel::get_muc_thu_thang($obj->nganh_ma,1);
            $phi_qui_dinh=$hoc_phi->muc_thu_qui_dinh;
            $hoc_bong=$obj->ty_le_phan_tram/100;
            $phi_giam=$hoc_phi->ty_le_giam/100;
            $so_tien_can_nop=$phi_qui_dinh-($phi_qui_dinh*($hoc_bong+$phi_giam));

            $dot_thu=PhieuThuModel::where('sinh_vien_ma',$obj->ma_sinh_vien)->max('dot_thu');
           if(count($dot_thu) > 0)
            {
                if($year == $year_now && $month == $month_now )
                {
                    $nested['so_tien_can_nop']=number_format(round($so_tien_can_nop, -3, PHP_ROUND_HALF_UP),0,",",".");
                }elseif ($month >5 && $month <8) {
                    $so_thang_can_nop=$month_now-8;
                    $nested['so_tien_can_nop']=number_format(round($so_tien_can_nop*($so_thang_can_nop+1), -3, PHP_ROUND_HALF_UP),0,",",".");
                }
                else{
                    $date=PhieuThuModel::select('thang_da_nop','nam_hoc')->where('dot_thu',$dot_thu)->where('sinh_vien_ma',$obj->ma_sinh_vien)->first();
                    $thang_da_nop=$date->thang_da_nop;
                    if($thang_da_nop < 10)
                    {
                        $thang_da_nop='0'.$thang_da_nop;
                    }
                    $nam_hoc=$date->nam_hoc;
                    $date_string=$nam_hoc.'-'.$thang_da_nop.'-01';
                    if($start <= $date_string)
                    {
                        if($month_now >= 8)
                        {
                            if($month <=5|| ($month >=8 && $year < $year_now))
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
                            }elseif ($month >=8 && $year_now ==$year) {
                                $year_num=($year_now-$nam_hoc)*12;
                                $month_num=$month_now-$thang_da_nop;
                                $so_thang_chua_nop=$year_num+$month_num;
                                $nested['so_tien_can_nop']=number_format(round($so_tien_can_nop*$so_thang_chua_nop, -3, PHP_ROUND_HALF_UP),0,",",".");
                            }
                            
                        }else {
                            $year_num=($year_now-$nam_hoc)*12;
                            $month_num=$month_now-$thang_da_nop;
                            $so_thang_chua_nop=$year_num+$month_num;
                            $nested['so_tien_can_nop']=number_format(round($so_tien_can_nop*$so_thang_chua_nop, -3, PHP_ROUND_HALF_UP),0,",",".");
                        }
                        
                    } 

                    else
                    {
                        if($month_now >= 8)
                        {
                            if($month <=5 || ($month >=8 && $year < $year_now))
                            {
                                $year_num=($year_now-$year)*12;
                                $month_du=2;
                                if($year_now-$year == 2)
                                {
                                    $month_num=$month_now-$month-($month_du*2);
                                }else if ($year_now-$year == 3) {
                                    $month_num=$month_now-$month-($month_du*3);
                                }else {
                                    $month_num=$month_now-$month-$month_du;
                                }
                                $so_thang_chua_nop=$year_num+$month_num+1;
                                $nested['so_tien_can_nop']=number_format(round($so_tien_can_nop*$so_thang_chua_nop, -3, PHP_ROUND_HALF_UP),0,",",".");
            
                            }elseif ($month >=8 && $year_now ==$year) {
                                $year_num=($year_now-$year)*12;
                                $month_num=$month_now-$month;
                                $so_thang_chua_nop=$year_num+$month_num+1;
                                $nested['so_tien_can_nop']=number_format(round($so_tien_can_nop*$so_thang_chua_nop, -3, PHP_ROUND_HALF_UP),0,",",".");
                            }
                        }else {
                            $year_num=($year_now-$year)*12;
                            $month_num=$month_now-$month;
                            $so_thang_chua_nop=$year_num+$month_num+1;
                            $nested['so_tien_can_nop']=number_format(round($so_tien_can_nop*$so_thang_chua_nop, -3, PHP_ROUND_HALF_UP),0,",",".");
                        }
                            
                        
                    }
                   
                }
                
            }else
            {
                if($year == $year_now && $month == $month_now)
                {
                    $nested['so_tien_can_nop']=number_format(round($so_tien_can_nop, -3, PHP_ROUND_HALF_UP),0,",",".");

                }elseif ($month >5 && $month <8) {
                    $so_thang_can_nop=$month_now-8;
                    $nested['so_tien_can_nop']=number_format(round($so_tien_can_nop*($so_thang_can_nop+1), -3, PHP_ROUND_HALF_UP),0,",",".");
                }else{
                    $date=SinhVienModel::getByID($obj->ma_sinh_vien);
                    $thang_bat_dau=date('m',strtotime($date->ngay_bat_dau));
                    $nam_hoc=date('Y',strtotime($date->ngay_bat_dau));
                    if($month <= $thang_bat_dau && $year < $nam_hoc)
                    {
                        if($month_now >= 8)
                        {
                            if($month <=5 || ($month >=8 && $year < $year_now))
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
                                $so_thang_chua_nop=$year_num+$month_num;
                                $nested['so_tien_can_nop']=number_format(round($so_tien_can_nop*$so_thang_chua_nop, -3, PHP_ROUND_HALF_UP),0,",",".");
                            }elseif ($month >=8 && $year_now ==$year) {
                                $year_num=($year_now-$nam_hoc)*12;
                                $month_num=$month_now-$thang_bat_dau;
                                $so_thang_chua_nop=$year_num+$month_num;
                                $nested['so_tien_can_nop']=number_format(round($so_tien_can_nop*$so_thang_chua_nop, -3, PHP_ROUND_HALF_UP),0,",",".");
                            }
                        }else {
                            $year_num=($year_now-$nam_hoc)*12;
                            $month_num=$month_now-$thang_bat_dau;
                            $so_thang_chua_nop=$year_num+$month_num;
                            $nested['so_tien_can_nop']=number_format(round($so_tien_can_nop*$so_thang_chua_nop, -3, PHP_ROUND_HALF_UP),0,",",".");
                        }
                        
                    }else{
                        if($month_now >= 8 )
                        {
                            if($month <=5 || ($month >=8 && $year < $year_now))
                            {
                                $year_num=($year_now-$year)*12;
                                $month_du=2;
                                if($year_now-$year == 2)
                                {
                                    $month_num=$month_now-$month-($month_du*2);
                                }elseif ($year_now-$year == 3) {
                                    $month_num=$month_now-$month-($month_du*3);
                                }else {
                                    $month_num=$month_now-$month-$month_du;
                                }
                                $so_thang_chua_nop=$year_num+$month_num+1;
                                $nested['so_tien_can_nop']=number_format(round($so_tien_can_nop*$so_thang_chua_nop, -3, PHP_ROUND_HALF_UP),0,",",".");
                            }elseif ($month >=8 && $year_now ==$year) {
                                $year_num=($year_now-$year)*12;
                                $month_num=$month_now-$month;
                                $so_thang_chua_nop=$year_num+$month_num+1;
                                $nested['so_tien_can_nop']=number_format(round($so_tien_can_nop*$so_thang_chua_nop, -3, PHP_ROUND_HALF_UP),0,",",".");
                            }
                        }else {
                            $year_num=($year_now-$year)*12;
                            $month_num=$month_now-$month;
                            $so_thang_chua_nop=$year_num+$month_num+1;
                            $nested['so_tien_can_nop']=number_format(round($so_tien_can_nop*$so_thang_chua_nop, -3, PHP_ROUND_HALF_UP),0,",",".");
                        }
                        
                    }
                }
            }
        
            $data[]=$nested;
        }
       return response()->json($data);
    }

    public function bao_cao_theo_lop($ma_lop,$start,$end)
    {
        $thong_ke=PhieuThuModel::get_bao_cao_theo_lop($ma_lop,$start,$end);
        $data = array();
        $nested=array();
        foreach ($thong_ke as $value) {
            $hoc_bong=$value->ty_le_phan_tram/100;
            $ty_le_uu_dai=$value->ty_le_giam/100;
            $phi_qui_dinh=round($value->muc_thu_qui_dinh, -3, PHP_ROUND_HALF_UP);
            $nested['ten_sinh_vien']=$value->ten_sinh_vien;
            $nested['ten_nganh']=$value->ten_nganh;
            $nested['ten_khoa_hoc']=$value->ten_khoa_hoc;
            $nested['khoa_hoc_ma']=$value->khoa_hoc_ma;
            $nested['ten_lop']=$value->ten_lop;
            $nested['thoi_gian_thu']=date('d-m-Y h:m:i A', strtotime($value->thoi_gian_thu));
            Carbon::setLocale('vi');
            $nested['doc_time']=  Carbon::createFromTimeStamp(strtotime($value->thoi_gian_thu))->diffForHumans();
            $nested['ten_hinh_thuc']=$value->ten_hinh_thuc;
           /* $nested['muc_thu_qui_dinh']=number_format($phi_qui_dinh,0,",",".");*/

            $phi_giam=$phi_qui_dinh*$hoc_bong;
            $phi_giam=round($phi_giam, -3, PHP_ROUND_HALF_UP);
            $nested['hoc_bong']=number_format($phi_giam,0,",",".");

            /*$ty_le_uu_dai=$phi_qui_dinh*$ty_le_uu_dai;
            $ty_le_uu_dai=round($ty_le_uu_dai, -3, PHP_ROUND_HALF_UP);
            $nested['so_tien_giam']=number_format($ty_le_uu_dai,0,",",".");*/

            $nested['so_tien_thu']=number_format($value->so_tien_thu,0,",",".");

            $nested['noi_dung']=$value->noi_dung;
            $data[]=$nested;
        }
        $count_dem=count($data);
        return response()->json([
            'thong_ke'  =>  $data,
            'count' =>  $count_dem
        ]);
    }

    public function nop_hp_muon($ma_lop,$month,$year)
    {
        $thong_ke=PhieuThuModel::nop_muon($ma_lop,$month,$year);
        $ma_sv_nop_muon=array();
        foreach ($thong_ke as $value) {
            $thoi_gian_thu=$value->thoi_gian_thu;
            $ngay_nop=date('d',strtotime($thoi_gian_thu));
            $thang_nop=date('m',strtotime($thoi_gian_thu));
            if($month < 10)
            {
                $month='0'.$month;
            }
            $nam_nop=date('Y',strtotime($thoi_gian_thu));
            $date=date('Y-m-d',strtotime($thoi_gian_thu));
            $date_string=$year.'-'.$month.'-01';
            $ngay_qui_dinh=20;
            $so_thang=$value->so_thang;
           if(($thang_nop > $month && $nam_nop == $year) || ($thang_nop == $month && $nam_nop > $year)  ||($thang_nop == $month && $nam_nop == $year && $ngay_nop > $ngay_qui_dinh))
            {
                $ma_sv_nop_muon[]=$value->sinh_vien_ma;
            }else if($date > $date_string){
                $ma_sv_nop_muon[]=$value->sinh_vien_ma;
            }else if ($date <= $date_string) {
                $ma_sv_nop_muon[]='';
            }
        }
        $arr_ma_sv=array();
        for($i=0; $i<count($ma_sv_nop_muon); $i++)
        {
            if($ma_sv_nop_muon[$i] != null)
            {
                $arr_ma_sv[]=PhieuThuModel::get_sinh_vien_thoi_gian_thu($ma_sv_nop_muon[$i],$month,$year);
            }
        }

        return response()->json(['sinh_vien' => $arr_ma_sv,'count' => count($arr_ma_sv)]);

    }
}

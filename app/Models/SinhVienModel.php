<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Carbon\Carbon;
class SinhVienModel extends Model
{
    protected $table = 'tbl_sinhvien';
    protected $fillable = ['ma_sinh_vien','ten_sinh_vien','ngay_sinh','email','gioi_tinh','sdt','dia_chi','trang_thai','hoc_bong_ma','lop_ma','muc_thu_ma'];
    public $timestamps = false;

    static function getAll()
    {
    	$sinhvien = DB::select("
            SELECT
                tbl.*,tbl_nganh.ten_nganh,tbl_nganh.he_dao_tao,tbl_khoahoc.ten_khoa_hoc,tbl_khoahoc.ngay_bat_dau, tbl_khoahoc.ngay_ket_thuc,tbl_hinhthucnop.ten_hinh_thuc
            from 
                (SELECT  
                    tbl_sinhvien.*,tbl_hocbong.ten_hoc_bong,tbl_hocbong.ty_le_phan_tram,tbl_lop.ten_lop,tbl_lop.nganh_ma, tbl_lop.khoa_hoc_ma,tbl_lop.si_so,tbl_lop.giao_vien_chu_nhiem,tbl_mucthu.hinh_thuc_ma,tbl_mucthu.muc_thu_qui_dinh
                from tbl_sinhvien   
                    inner join tbl_hocbong on tbl_sinhvien.hoc_bong_ma=tbl_hocbong.ma_hoc_bong 
                    inner join tbl_lop on tbl_sinhvien.lop_ma=tbl_lop.ma_lop
                    inner join tbl_mucthu on tbl_sinhvien.muc_thu_ma=tbl_mucthu.ma_muc_thu
                )tbl 
            inner join tbl_nganh on tbl.nganh_ma=tbl_nganh.ma_nganh
            inner join tbl_khoahoc on tbl.khoa_hoc_ma=tbl_khoahoc.ma_khoa_hoc
            inner join tbl_hinhthucnop on tbl.hinh_thuc_ma=tbl_hinhthucnop.ma_hinh_thuc");
    	return $sinhvien;
    }

    static function getAll_TinhTrang()
    {
        $sinhvien=DB::select('SELECT ma_sinh_vien from tbl_sinhvien where trang_thai=1');
        return $sinhvien;
    }

    static function getID()
    {
        $max_id=DB::table('tbl_sinhvien')->max('ma_sinh_vien');
        if($max_id == '')
        {
            $max_id ="SV0001";
        }else
        {
            $id=substr($max_id,-4);
            $id=(int)$id + 1;
            $id=(string)$id;
            $id=str_pad($id,4,"0",STR_PAD_LEFT);
            $max_id="SV{$id}";
        }
        return  $max_id;
    }

    static function getByID($id)
    {
    	$sv_id=DB::select("
            SELECT
                tbl.*,tbl_nganh.ma_nganh,tbl_nganh.ten_nganh,tbl_nganh.he_dao_tao,tbl_khoahoc.ma_khoa_hoc,tbl_khoahoc.ten_khoa_hoc,tbl_khoahoc.ngay_bat_dau, tbl_khoahoc.ngay_ket_thuc,tbl_hinhthucnop.ten_hinh_thuc,tbl_hinhthucnop.so_thang,tbl_hinhthucnop.ty_le_giam
            from 
                (SELECT  
                    tbl_sinhvien.*,tbl_hocbong.ten_hoc_bong,tbl_hocbong.ty_le_phan_tram,tbl_lop.ten_lop,tbl_lop.nganh_ma, tbl_lop.khoa_hoc_ma,tbl_lop.si_so,tbl_lop.giao_vien_chu_nhiem,tbl_mucthu.hinh_thuc_ma,tbl_mucthu.muc_thu_qui_dinh
                from tbl_sinhvien   
                    inner join tbl_hocbong on tbl_sinhvien.hoc_bong_ma=tbl_hocbong.ma_hoc_bong 
                    inner join tbl_lop on tbl_sinhvien.lop_ma=tbl_lop.ma_lop 
                    inner join tbl_mucthu on tbl_sinhvien.muc_thu_ma=tbl_mucthu.ma_muc_thu
                    where tbl_sinhvien.ma_sinh_vien=?                
                )tbl 
            inner join tbl_nganh on tbl.nganh_ma=tbl_nganh.ma_nganh
            inner join tbl_khoahoc on tbl.khoa_hoc_ma=tbl_khoahoc.ma_khoa_hoc
            inner join tbl_hinhthucnop on tbl.hinh_thuc_ma=tbl_hinhthucnop.ma_hinh_thuc",[$id]);
    	return $sv_id[0];

    }

    static function insert_SV($obj)
    {
        $id             =   $obj->ma_sinh_vien;
       	$name_sv        =   $obj->ten_sinh_vien;
       	$ngay_sinh      =   $obj->ngay_sinh;
       	$email          =   $obj->email;
       	$gioi_tinh      =   $obj->gioi_tinh;
        $sdt            =   $obj->sdt;
       	$dia_chi        =   $obj->dia_chi;
       	$trang_thai     =   $obj->trang_thai;
        $hoc_bong_ma    =   $obj->hoc_bong_ma;
        $lop_ma         =   $obj->lop_ma;
        $muc_thu_ma     =   $obj->muc_thu_ma;
        DB::insert("INSERT into tbl_sinhvien(ma_sinh_vien,ten_sinh_vien,ngay_sinh,email,gioi_tinh,sdt,dia_chi,trang_thai,hoc_bong_ma,lop_ma,muc_thu_ma) values('$id','$name_sv','$ngay_sinh','$email','$gioi_tinh','$sdt','$dia_chi','$trang_thai','$hoc_bong_ma','$lop_ma','$muc_thu_ma')");
    }

    static function updateSV($obj)
    {
    	$id             =   $obj->ma_sinh_vien;
        $name_sv        =   $obj->ten_sinh_vien;
        $ngay_sinh      =   $obj->ngay_sinh;
        $email          =   $obj->email;
        $gioi_tinh      =   $obj->gioi_tinh;
        $sdt            =   $obj->sdt;
        $dia_chi        =   $obj->dia_chi;
        $trang_thai     =   $obj->trang_thai;
        $hoc_bong_ma    =   $obj->hoc_bong_ma;
        $muc_thu_ma     =   $obj->muc_thu_ma;
    	$sinh_vien=DB::update(" UPDATE tbl_sinhvien set 
            ten_sinh_vien = ?,
            ngay_sinh     = ?,
            email         = ?,
            gioi_tinh     = ?,
            sdt           = ?,
            dia_chi       = ?,
            trang_thai    = ?,
            hoc_bong_ma   = ?,
            muc_thu_ma    = ?
            where ma_sinh_vien=?",[$name_sv,$ngay_sinh,$email,$gioi_tinh,$sdt,$dia_chi,$trang_thai,$hoc_bong_ma,$muc_thu_ma,$id]);
    	return $sinh_vien;
    } 

    static function update_muc_thu($id,$muc_thu)
    {
        DB::update("UPDATE tbl_sinhvien set muc_thu_ma = ? where ma_sinh_vien=?",[$muc_thu,$id]);
    }

    static function deleteSV($id)
    {
        DB::delete("DELETE from tbl_sinhvien where ma_sinh_vien='$id' ");
    }

    static function get_distinct()
    {
        $list_distinct=DB::select("SELECT distinct(trang_thai) from tbl_sinhvien");
        return $list_distinct;
    }

    static function list_SV($id)
    {
        $sinh_vien=DB::select("SELECT ma_sinh_vien,ten_sinh_vien,ngay_sinh,sdt from tbl_sinhvien where lop_ma=?",[$id]);
        return $sinh_vien;
    }

    static function list_SV_chi_tiet($ma_lop)
    {
        $sinh_vien=DB::select("
            SELECT
                tbl.*,tbl_nganh.ten_nganh,tbl_nganh.he_dao_tao,tbl_khoahoc.ten_khoa_hoc,tbl_khoahoc.ngay_bat_dau, tbl_khoahoc.ngay_ket_thuc,tbl_hinhthucnop.ten_hinh_thuc,(tbl.muc_thu_qui_dinh-(tbl.muc_thu_qui_dinh*((tbl.ty_le_phan_tram+tbl_hinhthucnop.ty_le_giam)/100))) as so_tien_can_nop
            from 
                (SELECT  
                    tbl_sinhvien.*,tbl_hocbong.ten_hoc_bong,tbl_hocbong.ty_le_phan_tram,tbl_lop.ten_lop,tbl_lop.nganh_ma, tbl_lop.khoa_hoc_ma,tbl_lop.si_so,tbl_lop.giao_vien_chu_nhiem,tbl_mucthu.hinh_thuc_ma,tbl_mucthu.muc_thu_qui_dinh
                from tbl_sinhvien   
                    inner join tbl_hocbong on tbl_sinhvien.hoc_bong_ma=tbl_hocbong.ma_hoc_bong 
                    inner join tbl_lop on tbl_sinhvien.lop_ma=tbl_lop.ma_lop
                    inner join tbl_mucthu on tbl_sinhvien.muc_thu_ma=tbl_mucthu.ma_muc_thu
                )tbl 
            inner join tbl_nganh on tbl.nganh_ma=tbl_nganh.ma_nganh
            inner join tbl_khoahoc on tbl.khoa_hoc_ma=tbl_khoahoc.ma_khoa_hoc
            inner join tbl_hinhthucnop on tbl.hinh_thuc_ma=tbl_hinhthucnop.ma_hinh_thuc
            where tbl.lop_ma=? ",[$ma_lop]);
        return $sinh_vien;
    }

    static function chua_nop($ma_lop,$limit)
    {
        $sinh_vien=DB::select("
            SELECT
                tbl.*,tbl_nganh.ten_nganh,tbl_nganh.he_dao_tao,tbl_khoahoc.ten_khoa_hoc,tbl_khoahoc.ngay_bat_dau, tbl_khoahoc.ngay_ket_thuc,tbl_hinhthucnop.ten_hinh_thuc,tbl.muc_thu_qui_dinh,tbl.ty_le_phan_tram,tbl_hinhthucnop.ty_le_giam
            from 
                (SELECT  
                    tbl_sinhvien.*,tbl_hocbong.ten_hoc_bong,tbl_hocbong.ty_le_phan_tram,tbl_lop.ten_lop,tbl_lop.nganh_ma, tbl_lop.khoa_hoc_ma,tbl_lop.si_so,tbl_lop.giao_vien_chu_nhiem,tbl_mucthu.hinh_thuc_ma,tbl_mucthu.muc_thu_qui_dinh
                from tbl_sinhvien   
                    inner join tbl_hocbong on tbl_sinhvien.hoc_bong_ma=tbl_hocbong.ma_hoc_bong 
                    inner join tbl_lop on tbl_sinhvien.lop_ma=tbl_lop.ma_lop
                    inner join tbl_mucthu on tbl_sinhvien.muc_thu_ma=tbl_mucthu.ma_muc_thu
                )tbl 
            inner join tbl_nganh on tbl.nganh_ma=tbl_nganh.ma_nganh
            inner join tbl_khoahoc on tbl.khoa_hoc_ma=tbl_khoahoc.ma_khoa_hoc
            inner join tbl_hinhthucnop on tbl.hinh_thuc_ma=tbl_hinhthucnop.ma_hinh_thuc
            where tbl.lop_ma=? and tbl.ma_sinh_vien NOT IN($limit)",[$ma_lop]);
        return $sinh_vien;
    }

    static function get_title($ma_lop)
    {
        $title=DB::select("
            SELECT
                tbl.*,tbl_nganh.ten_nganh,tbl_nganh.he_dao_tao,tbl_khoahoc.ma_khoa_hoc,tbl_khoahoc.ten_khoa_hoc,tbl_khoahoc.ngay_bat_dau, tbl_khoahoc.ngay_ket_thuc
            from 
                (SELECT  
                    tbl_sinhvien.*,tbl_lop.ten_lop,tbl_lop.nganh_ma, tbl_lop.khoa_hoc_ma,tbl_lop.si_so,tbl_lop.giao_vien_chu_nhiem
                from tbl_sinhvien   
                    inner join tbl_hocbong on tbl_sinhvien.hoc_bong_ma=tbl_hocbong.ma_hoc_bong 
                    inner join tbl_lop on tbl_sinhvien.lop_ma=tbl_lop.ma_lop
                )tbl 
            inner join tbl_nganh on tbl.nganh_ma=tbl_nganh.ma_nganh
            inner join tbl_khoahoc on tbl.khoa_hoc_ma=tbl_khoahoc.ma_khoa_hoc
            where tbl.lop_ma=?",[$ma_lop]);
        
       return $title[0];
        
    }

    static function get_keyword($keyword)
    {
        $sinhvien=DB::select("
            SELECT ma_sinh_vien
            FROM tbl_sinhvien
            WHERE ten_sinh_vien LIKE '%$keyword%' ");
        return $sinhvien;
    }
}

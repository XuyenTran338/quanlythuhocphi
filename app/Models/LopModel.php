<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Carbon\Carbon;
class LopModel extends Model
{
    protected $table = 'tbl_lop';
    protected $fillable = ['ma_lop','ten_lop','si_so','giao_vien_chu_nhiem','trang_thai','nganh_ma','khoa_hoc_ma'];
    static function getAll()
    {
    	$lop = DB::select("SELECT  
            tbl_lop.*,tbl_nganh.ten_nganh,tbl_nganh.he_dao_tao,tbl_khoahoc.ten_khoa_hoc,tbl_khoahoc.ngay_bat_dau, tbl_khoahoc.ngay_ket_thuc
            from tbl_lop inner join tbl_nganh on tbl_lop.nganh_ma=tbl_nganh.ma_nganh inner join tbl_khoahoc on tbl_lop.khoa_hoc_ma=tbl_khoahoc.ma_khoa_hoc order by tbl_lop.ma_lop desc");
    	return $lop;
    }
    
    static function getID()
    {
        $max_id=DB::table('tbl_lop')->max('ma_lop');
        if($max_id == '')
        {
            $max_id ="BKC0001";
        }else
        {
            $id=substr($max_id,-4);
            $id=(int)$id + 1;
            $id=(string)$id;
            $id=str_pad($id,4,"0",STR_PAD_LEFT);
            $max_id="BKC{$id}";
        }
        return  $max_id;
    }

    static function getByID($id)
    {
    	$lop_id=DB::select("SELECT  
            tbl_lop.*,tbl_nganh.ten_nganh,tbl_nganh.he_dao_tao,tbl_khoahoc.ten_khoa_hoc,tbl_khoahoc.ngay_bat_dau, tbl_khoahoc.ngay_ket_thuc
            from tbl_lop inner join tbl_nganh on tbl_lop.nganh_ma=tbl_nganh.ma_nganh inner join tbl_khoahoc on tbl_lop.khoa_hoc_ma=tbl_khoahoc.ma_khoa_hoc where tbl_lop.ma_lop='$id' ");
    	return $lop_id[0];

    }

    static function insert($obj)
    {
        $id                     =   $obj->ma_lop;
       	$name_lop               =   $obj->ten_lop;
       	$si_so                  =   $obj->si_so;
       	$giao_vien_chu_nhiem    =   $obj->giao_vien_chu_nhiem;
        $nganh_id               =   $obj->nganh_ma;
        $khoahoc_id             =   $obj->khoa_hoc_ma;
    	DB::insert("INSERT INTO tbl_lop(ma_lop,ten_lop,si_so,giao_vien_chu_nhiem,nganh_ma,khoa_hoc_ma) values('$id','$name_lop','$si_so','$giao_vien_chu_nhiem','$nganh_id','$khoahoc_id')");
    }

    static function updateLop($obj)
    {
    	$id                     =   $obj->ma_lop;
        $name_lop               =   $obj->ten_lop;
        $si_so                  =   $obj->si_so;
        $giao_vien_chu_nhiem    =   $obj->giao_vien_chu_nhiem;
        $trang_thai             =   $obj->trang_thai;
        $nganh_id               =   $obj->nganh_ma;
        $khoahoc_id             =   $obj->khoa_hoc_ma;
    	$lop=DB::update("UPDATE tbl_lop set 
    		ten_lop	              = '$name_lop',
    		si_so 		          = '$si_so',
    		giao_vien_chu_nhiem	  = '$giao_vien_chu_nhiem',
            trang_thai            = '$trang_thai',
    		nganh_ma              = '$nganh_id',
            khoa_hoc_ma           = '$khoahoc_id'
    	where ma_lop= '$id' ");
    	return $lop;
    } 

    static function deleteLop($id)
    {
        DB::delete("DELETE from tbl_lop where ma_lop='$id' ");
    }

    static function distinct_Khoa_Hoc($id)
    {
        $khoa_hoc=DB::select("SELECT DISTINCT(khoa_hoc_ma),tbl_khoahoc.ten_khoa_hoc,tbl_khoahoc.ngay_bat_dau, tbl_khoahoc.ngay_ket_thuc
            from tbl_lop 
            inner join tbl_khoahoc on tbl_lop.khoa_hoc_ma=tbl_khoahoc.ma_khoa_hoc 
            WHERE nganh_ma=? order by tbl_lop.khoa_hoc_ma desc",[$id]);
        return $khoa_hoc;
    }

    static function distinct_Lop($ma_nganh,$ma_khoa)
    {
        $lop=DB::select("SELECT DISTINCT(ma_lop),tbl_lop.ten_lop,tbl_lop.si_so,tbl_khoahoc.ten_khoa_hoc,tbl_khoahoc.ngay_bat_dau, tbl_khoahoc.ngay_ket_thuc
            from tbl_lop inner join tbl_nganh on tbl_lop.nganh_ma=tbl_nganh.ma_nganh inner join tbl_khoahoc on tbl_lop.khoa_hoc_ma=tbl_khoahoc.ma_khoa_hoc WHERE khoa_hoc_ma=? and nganh_ma=? ",[$ma_khoa,$ma_nganh]);
        return $lop;
    }

    static function distinct_Lop_chi_tiet($ma_nganh,$ma_khoa)
    {
        $lop=DB::select("SELECT DISTINCT(ma_lop),tbl_lop.ten_lop,tbl_lop.si_so,tbl_lop.giao_vien_chu_nhiem,tbl_lop.trang_thai,tbl_nganh.ten_nganh,tbl_nganh.he_dao_tao,tbl_khoahoc.ten_khoa_hoc,tbl_khoahoc.ngay_bat_dau, tbl_khoahoc.ngay_ket_thuc
            from tbl_lop inner join tbl_nganh on tbl_lop.nganh_ma=tbl_nganh.ma_nganh inner join tbl_khoahoc on tbl_lop.khoa_hoc_ma=tbl_khoahoc.ma_khoa_hoc WHERE khoa_hoc_ma=? and nganh_ma=? ",[$ma_khoa,$ma_nganh]);
        return $lop;
    }

    static function get_title($ma_nganh,$ma_khoa)
    {
        $title=DB::select("SELECT tbl_nganh.ten_nganh,tbl_nganh.he_dao_tao,tbl_khoahoc.ten_khoa_hoc,tbl_khoahoc.ma_khoa_hoc
            from tbl_lop inner join tbl_nganh on tbl_lop.nganh_ma=tbl_nganh.ma_nganh inner join tbl_khoahoc on tbl_lop.khoa_hoc_ma=tbl_khoahoc.ma_khoa_hoc WHERE khoa_hoc_ma=? and nganh_ma=? ",[$ma_khoa,$ma_nganh]);
        return $title[0];
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Carbon\Carbon;
class MucThuModel extends Model
{
    protected $table = 'tbl_mucthu';
    protected $fillable = ['ma_muc_thu','nganh_ma','hinh_thuc_ma','muc_thu_qui_dinh'];

    public function nganh()
    {
        return $this->belongsTo('App\Models\NganhModel','nganh_ma','ma_nganh');
    }

    public function hinhthuc()
    {
        return $this->belongsTo('App\Models\HinhThucModel','hinh_thuc_ma','ma_hinh_thuc');
    }

    public function phieuthu()
    {
        return $this->hasMany('App\Models\PhieuThuModel','muc_thu_ma','ma_muc_thu');
    }

    static function getAll()
    {
    	$mucthu = DB::select(
            "SELECT tbl_mucthu.*,tbl_nganh.ten_nganh,tbl_hinhthucnop.ten_hinh_thuc,tbl_hinhthucnop.ty_le_giam
            from tbl_mucthu 
                inner join tbl_nganh on tbl_mucthu.nganh_ma=tbl_nganh.ma_nganh
                inner join tbl_hinhthucnop on tbl_mucthu.hinh_thuc_ma=tbl_hinhthucnop.ma_hinh_thuc"
        );

    	return $mucthu;
    }
    
    static function getID()
    {
        $max_id=DB::table('tbl_mucthu')->max('ma_muc_thu');
        if($max_id == '')
        {
            $max_id ="MT0001";
        }else
        {
            $id=substr($max_id,-4);
            $id=(int)$id + 1;
            $id=(string)$id;
            $id=str_pad($id,4,"0",STR_PAD_LEFT);
            $max_id="MT{$id}";
        }
        return  $max_id;
    }

    static function getByID($id)
    {
    	$mucthu_id=DB::select(
            "SELECT tbl_mucthu.*,tbl_nganh.ten_nganh,tbl_hinhthucnop.ten_hinh_thuc,tbl_hinhthucnop.ty_le_giam,tbl_hinhthucnop.so_thang
            from tbl_mucthu
                inner join tbl_nganh on tbl_mucthu.nganh_ma=tbl_nganh.ma_nganh
                inner join tbl_hinhthucnop on tbl_mucthu.hinh_thuc_ma=tbl_hinhthucnop.ma_hinh_thuc
            where tbl_mucthu.ma_muc_thu=? ",[$id]);

    	return $mucthu_id[0];

    }

    static function check_muc_thu($nganh_ma,$hinh_thuc_ma)
    {
        $check=DB::select("SELECT * from tbl_mucthu where nganh_ma=? and hinh_thuc_ma=?",[$nganh_ma,$hinh_thuc_ma]);
        return count($check);
    }
    static function get_muc_thu_thang($ma_nganh,$so_thang)
    {
        $mucthu_id=DB::select(
            "SELECT tbl_mucthu.*,tbl_nganh.ten_nganh,tbl_hinhthucnop.ten_hinh_thuc,tbl_hinhthucnop.ty_le_giam,tbl_hinhthucnop.so_thang
            from tbl_mucthu
                inner join tbl_nganh on tbl_mucthu.nganh_ma=tbl_nganh.ma_nganh
                inner join tbl_hinhthucnop on tbl_mucthu.hinh_thuc_ma=tbl_hinhthucnop.ma_hinh_thuc
            where tbl_mucthu.nganh_ma=? and tbl_hinhthucnop.so_thang=?",[$ma_nganh,$so_thang]);

        return $mucthu_id[0];
    }

    static function insert($obj)
    {
        $id                 =   $obj->ma_muc_thu;
        $nganh_ma           =   $obj->nganh_ma;
        $hinh_thuc_ma       =   $obj->hinh_thuc_ma;
       	$muc_thu_qui_dinh   =   $obj->muc_thu_qui_dinh;

    	DB::insert("INSERT into tbl_mucthu(ma_muc_thu,nganh_ma,hinh_thuc_ma,muc_thu_qui_dinh) 
                    values(?,?,?,?)",[$id,$nganh_ma,$hinh_thuc_ma,$muc_thu_qui_dinh]);
    }

    static function updateMT($obj)
    {
    	$id                 =   $obj->ma_muc_thu;
        $nganh_ma           =   $obj->nganh_ma;
        $hinh_thuc_ma       =   $obj->hinh_thuc_ma;
        $muc_thu_qui_dinh   =   $obj->muc_thu_qui_dinh;
    	$mucthu=DB::update("UPDATE tbl_mucthu set 
    		nganh_ma	     = ?,
    		hinh_thuc_ma	 = ?,
            muc_thu_qui_dinh = ?
            where ma_muc_thu   = ? ",[$nganh_ma,$hinh_thuc_ma,$muc_thu_qui_dinh,$id]);
    	return $mucthu;
    } 

    static function deleteMT($id)
    {
        DB::delete("DELETE from tbl_mucthu where ma_muc_thu=?",[$id]);
    }

    static function get_MucThu_Nganh_fliter($id,$so_thang,$so_thang_max,$limit)
    {
        $mucthu=DB::select("SELECT tbl_mucthu.ma_muc_thu,tbl_mucthu.muc_thu_qui_dinh,tbl_hinhthucnop.ten_hinh_thuc,tbl_hinhthucnop.so_thang
            from tbl_mucthu 
                inner join tbl_hinhthucnop on tbl_mucthu.hinh_thuc_ma=tbl_hinhthucnop.ma_hinh_thuc
            where tbl_mucthu.nganh_ma =? and tbl_hinhthucnop.so_thang >= ? and tbl_hinhthucnop.so_thang<>? and tbl_hinhthucnop.so_thang<>?",[$id,$so_thang,$so_thang_max,$limit]);
        return $mucthu;
    }

    static function get_MucThu($id)
    {
        $mucthu=DB::select("SELECT tbl_mucthu.*,tbl_nganh.ten_nganh,tbl_hinhthucnop.ten_hinh_thuc,tbl_hinhthucnop.ty_le_giam,tbl_hinhthucnop.so_thang
            from tbl_mucthu
                inner join tbl_nganh on tbl_mucthu.nganh_ma=tbl_nganh.ma_nganh
                inner join tbl_hinhthucnop on tbl_mucthu.hinh_thuc_ma=tbl_hinhthucnop.ma_hinh_thuc
            where tbl_mucthu.ma_muc_thu=? ",[$id]);
        return $mucthu;
    }

    static function get_MucThu_Nganh($id)
    {
        $mucthu=DB::select("SELECT tbl_mucthu.*,tbl_nganh.ten_nganh,tbl_hinhthucnop.ten_hinh_thuc,tbl_hinhthucnop.ty_le_giam,tbl_hinhthucnop.so_thang
            from tbl_mucthu
                inner join tbl_nganh on tbl_mucthu.nganh_ma=tbl_nganh.ma_nganh
                inner join tbl_hinhthucnop on tbl_mucthu.hinh_thuc_ma=tbl_hinhthucnop.ma_hinh_thuc
            where tbl_mucthu.nganh_ma=? ",[$id]);
        return $mucthu;
    }

    static function get_MucThu_Nganh_khoang($id,$so_thang,$so_thang_max,$limit)
    {
        $mucthu=DB::select("SELECT tbl_mucthu.ma_muc_thu,tbl_mucthu.muc_thu_qui_dinh,tbl_hinhthucnop.ten_hinh_thuc,tbl_hinhthucnop.so_thang
            from tbl_mucthu 
                inner join tbl_hinhthucnop on tbl_mucthu.hinh_thuc_ma=tbl_hinhthucnop.ma_hinh_thuc
            where tbl_mucthu.nganh_ma =? and tbl_hinhthucnop.so_thang >= ? and tbl_hinhthucnop.so_thang<>? and tbl_hinhthucnop.so_thang<=?",[$id,$so_thang,$so_thang_max,$limit]);
        return $mucthu;
    }

    static function tien_theo_thang($ma_nganh)
    {
        $tien_theo_nganh=DB::select("SELECT min(muc_thu_qui_dinh) as min_tien from tbl_mucthu where nganh_ma=?",[$ma_nganh]);
        return $tien_theo_nganh[0];
    }
}

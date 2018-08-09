<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Carbon\Carbon;
class KhoaHocModel extends Model
{
    protected $table = 'tbl_khoahoc';
    protected $fillable = ['ma_khoa_hoc','ten_khoa_hoc', 'ngay_bat_dau','ngay_ket_thuc'];

    public function lop()
    {        
        return $this->hasMany('App\Models\LopModel','khoa_hoc_ma','ma_khoa_hoc');
    }
    
    static function getAll()
    {
    	$khoahoc = DB::select('SELECT * from tbl_khoahoc');
    	return $khoahoc;
    }
    
    static function getID()
    {
        $max_id=DB::table('tbl_khoahoc')->max('ma_khoa_hoc');
        if($max_id == '')
        {
            $max_id ="K1";
        }else
        {
            $id=substr($max_id,1);
            $id=(int)$id + 1;
            $id=(string)$id;
            $id=str_pad($id,0,"0",STR_PAD_LEFT);
            $max_id="K{$id}";
        }
        return  $max_id;
    }

    static function getByID($id)
    {
    	$khoahoc_id=DB::select("SELECT * from tbl_khoahoc where ma_khoa_hoc = '$id' ");
    	return $khoahoc_id[0];
    }

    static function insert($obj)
    {
        $id             =   $obj->ma_khoa_hoc;
        $name           =   $obj->ten_khoa_hoc;
        $ngay_bat_dau   =   $obj->ngay_bat_dau;
        $ngay_ket_thuc  =   $obj->ngay_ket_thuc;
    	DB::insert("INSERT into tbl_khoahoc(ma_khoa_hoc,ten_khoa_hoc,ngay_bat_dau,ngay_ket_thuc) values('$id','$name','$ngay_bat_dau','$ngay_ket_thuc')");
    }

    static function updateKhoaHoc($obj)
    {
    	$id             =   $obj->ma_khoa_hoc;
        $name           =   $obj->ten_khoa_hoc;
        $ngay_bat_dau   =   $obj->ngay_bat_dau;
        $ngay_ket_thuc  =   $obj->ngay_ket_thuc;
    	$khoahoc=DB::update("UPDATE tbl_khoahoc set ten_khoa_hoc='$name',ngay_bat_dau='$ngay_bat_dau',ngay_ket_thuc='$ngay_ket_thuc' where ma_khoa_hoc='$id' ");
    	return $khoahoc;
    } 

    static function deleteKhoaHoc($id)
    {
        DB::delete("DELETE from tbl_khoahoc where ma_khoa_hoc='$id'");
    }
}

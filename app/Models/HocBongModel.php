<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Carbon\Carbon;
class HocBongModel extends Model
{
    protected $table = 'tbl_hocbong';
    protected $fillable = ['ma_hoc_bong','ten_hoc_bong', 'ty_le_phan_tram'];

    public function sinhvien()
    {        
        return $this->hasMany('App\Models\SinhVienModel','ma_hoc_bong','ma_hoc_bong');
    }

    static function getAll()
    {
        $sql="SELECT * from tbl_hocbong";
    	$hocbong = DB::select($sql);
    	return $hocbong;
    }
    
    static function getID()
    {
        $max_id=DB::table('tbl_hocbong')->max('ma_hoc_bong');
        if($max_id == '')
        {
            $max_id ="HB01";
        }else
        {
            $id=substr($max_id,2);
            $id=(int)$id + 1;
            $id=(string)$id;
            $id=str_pad($id,2,"0",STR_PAD_LEFT);
            $max_id="HB{$id}";
        }
        return  $max_id;
    }

    static function getByID($id)
    {
    	$hocbong_id=DB::select("SELECT * from tbl_hocbong where ma_hoc_bong=? ",[$id]);
    	return $hocbong_id;

    }

    static function insert($obj)
    {
        $id             =   $obj->ma_hoc_bong;
        $name           =   $obj->ten_hoc_bong;
        $ty_le_phan_tram=   $obj->ty_le_phan_tram;
    	DB::insert("INSERT into tbl_hocbong(ma_hoc_bong,ten_hoc_bong,ty_le_phan_tram) values(?,?,?)",[$id,$name,$ty_le_phan_tram]);
    }

    static function updateDoiTuong($obj)
    {
    	$id             =   $obj->ma_hoc_bong;
        $name           =   $obj->ten_hoc_bong;
        $ty_le_phan_tram=   $obj->ty_le_phan_tram;
    	$hocbong=DB::update("UPDATE tbl_hocbong set ten_hoc_bong=?,ty_le_phan_tram=? where ma_hoc_bong=?",[$name,$ty_le_phan_tram,$id]);
    	return $hocbong;
    } 

    static function deleteDoiTuong($id)
    {
        DB::delete("DELETE from tbl_hocbong where ma_hoc_bong=?",[$id]);
    }
}

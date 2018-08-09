<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Carbon\Carbon;
class HinhThucModel extends Model
{
    protected $table = 'tbl_hinhthucnop';
    protected $fillable = ['ma_hinh_thuc','ten_hinh_thuc', 'so_thang','ty_le_giam','ghi_chu'];

    public function mucthu()
    {
        return $this->hasMany('App\Models\MucThuModel','hinh_thuc_ma','ma_hinh_thuc');
    }

    static function getAll()
    {
    	$hinhthuc = DB::select("SELECT * from tbl_hinhthucnop");
    	return $hinhthuc;
    }
    
    static function getID()
    {
        $max_id=DB::table('tbl_hinhthucnop')->max('ma_hinh_thuc');
       if($max_id == '')
        {
            $max_id ="HT01";
        }else
        {
            $id=substr($max_id,2);
            $id=(int)$id + 1;
            $id=(string)$id;
            $id=str_pad($id,2,"0",STR_PAD_LEFT);
            $max_id="HT{$id}";
        }
        return  $max_id;
    }

    static function getByID($id)
    {
    	$hinhthuc_id=DB::select("SELECT * from tbl_hinhthucnop where ma_hinh_thuc=?",[$id]); // => object
    	return $hinhthuc_id[0];

    }

    static function insert($obj)
    {
        $id         =   $obj->ma_hinh_thuc;
        $name       =   $obj->ten_hinh_thuc;
        $so_thang   =   $obj->so_thang;
        $ty_le_giam =   $obj->ty_le_giam;
        $ghi_chu    =   $obj->ghi_chu;
    	DB::insert("INSERT into tbl_hinhthucnop(ma_hinh_thuc,ten_hinh_thuc,so_thang,ty_le_giam,ghi_chu) values(?,?,?,?,?)",[$id,$name,$so_thang,$ty_le_giam,$ghi_chu]);
    }

    static function updateHT($obj)
    {
    	$id         =   $obj->ma_hinh_thuc;
        $name       =   $obj->ten_hinh_thuc;
        $so_thang   =   $obj->so_thang;
        $ty_le_giam =   $obj->ty_le_giam;
        $ghi_chu    =   $obj->ghi_chu;
    	$hinhthuc=DB::update("UPDATE tbl_hinhthucnop set 
                ten_hinh_thuc     =  ?,
                so_thang          =  ?,
                ty_le_giam        =  ?,
                ghi_chu           =  ?
            where ma_hinh_thuc  =  ?",[$name,$so_thang,$ty_le_giam,$ghi_chu,$id]);
    	return $hinhthuc;
    } 

    static function deleteHT($id)
    {
        DB::delete("DELETE from tbl_hinhthucnop where ma_hinh_thuc=?",[$id]);
    }

    static function max_thang()
    {
        $max_so_thang=DB::table('tbl_hinhthucnop')->max('so_thang');
        return $max_so_thang;
    }
}

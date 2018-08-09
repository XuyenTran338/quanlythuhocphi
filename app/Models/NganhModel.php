<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class NganhModel extends Model
{
    protected $table = 'tbl_nganh';
    protected $fillable = ['ma_nganh','ten_nganh', 'he_dao_tao'];

    public function lop()
    {        
        return $this->hasMany('App\Models\LopModel','nganh_ma','ma_nganh');
    }

    public function mucthu()
    {        
        return $this->hasMany('App\Models\MucThuModel','nganh_ma','ma_nganh');
    }

    static function getAll()
    {
    	$nganh = DB::select('SELECT * from tbl_nganh');
    	return $nganh;
    }
    
    static function getID()
    {
       $max_id=DB::table('tbl_nganh')->max('ma_nganh');
        if($max_id == '')
        {
            $max_id ="LT0001";
        }else
        {
            $id=substr($max_id, -4);
            $id=(int)$id + 1;
            $id=(string)$id;
            $id=str_pad($id,4,"0",STR_PAD_LEFT);
            $max_id="LT{$id}";
        }
        return  $max_id;
    }

    static function getByID($id)
    {
    	$nganh_id=DB::select("SELECT * from tbl_nganh where ma_nganh = '$id' ");
    	return $nganh_id[0];

    }

    static function insert($obj)
    {
        $id   =  $obj->ma_nganh;
        $name =  $obj->ten_nganh;
        $he   =  $obj->he_dao_tao;
    	DB::insert("INSERT into tbl_nganh(ma_nganh,ten_nganh,he_dao_tao) values('$id','$name','$he')");
    }

    static function updateNganh($obj)
    {
    	$id   =  $obj->ma_nganh;
        $name =  $obj->ten_nganh;
        $he   =  $obj->he_dao_tao;
    	$nganh=DB::update("UPDATE tbl_nganh set ten_nganh='$name',he_dao_tao='$he' where ma_nganh='$id' ");
    	return $nganh;
    } 

    static function deleteNganh($id)
    {
        DB::delete("DELETE from tbl_nganh where ma_nganh='$id' ");
    }
}

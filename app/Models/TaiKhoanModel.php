<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Carbon\Carbon;
class TaiKhoanModel extends Model
{
    protected $table = 'tbl_taikhoan';
    protected $fillable = ['ma_tai_khoan','email','ten_tai_khoan', 'mat_khau','phan_quyen','ho_ten','lan_truy_cap_cuoi','gioi_tinh','SDT','image'];
    public $timestamps = false;
    static function getAll($id)
    {
    	$user = DB::select("SELECT * from tbl_taikhoan where ma_tai_khoan<>'$id' order by phan_quyen asc");
    	return $user;
    }
    
    static function getID()
    {
        $max_id=DB::table('tbl_taikhoan')->max('ma_tai_khoan');
        if($max_id == '')
        {
            $max_id ="TK0001";
        }else
        {
            $id=substr($max_id, -4);
            $id=(int)$id + 1;
            $id=(string)$id;
            $id=str_pad($id,4,"0",STR_PAD_LEFT);
            $max_id="TK{$id}";
        }
        return  $max_id;
    }

    static function getByID($id)
    {
    	$user_id=DB::select("SELECT * from tbl_taikhoan where ma_tai_khoan = '$id' ");
    	return $user_id[0];

    }

    static function insert($obj)
    {
        $id             =   $obj->ma_tai_khoan;
        $email          =   $obj->email;
        $ten_tai_khoan  =   $obj->ten_tai_khoan;
        $mat_khau       =   bcrypt($obj->mat_khau);
        $phan_quyen     =   $obj->phan_quyen;
    	$ho_ten         =   $obj->ho_ten;
        $gioi_tinh      =   $obj->gioi_tinh;
        $SDT            =   $obj->SDT;
    	$image          =   $obj->image;
        $sql="INSERT into tbl_taikhoan(ma_tai_khoan,email,ten_tai_khoan,mat_khau,phan_quyen,ho_ten,gioi_tinh,SDT,image) values('$id','$email','$ten_tai_khoan','$mat_khau',$phan_quyen,'$ho_ten','$gioi_tinh','$SDT','$image')";
        DB::insert($sql);
    	/*DB::insert('INSERT into tbl_taikhoan(ma_tai_khoan,email,ten_tai_khoan,mat_khau,phan_quyen,ho_ten) values(?,?,?,?,?,?)',$id,$email,$ten_tai_khoan,$mat_khau,$phan_quyen,$ho_ten);*/
    }

    static function updateUsers($obj)
    {
    	$id             =   $obj->ma_tai_khoan;
        $email          =   $obj->email;
        $ten_tai_khoan  =   $obj->ten_tai_khoan;
        $phan_quyen     =   $obj->phan_quyen;
        $ho_ten         =   $obj->ho_ten;
        $gioi_tinh      =   $obj->gioi_tinh;
        $SDT            =   $obj->SDT;
        $image          =   $obj->image;

    	$users=DB::update("UPDATE tbl_taikhoan set
                email         = '$email',
                ten_tai_khoan = '$ten_tai_khoan',
                phan_quyen    = $phan_quyen,
                ho_ten        = '$ho_ten',
                gioi_tinh     = '$gioi_tinh',
                SDT           = '$SDT',
                image         = '$image'
                where ma_tai_khoan='$id' ");
    	return $users;
    } 

    static function deleteUsers($id)
    {
        DB::delete("DELETE from tbl_taikhoan where ma_tai_khoan='$id' ");
    }

    static function get_distinct()
    {
        $list_distinct=DB::select("SELECT distinct(phan_quyen) from tbl_taikhoan");
        return $list_distinct;
    }

    static function update_acc($obj)
    {
        $id             =   $obj->ma_tai_khoan;
        $email          =   $obj->email;
        $ho_ten         =   $obj->ho_ten;
        $gioi_tinh      =   $obj->gioi_tinh;
        $SDT            =   $obj->SDT;
        $image          =   $obj->image;

        DB::update("UPDATE tbl_taikhoan set
                email         = '$email',
                ho_ten        = '$ho_ten',
                gioi_tinh     = '$gioi_tinh',
                SDT           = '$SDT',
                image         = '$image'
                where ma_tai_khoan='$id' ");
    }

    static function update_pass($obj)
    {
        $id         =   $obj->ma_tai_khoan;
        $pass_new   =   bcrypt($obj->mat_khau);
        
        DB::update("UPDATE tbl_taikhoan set mat_khau=? where ma_tai_khoan=?",[$pass_new,$id]);
    }
}

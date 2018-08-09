<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Carbon\Carbon;
class PhieuThuModel extends Model
{
    protected $table = 'tbl_phieuthu';
    protected $fillable = ['ma_phieu_thu','thoi_gian_thu','lan_thu','dot_thu','thang_da_nop','nam_hoc','nguoi_thu','so_tien_thu','noi_dung','sinh_vien_ma','muc_thu_ma'];

    public function sinhvien()
    {
        return $this->belongsTo('App\Models\SinhVienModel','sinh_vien_ma','ma_sinh_vien');
    }

    public function mucthu()
    {
        return $this->belongsTo('App\Models\MucThuModel','muc_thu_ma','ma_muc_thuc');
    }

    static function getAll()
    {
    	$phieuthu = DB::select(
            "SELECT tbl_B.*,tbl_B.nguoi_thu,tbl_B.lan_thu,tbl_B.thoi_gian_thu,SUM(tbl_B.so_tien_thu) as so_tien_thu,tbl_B.noi_dung,tbl_B.ty_le_phan_tram,tbl_B.muc_thu_qui_dinh,tbl_B.ten_hinh_thuc,tbl_B.so_thang,tbl_B.ty_le_giam
            from
                (SELECT tbl_A.*,tbl_lop.ten_lop,tbl_lop.nganh_ma,tbl_lop.khoa_hoc_ma,tbl_hocbong.ty_le_phan_tram,tbl_hinhthucnop.ten_hinh_thuc,tbl_hinhthucnop.so_thang,tbl_hinhthucnop.ty_le_giam
                from  
                    (SELECT tbl_phieuthu.*,tbl_sinhvien.ten_sinh_vien,tbl_sinhvien.email,tbl_sinhvien.ngay_sinh,tbl_sinhvien.trang_thai,tbl_sinhvien.gioi_tinh,tbl_sinhvien.sdt,tbl_sinhvien.dia_chi,tbl_sinhvien.lop_ma,tbl_sinhvien.hoc_bong_ma,tbl_mucthu.muc_thu_qui_dinh,tbl_mucthu.hinh_thuc_ma
                    from tbl_phieuthu 
                        inner join tbl_sinhvien on tbl_phieuthu.sinh_vien_ma=tbl_sinhvien.ma_sinh_vien 
                        inner join tbl_mucthu on tbl_phieuthu.muc_thu_ma=tbl_mucthu.ma_muc_thu
                    )tbl_A
                inner join tbl_lop on tbl_A.lop_ma=tbl_lop.ma_lop
                inner join tbl_hocbong on tbl_A.hoc_bong_ma=tbl_hocbong.ma_hoc_bong
                inner join tbl_hinhthucnop on tbl_A.hinh_thuc_ma=tbl_hinhthucnop.ma_hinh_thuc
                )tbl_B
            inner join tbl_nganh on tbl_B.nganh_ma=tbl_nganh.ma_nganh
            inner join tbl_khoahoc on tbl_B.khoa_hoc_ma=tbl_khoahoc.ma_khoa_hoc
            group by tbl_B.thoi_gian_thu  order by tbl_B.thoi_gian_thu desc");

    	return $phieuthu;
    }
    
    static function getID()
    {
        $max_id=DB::table('tbl_phieuthu')->max('ma_phieu_thu');
        if($max_id == '')
        {
            $max_id ="PT0001";
        }else
        {
            $id=substr($max_id,-4);
            $id=(int)$id + 1;
            $id=(string)$id;
            $id=str_pad($id,4,"0",STR_PAD_LEFT);
            $max_id="PT{$id}";
        }
        return  $max_id;
    }

    static function dot_thu($id)
    {
        $dot_thu=DB::table('tbl_phieuthu')->where('sinh_vien_ma',$id)->max('dot_thu');
        if($dot_thu == '')
        {
            $dot_thu=1;
        }else
        {
            $dot_thu = $dot_thu+1;
        }
        return $dot_thu;
    }

    static function get_hinh_thuc($ma_hinh_thuc)
    {
        $check=DB::select('
            SELECT tbl_A.*,tbl_lop.ten_lop,tbl_lop.nganh_ma,tbl_lop.khoa_hoc_ma,tbl_hocbong.ty_le_phan_tram,tbl_hinhthucnop.ten_hinh_thuc,tbl_hinhthucnop.so_thang,tbl_hinhthucnop.ty_le_giam
            from  
                (SELECT tbl_phieuthu.*,tbl_sinhvien.ten_sinh_vien,tbl_sinhvien.email,tbl_sinhvien.ngay_sinh,tbl_sinhvien.trang_thai,tbl_sinhvien.gioi_tinh,tbl_sinhvien.sdt,tbl_sinhvien.dia_chi,tbl_sinhvien.lop_ma,tbl_sinhvien.hoc_bong_ma,tbl_mucthu.muc_thu_qui_dinh,tbl_mucthu.hinh_thuc_ma
                from tbl_phieuthu 
                    inner join tbl_sinhvien on tbl_phieuthu.sinh_vien_ma=tbl_sinhvien.ma_sinh_vien 
                    inner join tbl_mucthu on tbl_phieuthu.muc_thu_ma=tbl_mucthu.ma_muc_thu
                )tbl_A
            inner join tbl_lop on tbl_A.lop_ma=tbl_lop.ma_lop
            inner join tbl_hocbong on tbl_A.hoc_bong_ma=tbl_hocbong.ma_hoc_bong
            inner join tbl_hinhthucnop on tbl_A.hinh_thuc_ma=tbl_hinhthucnop.ma_hinh_thuc
            where tbl_A.hinh_thuc_ma=?',[$ma_hinh_thuc]);
        return $check;
    }

    static function getByID($ma_sinh_vien,$lan_thu)
    {
    	$phieuthu_id=DB::select(
            "SELECT tbl_B.sinh_vien_ma,tbl_B.ten_sinh_vien,tbl_B.email,tbl_B.ngay_sinh,tbl_B.trang_thai,tbl_B.gioi_tinh,tbl_B.sdt,tbl_B.dia_chi,tbl_B.nguoi_thu,tbl_B.lan_thu,tbl_B.thoi_gian_thu,SUM(tbl_B.so_tien_thu) as so_tien_thu,tbl_B.noi_dung,tbl_B.ty_le_phan_tram,tbl_B.muc_thu_qui_dinh,tbl_B.ten_hinh_thuc,tbl_B.so_thang,tbl_B.ty_le_giam,tbl_khoahoc.ten_khoa_hoc,tbl_nganh.ten_nganh,tbl_B.ten_lop,tbl_khoahoc.ngay_bat_dau,tbl_khoahoc.ngay_ket_thuc,tbl_B.khoa_hoc_ma
            from
                (SELECT tbl_A.*,tbl_lop.ten_lop,tbl_lop.nganh_ma,tbl_lop.khoa_hoc_ma,tbl_hocbong.ty_le_phan_tram,tbl_hinhthucnop.ten_hinh_thuc,tbl_hinhthucnop.so_thang,tbl_hinhthucnop.ty_le_giam
                from  
                    (SELECT tbl_phieuthu.*,tbl_sinhvien.ten_sinh_vien,tbl_sinhvien.email,tbl_sinhvien.ngay_sinh,tbl_sinhvien.trang_thai,tbl_sinhvien.gioi_tinh,tbl_sinhvien.sdt,tbl_sinhvien.dia_chi,tbl_sinhvien.lop_ma,tbl_sinhvien.hoc_bong_ma,tbl_mucthu.muc_thu_qui_dinh,tbl_mucthu.hinh_thuc_ma
                    from tbl_phieuthu 
                        inner join tbl_sinhvien on tbl_phieuthu.sinh_vien_ma=tbl_sinhvien.ma_sinh_vien 
                        inner join tbl_mucthu on tbl_phieuthu.muc_thu_ma=tbl_mucthu.ma_muc_thu
                    )tbl_A
                inner join tbl_lop on tbl_A.lop_ma=tbl_lop.ma_lop
                inner join tbl_hocbong on tbl_A.hoc_bong_ma=tbl_hocbong.ma_hoc_bong
                inner join tbl_hinhthucnop on tbl_A.hinh_thuc_ma=tbl_hinhthucnop.ma_hinh_thuc
                )tbl_B
            inner join tbl_nganh on tbl_B.nganh_ma=tbl_nganh.ma_nganh
            inner join tbl_khoahoc on tbl_B.khoa_hoc_ma=tbl_khoahoc.ma_khoa_hoc
            where tbl_B.sinh_vien_ma=? and tbl_B.lan_thu=?
            group by tbl_B.lan_thu,tbl_nganh.ten_nganh,tbl_khoahoc.ten_khoa_hoc,tbl_khoahoc.ngay_bat_dau,tbl_khoahoc.ngay_ket_thuc",[$ma_sinh_vien,$lan_thu]);

    	return $phieuthu_id[0];

    }

    static function insert($obj)
    {
        $id                 =$obj->ma_phieu_thu;
       	$thoi_gian_thu      =$obj->thoi_gian_thu;
        $dot_thu            =$obj->dot_thu;
       	$lan_thu            =$obj->lan_thu;
        $thang_da_nop       =$obj->thang_da_nop;
        $nam_hoc            =$obj->nam_hoc;
       	$nguoi_thu          =$obj->nguoi_thu;
       	$so_tien_thu        =$obj->so_tien_thu;
       	$noi_dung           =$obj->noi_dung;
        $sinh_vien_ma       =$obj->sinh_vien_ma;
        $muc_thu_ma         =$obj->muc_thu_ma;
    	DB::insert("INSERT into tbl_phieuthu(ma_phieu_thu,thoi_gian_thu,dot_thu,lan_thu,thang_da_nop,nam_hoc,nguoi_thu,so_tien_thu,noi_dung,sinh_vien_ma,muc_thu_ma)
            values(?,?,?,?,?,?,?,?,?,?,?)",[$id,$thoi_gian_thu,$dot_thu,$lan_thu,$thang_da_nop,$nam_hoc,$nguoi_thu,$so_tien_thu,$noi_dung,$sinh_vien_ma,$muc_thu_ma]);
    }

    /*static function updateSV($obj)
    {
    	
        $id                 =$obj->ma_phieu_thu;
        $thoi_gian_thu      =$obj->thoi_gian_thu;
        $lan_thu            =$obj->lan_thu;
        $nguoi_thu          =$obj->nguoi_thu;
        $so_tien_thu        =$obj->so_tien_thu;
        $tinh_trang         =$obj->tinh_trang;
        $ghi_chu            =$obj->ghi_chu;
        $sinh_vien_ma       =$obj->sinh_vien_ma;
        $muc_thu_ma         =$obj->muc_thu_ma;
    	$phieuthu=DB::update("UPDATE tbl_phieuthu set
    		thoi_gian_thu	= ?,
    		lan_thu		    = ?,
    		nguoi_thu		= ?,
    		so_tien_thu	    = ?,
    		tinh_trang	    = ?,
    		ghi_chu		    = ?,
    		sinh_vien_ma	= ?,
    		muc_thu_ma	    = ?
            where ma_phieu_thu=?",[$thoi_gian_thu,$lan_thu,$nguoi_thu,$so_tien_thu,$tinh_trang,$ghi_chu,$sinh_vien_ma,$muc_thu_ma,$id]);
    	return $phieuthu;
    } */

    static function deleteSV($id)
    {
        DB::delete("DELETE from tbl_phieuthu where ma_phieu_thu=?",[$id]);
    }

    /*static function get_distinct()
    {
        $list_distinct=DB::select("SELECT distinct(tinh_trang) from tbl_phieuthu");
        return $list_distinct;
    }*/

    static function dot_thu_group($lan_thu,$ma_sinh_vien)
    {
        $sql="SELECT dot_thu,thang_da_nop,nam_hoc from tbl_phieuthu where lan_thu=? and sinh_vien_ma=?" ; 
        $dot_thu=DB::select($sql,[$lan_thu,$ma_sinh_vien]);
        return $dot_thu;
    }

    static function nam_hoc_group($lan_thu,$ma_sinh_vien)
    {
        $sql="SELECT nam_hoc from tbl_phieuthu where lan_thu=? and sinh_vien_ma=? group by nam_hoc" ; 
        $nam_hoc=DB::select($sql,[$lan_thu,$ma_sinh_vien]);
        return $nam_hoc;
    }

    static function da_nop($ma_sv){
        $da_nop=DB::select('SELECT sum(so_tien_thu) as da_nop from tbl_phieuthu where sinh_vien_ma=? group by(sinh_vien_ma)  ',[$ma_sv]);
        return $da_nop[0];
    }

    static function get_phieu_thu_sv($ma_sv)
    {
        $phieuthu_sv=DB::select(
            "SELECT tbl_B.sinh_vien_ma,tbl_B.ten_sinh_vien,tbl_B.nguoi_thu,tbl_B.lan_thu,tbl_B.thoi_gian_thu,SUM(tbl_B.so_tien_thu) as so_tien_thu,tbl_B.noi_dung,tbl_B.ty_le_phan_tram,tbl_B.muc_thu_qui_dinh,tbl_B.ten_hinh_thuc,tbl_B.ty_le_giam,tbl_B.khoa_hoc_ma
            from
                (SELECT tbl_A.*,tbl_lop.ten_lop,tbl_lop.nganh_ma,tbl_lop.khoa_hoc_ma,tbl_hocbong.ty_le_phan_tram,tbl_hinhthucnop.ten_hinh_thuc,tbl_hinhthucnop.so_thang,tbl_hinhthucnop.ty_le_giam
                from  
                    (SELECT tbl_phieuthu.*,tbl_sinhvien.ten_sinh_vien,tbl_sinhvien.email,tbl_sinhvien.ngay_sinh,tbl_sinhvien.trang_thai,tbl_sinhvien.gioi_tinh,tbl_sinhvien.sdt,tbl_sinhvien.dia_chi,tbl_sinhvien.lop_ma,tbl_sinhvien.hoc_bong_ma,tbl_mucthu.muc_thu_qui_dinh,tbl_mucthu.hinh_thuc_ma
                    from tbl_phieuthu 
                        inner join tbl_sinhvien on tbl_phieuthu.sinh_vien_ma=tbl_sinhvien.ma_sinh_vien 
                        inner join tbl_mucthu on tbl_phieuthu.muc_thu_ma=tbl_mucthu.ma_muc_thu
                    )tbl_A
                inner join tbl_lop on tbl_A.lop_ma=tbl_lop.ma_lop
                inner join tbl_hocbong on tbl_A.hoc_bong_ma=tbl_hocbong.ma_hoc_bong
                inner join tbl_hinhthucnop on tbl_A.hinh_thuc_ma=tbl_hinhthucnop.ma_hinh_thuc
                )tbl_B
            inner join tbl_nganh on tbl_B.nganh_ma=tbl_nganh.ma_nganh
            inner join tbl_khoahoc on tbl_B.khoa_hoc_ma=tbl_khoahoc.ma_khoa_hoc
            where tbl_B.sinh_vien_ma=?
            group by tbl_B.lan_thu,tbl_B.thoi_gian_thu",[$ma_sv]);

        return $phieuthu_sv;
    }

    static function get_print_PT($ma_sv,$lan_thu)
    {
        $phieuthu_sv=DB::select(
                "
                SELECT tbl_B.sinh_vien_ma,tbl_B.ten_sinh_vien,tbl_B.nguoi_thu,tbl_B.lan_thu,tbl_B.thoi_gian_thu,SUM(tbl_B.so_tien_thu) as so_tien_thu,tbl_B.noi_dung,tbl_B.ten_lop,tbl_B.ty_le_phan_tram,tbl_B.nganh_ma,tbl_nganh.ten_nganh,tbl_B.ten_hinh_thuc,tbl_B.dia_chi,tbl_B.khoa_hoc_ma
                from
                    (SELECT tbl_A.*,tbl_lop.ten_lop,tbl_lop.nganh_ma,tbl_lop.khoa_hoc_ma,tbl_hocbong.ty_le_phan_tram,tbl_hinhthucnop.ma_hinh_thuc,tbl_hinhthucnop.ten_hinh_thuc,tbl_hinhthucnop.so_thang
                    from  
                        (SELECT tbl_phieuthu.*,tbl_sinhvien.ten_sinh_vien,tbl_sinhvien.dia_chi,tbl_sinhvien.lop_ma,tbl_sinhvien.hoc_bong_ma,tbl_mucthu.muc_thu_qui_dinh,tbl_mucthu.hinh_thuc_ma
                        from tbl_phieuthu 
                            inner join tbl_sinhvien on tbl_phieuthu.sinh_vien_ma=tbl_sinhvien.ma_sinh_vien 
                            inner join tbl_mucthu on tbl_phieuthu.muc_thu_ma=tbl_mucthu.ma_muc_thu
                        )tbl_A
                    inner join tbl_lop on tbl_A.lop_ma=tbl_lop.ma_lop
                    inner join tbl_hocbong on tbl_A.hoc_bong_ma=tbl_hocbong.ma_hoc_bong
                    inner join tbl_hinhthucnop on tbl_A.hinh_thuc_ma=tbl_hinhthucnop.ma_hinh_thuc
                    )tbl_B
                inner join tbl_nganh on tbl_B.nganh_ma=tbl_nganh.ma_nganh
                inner join tbl_khoahoc on tbl_B.khoa_hoc_ma=tbl_khoahoc.ma_khoa_hoc
                where tbl_B.sinh_vien_ma=? and tbl_B.lan_thu=?
                group by tbl_B.lan_thu,tbl_nganh.ten_nganh",[$ma_sv,$lan_thu]);

        return $phieuthu_sv[0];
    }

   /* static function get_thu_phi_theo_nganh($ma_nganh,$ma_khoa_hoc,$start,$end)
    {
        $thong_ke=DB::select("
        SELECT Count(tbl_B.ma_phieu_thu) as so_luong_dong,sum(tbl_B.so_tien_thu) as so_tien_thu,sum(tbl_B.hoc_bong) as hoc_bong,tbl_B.ma_lop,tbl_B.thoi_gian_thu from
        (SELECT tbl_A.ma_phieu_thu,tbl_A.thoi_gian_thu,tbl_lop.ma_lop,(tbl_A.muc_thu_qui_dinh*tbl_hocbong.ty_le_phan_tram/100) as hoc_bong,Sum(tbl_A.so_tien_thu) as so_tien_thu
            from  
                (SELECT tbl_phieuthu.sinh_vien_ma,tbl_phieuthu.thoi_gian_thu,tbl_phieuthu.ma_phieu_thu,tbl_phieuthu.so_tien_thu,tbl_sinhvien.*,tbl_mucthu.muc_thu_qui_dinh,tbl_mucthu.hinh_thuc_ma
                from tbl_phieuthu 
                    inner join tbl_sinhvien on tbl_phieuthu.sinh_vien_ma=tbl_sinhvien.ma_sinh_vien 
                    inner join tbl_mucthu on tbl_phieuthu.muc_thu_ma=tbl_mucthu.ma_muc_thu
                )tbl_A
            inner join tbl_lop on tbl_A.lop_ma=tbl_lop.ma_lop
            inner join tbl_hocbong on tbl_A.hoc_bong_ma=tbl_hocbong.ma_hoc_bong
            inner join tbl_hinhthucnop on tbl_A.hinh_thuc_ma=tbl_hinhthucnop.ma_hinh_thuc
            where tbl_A.thoi_gian_thu > 0 and tbl_A.thoi_gian_thu < 0
            group by tbl_A.sinh_vien_ma,tbl_lop.ma_lop,tbl_hocbong.ty_le_phan_tram)tbl_B
            group by tbl_B.ma_lop,tbl_B.thoi_gian_thu ");

        return $thong_ke;
    }*/
    static function check_thang_now($ma_sv,$month_now,$year_now)
    {
        $check=DB::select("SELECT thang_da_nop, sinh_vien_ma from tbl_phieuthu where sinh_vien_ma=? and thang_da_nop=? and nam_hoc=?",[$ma_sv,$month_now,$year_now]);
        return $check[0];
    }

    static function get_da_nop($ma_lop,$month,$year,$month_now,$year_now)
    {
        $thong_ke=DB::select(" 
            SELECT tbl_A.sinh_vien_ma
                from  
                    (SELECT tbl_phieuthu.*,tbl_sinhvien.lop_ma
                    from tbl_phieuthu 
                        inner join tbl_sinhvien on tbl_phieuthu.sinh_vien_ma=tbl_sinhvien.ma_sinh_vien 
                    )tbl_A
                inner join tbl_lop on tbl_A.lop_ma=tbl_lop.ma_lop
                where tbl_A.lop_ma=? and (tbl_A.thang_da_nop >=?  and tbl_A.nam_hoc >=?) or (tbl_A.thang_da_nop <=? and tbl_A.nam_hoc <=?) group by tbl_A.sinh_vien_ma
            ",[$ma_lop,$month,$year,$month_now,$year_now]);
        return $thong_ke;
    }

    static function get_bao_cao_theo_lop($ma_lop,$start,$end)
    {
        $thong_ke=DB::select("
           SELECT tbl_B.sinh_vien_ma,tbl_B.ten_sinh_vien,tbl_B.nguoi_thu,tbl_B.lan_thu,tbl_B.thoi_gian_thu,SUM(tbl_B.so_tien_thu) as so_tien_thu,tbl_B.noi_dung,tbl_B.ty_le_phan_tram,tbl_B.muc_thu_qui_dinh,tbl_B.ten_hinh_thuc,tbl_B.ty_le_giam,tbl_B.khoa_hoc_ma,tbl_nganh.ten_nganh,tbl_khoahoc.ten_khoa_hoc,tbl_B.ten_lop
            from
                (SELECT tbl_A.*,tbl_lop.ten_lop,tbl_lop.nganh_ma,tbl_lop.khoa_hoc_ma,tbl_hocbong.ty_le_phan_tram,tbl_hinhthucnop.ten_hinh_thuc,tbl_hinhthucnop.so_thang,tbl_hinhthucnop.ty_le_giam
                from  
                    (SELECT tbl_phieuthu.*,tbl_sinhvien.ten_sinh_vien,tbl_sinhvien.lop_ma,tbl_sinhvien.hoc_bong_ma,tbl_mucthu.muc_thu_qui_dinh,tbl_mucthu.hinh_thuc_ma
                    from tbl_phieuthu 
                        inner join tbl_sinhvien on tbl_phieuthu.sinh_vien_ma=tbl_sinhvien.ma_sinh_vien 
                        inner join tbl_mucthu on tbl_phieuthu.muc_thu_ma=tbl_mucthu.ma_muc_thu
                    )tbl_A
                inner join tbl_lop on tbl_A.lop_ma=tbl_lop.ma_lop
                inner join tbl_hocbong on tbl_A.hoc_bong_ma=tbl_hocbong.ma_hoc_bong
                inner join tbl_hinhthucnop on tbl_A.hinh_thuc_ma=tbl_hinhthucnop.ma_hinh_thuc
                )tbl_B
            inner join tbl_nganh on tbl_B.nganh_ma=tbl_nganh.ma_nganh
            inner join tbl_khoahoc on tbl_B.khoa_hoc_ma=tbl_khoahoc.ma_khoa_hoc
            where tbl_B.lop_ma=? and (DATE(tbl_B.thoi_gian_thu) >= ? and DATE(tbl_B.thoi_gian_thu) <=?)
            group by tbl_B.lan_thu,tbl_B.thoi_gian_thu,tbl_nganh.ten_nganh,tbl_khoahoc.ten_khoa_hoc",[$ma_lop,$start,$end]);
        return $thong_ke;
    }

    static function nop_muon($ma_lop,$month,$year)
    {
        $thong_ke=DB::select("
            SELECT tbl_B.ten_sinh_vien,tbl_B.email,tbl_B.ngay_sinh,tbl_B.trang_thai,tbl_B.gioi_tinh,tbl_B.sdt,tbl_B.thoi_gian_thu,tbl_B.khoa_hoc_ma,tbl_nganh.ten_nganh,tbl_khoahoc.ten_khoa_hoc,tbl_B.ten_lop,tbl_B.so_thang,tbl_B.sinh_vien_ma
            from(
                SELECT tbl_A.*,tbl_lop.nganh_ma,tbl_lop.khoa_hoc_ma,tbl_lop.ten_lop,tbl_hinhthucnop.so_thang
                from  
                    (SELECT tbl_phieuthu.*,tbl_sinhvien.ten_sinh_vien,tbl_sinhvien.email,tbl_sinhvien.ngay_sinh,tbl_sinhvien.trang_thai,tbl_sinhvien.gioi_tinh,tbl_sinhvien.sdt,tbl_sinhvien.dia_chi,tbl_sinhvien.lop_ma,tbl_mucthu.muc_thu_qui_dinh,tbl_mucthu.hinh_thuc_ma
                    from tbl_phieuthu 
                        inner join tbl_sinhvien on tbl_phieuthu.sinh_vien_ma=tbl_sinhvien.ma_sinh_vien 
                        inner join tbl_mucthu on tbl_phieuthu.muc_thu_ma=tbl_mucthu.ma_muc_thu
                    )tbl_A
                inner join tbl_lop on tbl_A.lop_ma=tbl_lop.ma_lop
                inner join tbl_hinhthucnop on tbl_A.hinh_thuc_ma=tbl_hinhthucnop.ma_hinh_thuc
            )tbl_B
            inner join tbl_nganh on tbl_B.nganh_ma=tbl_nganh.ma_nganh
            inner join tbl_khoahoc on tbl_B.khoa_hoc_ma=tbl_khoahoc.ma_khoa_hoc
            where tbl_B.lop_ma=? and tbl_B.thang_da_nop=? and tbl_B.nam_hoc=?",[$ma_lop,$month,$year]); 
        return $thong_ke;
    }

    static function get_sinh_vien_thoi_gian_thu($ma_sv,$month,$year)
    {
        $thong_ke=DB::select("
            SELECT tbl_B.ten_sinh_vien,tbl_B.email,tbl_B.ngay_sinh,tbl_B.trang_thai,tbl_B.gioi_tinh,tbl_B.sdt,tbl_B.thoi_gian_thu,tbl_B.khoa_hoc_ma,tbl_nganh.ten_nganh,tbl_khoahoc.ma_khoa_hoc,tbl_B.ten_lop,tbl_B.so_thang,tbl_B.sinh_vien_ma
            from(
                SELECT tbl_A.*,tbl_lop.nganh_ma,tbl_lop.khoa_hoc_ma,tbl_lop.ten_lop,tbl_hinhthucnop.so_thang
                from  
                    (SELECT tbl_phieuthu.*,tbl_sinhvien.ten_sinh_vien,tbl_sinhvien.email,tbl_sinhvien.ngay_sinh,tbl_sinhvien.trang_thai,tbl_sinhvien.gioi_tinh,tbl_sinhvien.sdt,tbl_sinhvien.dia_chi,tbl_sinhvien.lop_ma,tbl_mucthu.muc_thu_qui_dinh,tbl_mucthu.hinh_thuc_ma
                    from tbl_phieuthu 
                        inner join tbl_sinhvien on tbl_phieuthu.sinh_vien_ma=tbl_sinhvien.ma_sinh_vien 
                        inner join tbl_mucthu on tbl_phieuthu.muc_thu_ma=tbl_mucthu.ma_muc_thu
                    )tbl_A
                inner join tbl_lop on tbl_A.lop_ma=tbl_lop.ma_lop
                inner join tbl_hinhthucnop on tbl_A.hinh_thuc_ma=tbl_hinhthucnop.ma_hinh_thuc
            )tbl_B
            inner join tbl_nganh on tbl_B.nganh_ma=tbl_nganh.ma_nganh
            inner join tbl_khoahoc on tbl_B.khoa_hoc_ma=tbl_khoahoc.ma_khoa_hoc
            where tbl_B.sinh_vien_ma=? and tbl_B.thang_da_nop=? and tbl_B.nam_hoc=?
            group by tbl_B.lan_thu,tbl_B.thang_da_nop,tbl_nganh.ten_nganh,tbl_khoahoc.ma_khoa_hoc",[$ma_sv,$month,$year]); 
        return $thong_ke[0];
    }
    static function doc_tien($tien)
    {
        if($tien <=0)
        {
            echo "Tiền phải là số nguyên dương lớn hơn số 0";
        }

        $Text=array("không", "một", "hai", "ba", "bốn", "năm", "sáu", "bảy", "tám", "chín");
        $TextLuythua =array("","nghìn", "triệu", "tỷ", "ngàn tỷ", "triệu tỷ", "tỷ tỷ");
        $textnumber = "";
        $length = strlen($tien);

        for ($i = 0; $i < $length; $i++){
            $unread[$i] = 0;
        }   

        for ($i = 0; $i < $length; $i++)
        {
            $so = substr($tien, $length - $i -1 , 1);
            if ( ($so == 0) && ($i % 3 == 0) && ($unread[$i] == 0)){
                for ($j = $i+1 ; $j < $length ; $j ++){
                    $so1 = substr($tien,$length - $j -1, 1);
                    if ($so1 != 0){
                        break;
                    }
                }

                if (intval(($j - $i )/3) > 0){
                    for ($k = $i ; $k <intval(($j-$i)/3)*3 + $i; $k++){
                        $unread[$k] =1;
                    }
                }
            }
        }

        for ($i = 0; $i < $length; $i++){
            $so = substr($tien,$length - $i -1, 1);  
            if ($unread[$i] ==1) continue;

            if ( ($i% 3 == 0) && ($i > 0)) $textnumber = $TextLuythua[$i/3] ." ". $textnumber;

            if ($i % 3 == 2 ) $textnumber = 'trăm ' . $textnumber;

            if ($i % 3 == 1) $textnumber = 'mươi ' . $textnumber;

            $textnumber = $Text[$so] ." ". $textnumber;
        }

        $textnumber = str_replace("không mươi", "lẻ", $textnumber);
        $textnumber = str_replace("lẻ không", "", $textnumber);
        $textnumber = str_replace("mươi không", "mươi", $textnumber);
        $textnumber = str_replace("một mươi", "mười", $textnumber);
        $textnumber = str_replace("mươi năm", "mươi lăm", $textnumber);
        $textnumber = str_replace("mươi một", "mươi mốt", $textnumber);
        $textnumber = str_replace("mười năm", "mười lăm", $textnumber);

        $string = ucfirst($textnumber."đồng chẵn");
        return $string;
    }
}

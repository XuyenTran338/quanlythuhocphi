<?php

use Illuminate\Database\Seeder;

class TaiKhoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_taikhoan')->insert([
	        [
	        	'ma_tai_khoan'	=>	'TK0001',
	        	'email'			=>	'xuyentran98moon@gmail.com',
	        	'ten_tai_khoan'	=>	'xuyen_tran_98',
	        	'mat_khau'		=>	bcrypt('123456789'),
	        	'phan_quyen'	=>	1,
	        	'ho_ten'		=>	'Trần Văn Xuyên'
	        ],

	        [
	        	'ma_tai_khoan'	=>	'TK0002',
	        	'email'			=>	'tuansacca@gmail.com',
	        	'ten_tai_khoan'	=>	'tuan_sacca',
	        	'mat_khau'		=>	bcrypt('12345678'),
	        	'phan_quyen'	=>	2,
	        	'ho_ten'		=>	'Phạm Văn Tuấn'
	        ],

	        [
	        	'ma_tai_khoan'	=>	'TK0003',
	        	'email'			=>	'bachngocnhat@gmail.com',
	        	'ten_tai_khoan'	=>	'ngoc_nhat',
	        	'mat_khau'		=>	bcrypt('1234567'),
	        	'phan_quyen'	=>	3,
	        	'ho_ten'		=>	'Bạch Ngọc Nhật'
	        ],
        	
        ]);
    }
}

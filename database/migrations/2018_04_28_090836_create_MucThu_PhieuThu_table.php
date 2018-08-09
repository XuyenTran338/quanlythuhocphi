<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMucThuPhieuThuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_mucthu', function (Blueprint $table) {
            $table->string('ma_muc_thu',8)->primary();
            $table->string('nganh_ma',8);
            $table->string('hinh_thuc_ma',8);
            $table->double('muc_thu_qui_dinh',15,0)->unsign();
            $table->foreign('nganh_ma')->references('ma_nganh')->on('tbl_nganh')->onDelete('cascade');
            $table->foreign('hinh_thuc_ma')->references('ma_hinh_thuc')->on('tbl_hinhthucnop')->onDelete('cascade');    
        });

        Schema::create('tbl_phieuthu', function (Blueprint $table) {
            $table->string('ma_phieu_thu',8)->primary();
            $table->datetime('thoi_gian_thu');
            $table->integer('lan_thu')->unsign();
            $table->integer('dot_thu')->unsign();
            $table->string('nguoi_thu',30);
            $table->double('so_tien_thu',15,0);
            $table->integer('tinh_trang')->unsign();
            $table->text('noi_dung');
            $table->boolean('tinh_trang');
            $table->string('sinh_vien_ma',8);
            $table->foreign('sinh_vien_ma')->references('ma_sinh_vien')->on('tbl_sinhvien')->nDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('tbl_mucthu');
          Schema::dropIfExists('tbl_phieuthu');
    }
}

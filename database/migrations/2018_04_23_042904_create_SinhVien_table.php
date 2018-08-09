<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSinhVienTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_sinhvien', function (Blueprint $table) {
            $table->string('ma_sinh_vien',8)->primary();
            $table->string('ten_sinh_vien',30);
            $table->date('ngay_sinh');
            $table->string('email',30);
            $table->boolean('gioi_tinh');
            $table->string('dia_chi');
            $table->boolean('trang_thai');
            $table->text('ghi_chu');
            $table->string('hoc_bong_ma',8);
            $table->string('lop_ma',8);
            $table->foreign('hoc_bong_ma')->references('ma_hoc_bong')->on('tbl_hocbong');
            $table->foreign('lop_ma')->references('ma_lop')->on('tbl_lop');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_sinhvien');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLopTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_lop', function (Blueprint $table) {
            $table->string('ma_lop',8)->primary();
            $table->string('ten_lop',30);
            $table->integer('si_so')->unsign();
            $table->string('giao_vien_chu_nhiem',30);
            $table->text('trang_thai');
            $table->string('nganh_ma',8);
            $table->string('khoa_hoc_ma',8);
            $table->foreign('nganh_ma')->references('ma_nganh')->on('tbl_nganh');
            $table->foreign('khoa_hoc_ma')->references('ma_khoa_hoc')->on('tbl_khoahoc');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_lop');
    }
}

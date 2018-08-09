<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKhoaHocTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_khoahoc', function (Blueprint $table) {
            $table->string('ma_khoa_hoc',8)->primary();
            $table->string('ten_khoa_hoc',30);
            $table->date('ngay_bat_dau');
            $table->date('ngay_ket_thuc');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_khoahoc');
    }
}

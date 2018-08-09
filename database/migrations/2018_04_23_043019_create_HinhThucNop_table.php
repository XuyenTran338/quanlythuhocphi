<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHinhThucNopTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_hinhthucnop', function (Blueprint $table) {
            $table->string('ma_hinh_thuc',8)->primary();
            $table->string('ten_hinh_thuc',30);
            $table->integer('so_Thang')->unsign();
            $table->float('ty_le_giam')->unsign();
            $table->text('ghi_chu');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_hinhthucnop');
    }
}

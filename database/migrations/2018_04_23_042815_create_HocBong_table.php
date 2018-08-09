<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHocBongTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_hocbong', function (Blueprint $table) {
            $table->string('ma_hoc_bong',8)->primary();
            $table->string('ten_hoc_bong',100);
            $table->integer('ty_le_phan_tram')->unsign();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_hocbong');
    }
}

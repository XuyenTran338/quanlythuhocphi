<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaiKhoanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_taikhoan', function (Blueprint $table) {
            $table->string('ma_tai_khoan',8);
            $table->string('email',30);
            $table->string('ten_tai_khoan',30);
            $table->primary(array('ma_tai_khoan','email','ten_tai_khoan'));
            $table->string('mat_khau',225);
            $table->integer('phan_quyen')->unsign();
            $table->string('ho_ten',30);
            $table->datetime('lan_truy_cap_cuoi');
            $table->boolean('gioi_tinh');
            $table->string('SDT',15);
            $table->string('image',100);
        });

        

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_taikhoan');
    }
}

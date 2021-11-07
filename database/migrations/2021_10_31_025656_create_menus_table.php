<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Tạo bảng Menus
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('name',255);
            $table->integer('parent_id');
            $table->text('description');// mô tả detail
            $table->longText('content');
            $table->string('slup',255)->unique();//không được trùng
            $table->integer('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}

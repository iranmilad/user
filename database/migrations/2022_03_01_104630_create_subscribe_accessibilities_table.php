<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscribe_accessibilities', function (Blueprint $table) {
            $table->increments("id");
            $table->unsignedInteger("subscribe_id");
            $table->integer("reference_id");
            $table->tinyInteger("reference_type")->comment("1:charts     2:menus   3:memberList");
            $table->integer("refresh_time")->nullable();
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
        Schema::dropIfExists('subscribe_accessibilities');
    }
};

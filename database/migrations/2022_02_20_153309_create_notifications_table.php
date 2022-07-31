<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
	public function up()
	{
		Schema::create('notifications', function (Blueprint $table) {
			$table->bigIncrements("id");
			$table->string("title");
			$table->text("text");
			$table->tinyInteger("type")->comment('1:public             2:privaite')->default(1);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('notifications');
	}
}
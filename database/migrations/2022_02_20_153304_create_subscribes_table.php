<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscribesTable extends Migration
{
	public function up()
	{
		Schema::create('subscribes', function (Blueprint $table) {
			$table->increments("id");
			$table->string("title");
			$table->text("description");
			$table->bigInteger("price");
			$table->integer("period");
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('subscribes');
	}
}
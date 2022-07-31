<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
	public function up()
	{
		Schema::create('menus', function (Blueprint $table) {
			$table->increments("id");
			$table->string("title");
			$table->string("key")->unique();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('menus');
	}
}
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChartsTable extends Migration
{
	public function up()
	{
		Schema::create('charts', function (Blueprint $table) {
			$table->increments("id");
			$table->string("title");
			$table->string("key")->unique();			
			$table->integer("refresh_time");
			$table->string("feeder_url")->nullable();
			$table->softDeletes();
			$table->bigInteger("deleted_by")->nullable();

			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('charts');
	}
}
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
	public function up()
	{
		Schema::create('admins', function (Blueprint $table) {
			$table->increments("id");
			$table->string("first_name")->nullable();
			$table->string("last_name")->nullable();
			$table->string("mobile")->nullable()->unique();
			$table->boolean("supper_admin")->default(0);
			$table->string("password");
			$table->boolean("active")->default(1);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('admins');
	}
}
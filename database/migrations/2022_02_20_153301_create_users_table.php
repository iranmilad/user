<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
	public function up()
	{
		Schema::create('users', function (Blueprint $table) {
			$table->bigIncrements("id");
			$table->string("first_name")->nullable();
			$table->string("last_name")->nullable();
			$table->string("mobile")->nullable()->unique();
			$table->string("email")->nullable()->unique();
			$table->timestamp("email_verified_at")->nullable();
			$table->string("password");
			$table->boolean("active")->default(1);
			$table->softDeletes();
			$table->bigInteger("deleted_by")->nullable();

			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('users');
	}
}
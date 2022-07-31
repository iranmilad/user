<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSubscribesTable extends Migration
{
	public function up()
	{
		Schema::create('user_subscribes', function (Blueprint $table) {
			$table->bigIncrements("id");
			$table->unsignedBigInteger("user_id");
			$table->integer("subscribe_id");
			$table->string("title");
			$table->bigInteger("price");
			$table->string("payment_gu_id")->nullable();
			$table->timestamp("expire_at")->nullable();
			$table->softDeletes();
			$table->bigInteger("deleted_by")->nullable();

			$table->timestamps();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
		});
	}

	public function down()
	{
		Schema::dropIfExists('user_subscribes');
	}
}
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
	public function up()
	{
		Schema::create('payments', function (Blueprint $table) {
			$table->bigIncrements("id");
			$table->string("gu_id");
			$table->unsignedBigInteger("user_id");
			$table->bigInteger("reference_id");
			$table->string("ref_id")->nullable();
			$table->bigInteger("amount");
			$table->tinyInteger("state")->comment('0:pending     1:success     2:error     3:cancel')->default(0);
			$table->tinyInteger("type")->comment('1:subscribe')->default(1);
			$table->softDeletes();
			$table->bigInteger("deleted_by")->nullable();

			$table->timestamps();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
		});
	}

	public function down()
	{
		Schema::dropIfExists('payments');
	}
}
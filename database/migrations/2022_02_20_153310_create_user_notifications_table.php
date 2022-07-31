<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserNotificationsTable extends Migration
{
	public function up()
	{
		Schema::create('user_notifications', function (Blueprint $table) {
			$table->bigIncrements("id");
			$table->unsignedBigInteger("user_id");
			$table->unsignedBigInteger("notification_id");
			$table->timestamp("seen_at")->nullable();
			$table->timestamps();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->foreign('notification_id')->references('id')->on('notifications')->onDelete('cascade');
		});
	}

	public function down()
	{
		Schema::dropIfExists('user_notifications');
	}
}
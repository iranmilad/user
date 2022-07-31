<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserQuestionsTable extends Migration
{
	public function up()
	{
		Schema::create('user_questions', function (Blueprint $table) {
			$table->bigIncrements("id");
			$table->unsignedBigInteger("user_id");
			$table->string("type");
			$table->string("title");
			$table->text("question");
			$table->text("answer")->nullable();
			$table->timestamp("answerd_at")->nullable();
			$table->unsignedInteger("answerd_by")->nullable();
			$table->timestamps();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
		});
	}

	public function down()
	{
		Schema::dropIfExists('user_questions');
	}
}
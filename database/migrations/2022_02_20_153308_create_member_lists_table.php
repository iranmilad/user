<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberListsTable extends Migration
{
	public function up()
	{
		Schema::create('member_lists', function (Blueprint $table) {
			$table->bigIncrements("id");
			$table->string("title",150);
			$table->text("description");
			$table->timestamps();
	
		});
	}

	public function down()
	{
		Schema::dropIfExists('member_lists');
	}
}
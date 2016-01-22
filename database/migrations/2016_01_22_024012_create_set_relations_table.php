<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSetRelationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('setrelations', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('setid')->unsigned();
			$table->foreign('setid')->references('id')->on('sets');
			$table->integer('checkid')->unsigned();
			$table->foreign('checkid')->references('id')->on('checks');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('set_relations');
	}

}

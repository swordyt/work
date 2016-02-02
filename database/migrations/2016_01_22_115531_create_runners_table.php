<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRunnersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('runners', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('setid')->unsigned();
			$table->foreign('setid')->references('id')->on('sets');
			$table->integer('requestid')->unsigned();
			$table->foreign('requestid')->references('id')->on('interrequests');
			$table->integer('checkid')->unsigned();
			$table->foreign('checkid')->references('id')->on('checks');
			$table->string('state')->default('static'); //static未执行，wait等待，running正在执行，complete执行完成。
			$table->integer('checkstate')->default(0);//0未执行检查点，1执行检查点。
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
		Schema::drop('runners');
	}

}

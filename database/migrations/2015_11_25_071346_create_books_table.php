<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('work')->create('books',function(Blueprint $table){
			$table->increments('id');
			$table->string('BookName',100);
			$table->date('BorrowDate');
			$table->string('Borrower',50);
			$table->longText('remark')->nullable();
			$table->integer('manager_id')->unsigned();
			$table->foreign('manager_id')->references('id')->on('users');
			$table->softDeletes();
			$table->timestamps();
			$table->rememberToken();

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}

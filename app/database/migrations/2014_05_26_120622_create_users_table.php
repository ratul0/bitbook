<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function($table)
		{
			$table->increments('id');
			$table->string('full_name', 60);
			$table->string('email', 50)->unique();
			$table->string('password');
			$table->enum('gender', ['Male', 'Female'])->nullable();
			$table->string('mobile')->nullable();
			$table->date('date_of_birth')->nullable();
			$table->string('website')->nullable();
			$table->text('about_me')->nullable();
			$table->string('remember_token');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
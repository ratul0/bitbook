<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{
		$users = [];

		for($i = 1; $i < 100; $i++)
		{
			$users[] = [
				'full_name'  =>		"User $i",
				'email'      =>		'user'.$i.'@bitbook.com',
				'password'   =>		Hash::make('user'.$i),
				'created_at' =>		date('Y-m-d H-i-s'),
				'updated_at' =>		date('Y-m-d H-i-s')
			];
		}

		DB::table('users')->insert($users);
	}
}
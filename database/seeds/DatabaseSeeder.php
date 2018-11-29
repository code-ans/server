<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	public function run()
	{
		// $this->call(UserSeeder::class);
		// $this->call(RoleSeeder::class);
		$this->call(CodeSeeder::class);
		$this->call(TaskSeeder::class);
	}
}

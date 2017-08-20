<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('users')->delete();
		
		// $user1 = App\User::create(['name' => 'Basi', 'assigned_to' => 'Nothing' ,'position' => 'Backend Developer' ,'dp_img' => ' ' ,  'email' => 'basi@bluroe.com', 'password' => Hash::make('nevergiveup')]);
		$user2 = App\User::create(['name' => 'Hanjaz', 'assigned_to' => 'Nothing' ,'position' => 'Backend Developer' ,'dp_img' => ' ', 'email' => 'roshan@bluroe.com', 'password' => Hash::make('nevergiveup')]);
		$user3 = App\User::create(['name' => 'Anu', 'assigned_to' => 'Nothing' ,'position' => 'Javascript Developer' ,'dp_img' => ' ', 'email' => 'anu@bluroe.com', 'password' => Hash::make('nevergiveup')]);
		$user3 = App\User::create(['name' => 'Waxx', 'assigned_to' => 'Nothing' ,'position' => 'Frontend Developer' ,'dp_img' => ' ',  'email' => 'waxx04', 'password' => Hash::make('imcool')]);
		$user3 = App\User::create(['name' => 'Shibi', 'assigned_to' => 'Nothing' ,'position' => 'Backend Developer' ,'dp_img' => ' ',  'email' => 'shibi@bluroe.com', 'password' => Hash::make('nevergiveup')]);
		$user3 = App\User::create(['name' => 'Rixx', 'assigned_to' => 'Nothing' ,'position' => 'Frontend Developer' ,'dp_img' => ' ',  'email' => 'rinoy@bluroe.com', 'password' => Hash::make('nevergiveup')]);
		$user3 = App\User::create(['name' => 'Thirdeye Tech', 'assigned_to' => 'Nothing' ,'position' => 'Frontend Developer' ,'dp_img' => ' ',  'email' => 'thirdeye@blueciphers.com', 'password' => Hash::make('dotmatrix99')]);


		DB::table('products')->delete();
		$product1 = App\Products::create(['name' => 'Starcool', 'user_id' => 6, 'version' => '1.0', 'status' => 1, 'debugging' => 0]);
		

		DB::table('apicalls')->delete();
		$apiCalls = App\APICalls::create(['api' => 'gettechnitian', 'product_id' => 1, 'parameters' => '{object:"asd"}']);
		
	}

}

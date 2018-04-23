<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        DB::table('users')->delete();
        $users = array(
            ['name' => 'Shyam Makwana', 'email' => 'shyam@gmail.com', 'password' => Hash::make('secret')],
            ['name' => 'Roshan', 'email' => 'roshan@gmail.com', 'password' => Hash::make('secret')],
        );
        // Loop through each user above and create the record for them in the database
        foreach ($users as $user) {
            User::create($user);
        }
        Model::reguard();
    }
}

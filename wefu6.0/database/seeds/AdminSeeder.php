<?php

use App\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // Role_id will be 2 cause it is a customer
        $user = User::create([
            'full_name' => "AbdulRehman",
            'email' => "abdul789150@gmail.com",
            'username' => "abdul789150",
            'password' => bcrypt("12345678"),
        ]);
        
        $user->assignRole('admin');    
        
        $user->save();
    }
}

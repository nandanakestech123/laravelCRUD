<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\user;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        User::create(['name'=>'Admin','email'=>'admin12@gmail.com','password'=>bcrypt('admin@123'),'image'=>'admin.jpg']);  
    }

}

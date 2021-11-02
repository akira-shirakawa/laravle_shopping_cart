<?php

use Illuminate\Database\Seeder;
use App\Admin;
class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create(['name'=>'testuser','email'=>'test@example.com','password'=>bcrypt('p12345678')]);
    }
}

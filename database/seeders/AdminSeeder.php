<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::truncate();

        Admin::create([
            "first_name"=>"مهرداد",
            "last_name"=>"قربانی",
            "mobile"=>"09117845194",
            "password"=>Hash::make("123456"),
            "supper_admin"=>1,
            "active"=>1,
        ]);
    }
}

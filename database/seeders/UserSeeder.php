<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            ['name' => 'Santoso','email' => 'santoso@gmail.com','password' => Hash::make('12345678')],
            ['name' => 'Alfian','email' => 'alfian@gmail.com','password' => Hash::make('12345678')],
            ['name' => 'Aries','email' => 'aries@gmail.com','password' => Hash::make('12345678')],
            ['name' => 'Wahyu','email' => 'wahyu@gmail.com','password' => Hash::make('12345678')],
            ['name' => 'Yoga','email' => 'yoga@gmail.com','password' => Hash::make('12345678')],
        ];

        foreach($datas as $data){
            User::create($data);
        }
    }
}

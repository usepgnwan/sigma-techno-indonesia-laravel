<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count =  $this->command->ask('how much?');
        $check = $this->command->confirm('are you sure?');
        if($check){
            User::factory()->count($count)->create();
            $this->command->info('success create user');
        }else{
            $this->command->info('error create user');
        }
    }
}

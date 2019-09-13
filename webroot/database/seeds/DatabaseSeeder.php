<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      for ($i = 0; $i < 10; $i++) {
        $user = new User();
        $user->name = Str::random(10);
        $user->email = Str::random(10) . '@example.com';
        $user->password = \Illuminate\Support\Facades\Hash::make('password');
        $user->save();
      }
    }
}

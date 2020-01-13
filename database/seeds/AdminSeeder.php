<?php

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
        factory(\App\Models\User::class)->create([
            'email' => 'test@zdrojowainvest.pl',
            'name' => 'Administrator',
            'password' => \Illuminate\Support\Facades\Hash::make('123456')
        ]);
    }
}

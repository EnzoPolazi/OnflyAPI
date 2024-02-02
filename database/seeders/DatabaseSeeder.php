<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {   
        //Insere usuarios predefinidos
        $this->call([
            UsersSeeder::class,
        ]);

       //Insere usuarios randomizados 
        User::factory(10)->create();
    }
}

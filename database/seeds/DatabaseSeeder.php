<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    
    
    
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // disable the fill's methods
        Model::unguard();

        $this->call(UsersTableSeeder::class);
        $this->call(PostsTableSeeder::class);
    }
}

<?php

use App\Post;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $max = rand(10,30);
        for($i=0; $i < $max; $i++):
            Post::create([
                'title' => Str::random(rand(5,15)),
                'content'  => Str::random(rand(10,30)),
                'image' => "https://picsum.photos/id/" . rand(1,1000) . "/1000/300",
                'author' => Str::random(8).'@gmail.com',
            ]);

        endfor;

        $this->command->info($max . ' Post were created');
    }
}

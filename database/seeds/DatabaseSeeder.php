<?php

use Illuminate\Database\Seeder;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 1)->create();
        factory(App\Models\Post::class, 'publicMockPostData',30)->create();
        factory(App\Models\Tag::class, 30)->create();
        factory(App\Models\Category::class, 10)->create();

        $tags = App\Models\Tag::all();
        App\Models\Post::all()->each(static function ($post) use ($tags) {
            $post->tags()->attach(
                $tags->random(random_int(1, 30))->pluck('id')->toArray()
            );
        });
    }
}

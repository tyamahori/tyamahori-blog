<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Eloquent\PostOrm;
use App\Eloquent\TagOrm;
use App\Eloquent\CategoryOrm;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        factory(User::class, 1)->create();
        factory(PostOrm::class, 'publicMockPostData',30)->create();
        factory(TagOrm::class, 30)->create();
        factory(CategoryOrm::class, 10)->create();

        $tags = TagOrm::all();
        PostOrm::all()->each(static function ($post) use ($tags) {
            $post->tags()->attach(
                $tags->random(random_int(1, 30))->pluck('id')->toArray()
            );
        });
    }
}

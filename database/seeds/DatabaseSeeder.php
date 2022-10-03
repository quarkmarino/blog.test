<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminUserSeeder::class);

        $supervisors = factory(User::class, 3)->states('supervisor')->create()
            ->each(function ($user) {
                $user->posts()->save(factory(Post::class)->make());

                $bloggers = factory(User::class, 2)->states('blogger')->create()
                    ->each(function ($user) {
                        $user->posts()->saveMany(factory(Post::class, 2)->make());
                    });

                $user->bloggers()->attach($bloggers->pluck('id'));
            });
    }
}

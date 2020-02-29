<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersAndPostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create(['email' => 'admin@test.tld', 'type' => User::TYPE_ADMIN])->each(function ($user) {
            /** @var User $user */
            $user->post()->save(factory(App\Post::class)->make());
        });

        factory(User::class, 2)->create()->each(function ($user) {
            /** @var User $user */
            $user->post()->save(factory(App\Post::class)->make());
        });
    }
}

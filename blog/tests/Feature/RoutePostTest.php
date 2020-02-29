<?php

namespace Tests\Feature;

use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutePostTest extends TestCase
{
    use RefreshDatabase;

    public function testGuestUser()
    {
        $response = $this->get('/post');

        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    /**
     * @dataProvider userTypeProvider
     * @param $userType
     */
    public function testUserType($userType)
    {
        $user = factory(User::class)->create(['type' => $userType]);
        $post = factory(Post::class)->create(['user_id' => $user->id]);

        $response = $this
            ->actingAs($user)
            ->get('/post');

        $response->assertOk();
        $response->assertSeeText($post->content);
    }

    public function userTypeProvider() {
        return [
            [User::TYPE_USER],
            [User::TYPE_ADMIN],
        ];
    }
}

<?php

namespace Tests\Feature;

use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutePostsTest extends TestCase
{
    use RefreshDatabase;

    public function testGuestUser()
    {
        $response = $this->get('/posts');

        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    /**
     * @dataProvider userTypeProvider
     * @param $userType
     * @param $expectedStatusCode
     */
    public function testUserType($userType, $expectedStatusCode)
    {
        $user = factory(User::class)->create(['type' => $userType]);
        $post = factory(Post::class)->create(['user_id' => $user->id]);

        $user2 = factory(User::class)->create();
        $post2 = factory(Post::class)->create(['user_id' => $user2->id]);

        $response = $this
            ->actingAs($user)
            ->get('/posts');

        $response->assertStatus($expectedStatusCode);

        if ($expectedStatusCode === 200) {
            $response->assertSeeText($post->content);
            $response->assertSeeText($post2->content);
        }
    }

    public function userTypeProvider() {
        return [
            [User::TYPE_USER, 404],
            [User::TYPE_ADMIN, 200],
        ];
    }
}

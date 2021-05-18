<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use withoutExceptionHandling;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

class PostTestModel extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;
    public function setUp() :void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->post = Post::factory()->create(['user_id' => $this->user->id]);
        $this->comment = Comment::factory()->create([
            'user_id' => $this->user->id,
            'post_id' => $this->post->id,
        ]);
    }
    //database test
    public function testCountPost()
    {
        $posts = Post::factory()
                    ->count(4)
                    ->for($this->user)
                    ->create();
        $this->assertDatabaseCount('posts', 5);
        // $this->assertNotEmpty($posts->content);
    }

    public function testPostBelongstoUser()
    {
        // $this->withoutExceptionHandling();
        $this->actingAs($this->user);
        $this->assertInstanceOf(User::class, $this->post->user);
        $this->assertEquals(1, $this->post->user->count());
    }
    public function testPostHasmanyComment()
    {
        $post = Post::factory()
            ->has(Comment::factory()->count(3))
            ->create();
        $this->assertDatabaseCount('comments', 4);
        $this->assertTrue($this->post->comments->contains($this->comment));
        $this->assertEquals(1, $this->post->comments->count());
    }
    //Requset test
    // public function testPostIsCreatedSuccessfully()
    // {
    //     $post = Post::factory()->create([
    //         'user_id' => $this->user->id,
    //         'content' =>'this is post'
    //     ]);
    //     $this->assertDatabaseHas('posts', ['content' => 'this is post']);
    // }
    // public function testStoreWithPostIsCreatedError()
    // {
    //     $this->actingAs($this->user);
    //     $this->post->content = "";
    //     $response = $this->actingAs($this->user)->post('save-post', $this->post->toArray());
    //     $this->assertDatabaseMissing('posts', ['id'=> $this->post->id , 'content' => '']);
    // }
    // public function testShowPost()
    // {
    //     $this->actingAs($this->user)
    //             ->get('post/'.$this->post->id)
    //             ->assertStatus(200)
    //             ->assertSee($this->post->content);
    // }
    // public function testShowForMissingPost()
    // {
    //     $this->actingAs($this->user)
    //      ->get("post/0")
    //      ->assertStatus(404);
    // }
    // public function testUserIsOwnerOfPost()
    // {
    //     $author = User::factory()->create([
    //         'id' => 222
    //     ]);
    //     $post = Post::factory()
    //             ->for($author)
    //             ->create();
    //     $this->actingAs($author)->get('/edit-post/'.$post->id)->assertStatus(200);
    //     $this->actingAs($this->user)->get('/edit-post/'.$post->id)->assertStatus(403);
    // }

    // public function testUpdatePostSuccessfully()
    // {
    //     $this->actingAs($this->user);
    //     $this->post->content = "update-post";
    //     $response = $this->post('update-post/'.$this->post->id, $this->post->toArray());
    //     $this->assertDatabaseHas('posts', ['id'=> $this->post->id , 'content' => 'update-post']);
    // }
    // public function testUpdateForMissingPost()
    // {
    //     $this->actingAs($this->user);
    //     $this->post->content = "update-post";
    //     $response = $this->post('update-post/0', $this->post->toArray());
    //     $response->assertStatus(404);
    // }
    // public function testUserDeletePost()
    // {
    //     $this->actingAs($this->user);
    //     $this->get('/delete-post/'.$this->post->id);
    //     $this->assertDatabaseMissing('posts', ['id'=> $this->post->id]);
    // }
    // public function testDestroyForMissingUser()
    // {
    //     $this->actingAs($this->user);
    //     $this->get('/delete-post/0')
    //         ->assertStatus(404);
    // }
}

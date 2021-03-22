<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use withoutExceptionHandling;
use expectException;
use App\Models\User;
use App\Models\Post;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class PostTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;
    use WithoutMiddleware;
    public function setUp() :void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->post = Post::factory()->create(['user_id' => $this->user->id]);
    }
    public function testGettingAllPosts()
    {
        $user1 = User::factory()->create();
        $response = $this->actingAs($user1)->get('home');
        $response->assertStatus(200);
    }
    public function testCreatePost()
    {
        $data = [
            // 'user_id' => 1,
            'content' => "update-post",
            'status'=> 'public'
        ];
        $user1 = User::factory()->create();
        $response = $this->actingAs($user1)->post('save-post', $data);
        $this->assertDatabaseHas('posts', $data);
        // $response->assertStatus(200);
    }
    public function testShowPost()
    {
        $this->actingAs($this->user)
                ->get('post/'.$this->post->id)
                ->assertStatus(200)
                ->assertSee($this->post->content);
    }
    public function testShowForMissingPost()
    {
        $this->get("post/0")
         ->assertStatus(404);
    }
    public function testUserIsOwnerOfPost()
    {
        $author = User::factory()->create([
            'id' => 222
        ]);
        $post = Post::factory()
                ->for($author)
                ->create();
        $this->actingAs($author)->get('/edit-post/'.$post->id)->assertStatus(200);
        $this->actingAs($this->user)->get('/edit-post/'.$post->id)->assertStatus(403);
    }

    public function testUpdatePostSuccessfully()
    {
        $this->actingAs($this->user);
        $this->post->content = "update-post";
        $response = $this->post('update-post/'.$this->post->id, $this->post->toArray());
        $this->assertDatabaseHas('posts', ['id'=> $this->post->id , 'content' => 'update-post']);
    }
    public function testUpdateForMissingPost()
    {
        $this->actingAs($this->user);
        $this->post->content = "update-post";
        $response = $this->post('update-post/0', $this->post->toArray());
        $response->assertStatus(404);
    }
    public function testUserDeletePost()
    {
        $this->actingAs($this->user);
        $this->get('/delete-post/'.$this->post->id);
        $this->assertDatabaseMissing('posts', ['id'=> $this->post->id]);
    }
    public function testDestroyForMissingUser()
    {
        $this->actingAs($this->user);
        $this->get('/delete-post/0')
            ->assertStatus(404);
    }
}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use withoutExceptionHandling;
use expectException;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Reply;
use App\Models\Like;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;
    // use DatabaseMigrations;
    public function setUp() :void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->post = Post::factory()->create(['user_id' => $this->user->id]);
        $this->comment = Comment::factory()->create([
            'user_id' => $this->user->id,
            'post_id' =>$this->post->id,
        ]);
        $this->reply = Reply::factory()->create([
            'user_id' => $this->user->id,
            'comment_id' =>$this->comment->id,
        ]);
        $this->like = Like::factory()->create([
            'user_id' => $this->user->id,
            'post_id' =>$this->post->id,
            'comment_id' =>$this->comment->id,
        ]);
    }
    public function testShowProfile()
    {
        $this->actingAs($this->user)
        ->get('profile/'.$this->user->id)
        ->assertStatus(200)
        ->assertSee($this->user->email);
    }
    public function testShowForMissingUser()//dang loi fix lai
    {
        $this->actingAs($this->user)
         ->get("profile/0")
         ->assertRedirect('home');
    }
    public function testUserIsOwner()
    {
        $author = User::factory()->create([
            'id' => 222
        ]);
        $this->actingAs($author)->get('edit-profile/'.$author->id)->assertStatus(200);
        $this->actingAs($this->user)->get('/edit-profile/'.$author->id)->assertRedirect('home');
    }

    public function testUpdateProfileSuccessfully()
    {
        $this->actingAs($this->user);
        $this->user->email = "email@gmail.com";
        $response = $this->post('update-profile/'.$this->user->id, $this->user->toArray());
        $this->assertDatabaseHas('users', ['email' => 'email@gmail.com']);
    }
    public function testHasDatabase()
    {
        $this->assertDatabaseHas('users', [
            'id'=>$this->user->id,
            'name'=>$this->user->name,
            'email' => $this->user->email,
        ]);
        $this->assertDatabaseCount('users', 1);
    }

    public function testUserHasmanyPost()
    {
        $user = User::factory()
            ->has(Post::factory()->count(3))
            ->create();
        $this->assertDatabaseCount('posts', 4);
        $this->assertEquals(1, $this->user->posts->count());
    }
    public function testUserHasmanyComment()
    {
        $user = User::factory()
            ->has(Comment::factory()->count(3))
            ->create();
        $this->assertDatabaseCount('comments', 4);
        $this->assertEquals(1, $this->user->comments->count());
    }
    public function testUserHasmanyReply()
    {
        $user = User::factory()
            ->has(Reply::factory()->count(3))
            ->create();
        $this->assertDatabaseCount('replies', 4);
        $this->assertEquals(1, $this->user->replies->count());
    }
    public function testUserHasmanyLike()
    {
        $user = User::factory()
            ->has(Like::factory()->count(3))
            ->create();
        $this->assertDatabaseCount('likes', 4);
        $this->assertEquals(1, $this->user->likes->count());
    }
}

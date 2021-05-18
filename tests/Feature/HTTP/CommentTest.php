<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Reply;
use App\Models\Like;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CommentTest extends TestCase
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
        $this->reply = Reply::factory()->create([
            'user_id' => $this->user->id,
            'comment_id' =>$this->comment->id,
        ]);
        $this->like = Like::factory()->create([
            'user_id' => $this->user->id,
            'post_id' => $this->post->id,
            'comment_id' => $this->comment->id,
        ]);
    }
    //test request
    public function testAddComment()
    {
        // $user1 = User::factory()->create();
        $response = $this->actingAs($this->user)->get('add-comment');
        $response->assertStatus(200);
    }
    public function testCreatComment()//done
    {
        $data = [
            'content' => "update-post",
        ];
        $user1 = User::factory()->create();
        $response = $this->actingAs($user1)->post('save-comment/'.$this->post->id, $data);
        $this->assertDatabaseHas('comments', $data);
        // $response->assertStatus(200);
    }
    public function testUserDeleteComment()//done
    {
        $this->actingAs($this->user);
        $this->get('/delete-comment/'.$this->post->id.'/'.$this->comment->id);
        $this->assertDatabaseMissing('comments', ['id'=> $this->comment->id]);
    }
    public function testDestroyCommentForMissingUser()//done
    {
        $this->actingAs($this->user);
        $this->get('/delete-comment/0/0')
            ->assertStatus(404);
    }
    public function testUserIsOwnerOfComment()//done
    {
        $author = User::factory()->create([
            'id' => 222
        ]);
        $comment = Comment::factory()
                ->for($author)
                ->create();
        $this->actingAs($author)->get('/edit-comment/'.$this->post->id.'/'.$comment->id)->assertStatus(200);
        $this->actingAs($this->user)->get('/edit-comment/'.$this->post->id.'/'.$comment->id)->assertStatus(403);
    }

    public function testUpdateCommentSuccessfully()//done
    {
        $this->actingAs($this->user);
        $this->comment->content = "update-comment";
        $this->post('update-comment/'.$this->post->id.'/'.$this->comment->id, $this->comment->toArray());
        $this->assertDatabaseHas('comments', ['id'=> $this->comment->id, 'content' => "update-comment"]);
    }
    //like and dislike
    public function testCreatLike()//done
    {
        $data = [
            'user_id' => 1,
            'post_id' => 1,
            'comment_id' => 1,
        ];
        // $user1 = User::factory()->create();
        $response = $this->actingAs($this->user)->get('like/1/1/1');
        $this->assertDatabaseHas('likes', $data);
        // $response->assertStatus(200);
    }
    public function testUserDeleteLike()//done
    {
        $this->actingAs($this->user);
        $this->get('/dislike/'.$this->user->id.'/'.$this->post->id.'/'.$this->comment->id.'/'.$this->like->id);
        $this->assertDatabaseMissing('likes', ['id'=> $this->like->id]);
    }
    //test model
    public function testCommentBelongstoUser()
    {
        $this->actingAs($this->user);
        $this->assertInstanceOf(User::class, $this->comment->user);
        $this->assertEquals(1, $this->comment->user->count());
    }
    public function testCommentBelongstoPost()
    {
        $this->actingAs($this->user);
        $this->assertInstanceOf(Post::class, $this->comment->post);
        $this->assertEquals(1, $this->comment->post->count());
    }
    public function testCommnetHasmanyReply()
    {
        $comment = Comment::factory()
            ->has(Reply::factory()->count(3))
            ->create();
        $this->assertDatabaseCount('replies', 4);
        $this->assertTrue($this->comment->replies->contains($this->reply));
        $this->assertEquals(1, $this->comment->replies->count());
    }
    public function testCommnetHasmanyLike()
    {
        $comment = Comment::factory()
            ->has(Like::factory()->count(3))
            ->create();
        $this->assertDatabaseCount('likes', 4);
        $this->assertTrue($this->comment->likes->contains($this->like));
        $this->assertEquals(1, $this->comment->likes->count());
    }
}

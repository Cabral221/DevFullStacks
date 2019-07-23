<?php

namespace Tests\Unit;

use App\Comment;
use Tests\TestCase;
use App\Models\Post;
use Illuminate\Support\Facades\Artisan;
// use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\Request;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentApiTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate');
    }
    
    public function testGetComment()
    {
        $post = factory(Post::class)->create(['admin_id'=>1]);
        $comment = factory(Comment::class)->create(['commentable_type'=> 'Post','commentable_id'=>1]);
        $comment2 = factory(Comment::class)->create(['commentable_type'=> 'Post','commentable_id'=>1]);
        $comment3 = factory(Comment::class)->create(['commentable_type'=> 'Post','commentable_id'=>1,'reply'=>$comment2->id]);
        $response = $this->call('GET', '/comments',['type'=>'Post','id'=>$post->id]);
        $comments = json_decode($response->getContent());
        $this->assertEquals(200,$response->getStatusCode(),$response->getContent());
        $this->assertEquals(2,count($comments));
        $this->assertSame(0,$comments[0]->reply);
        $this->assertSame($comment2->id,$comments[0]->id);
        $this->assertSame(1, count($comments[0]->replies));
        $this->assertSame($comment->id,$comments[1]->id);
    }

    public function testFieldForJson()
    {
        $post = factory(Post::class)->create(['admin_id'=>1]);
        $comment = factory(Comment::class)->create(['commentable_type'=> 'Post','commentable_id'=>$post->id]);
        $response = $this->call('GET', '/comments',['type'=>'Post','id'=>$post->id]);
        $comments = json_decode($response->getContent());

        $this->assertObjectNotHasAttribute('email',$comments[0]);
        $this->assertObjectNotHasAttribute('ip',$comments[0]);
        $this->assertObjectHasAttribute('email_md5',$comments[0]);
        $this->assertObjectHasAttribute('ip_md5',$comments[0]);
        $this->assertEquals(md5($comment->ip),$comments[0]->ip_md5);
    }

    public function testCommentPost()
    {
        $post = factory(Post::class)->create(['admin_id'=>1]);
        $comment = factory(Comment::class)->make(['commentable_type'=> 'Post','commentable_id'=>$post->id]);
        $response = $this->call('POST','/comments',$comment->getAttributes());
        $response_comments = json_decode($response->getContent());
        $this->assertEquals(200,$response->getStatusCode());
        $this->assertEquals(1, Comment::count());

        $this->assertEquals(md5(Request::ip()), $response_comments->ip_md5);
    }

    public function testPostCommentOnFakeContent()
    {
        $comment = factory(Comment::class)->make(['commentable_type'=> 'Post','commentable_id'=>100]);
        $response = $this->call('POST','/comments',$comment->getAttributes());

        $this->assertEquals(422,$response->getStatusCode());
        $this->assertEquals(0,Comment::count());

    }

    public function testCommentPostOnFakeEmail()
    {
        $post = factory(Post::class)->create(['admin_id'=>1]);
        $comment = factory(Comment::class)->make(['commentable_type'=> 'Post','commentable_id'=>$post->id,'email'=>'fake@']);
        $response = $this->call('POST','/comments',$comment->getAttributes());
        $json = json_decode($response->getContent());
        $this->assertEquals(422,$response->getStatusCode());
        $this->assertEquals(0, Comment::count());

        $this->assertObjectHasAttribute('email', $json);
    }


    public function testPostCommentOnFakeReply()
    {
        $post = factory(Post::class)->create(['admin_id'=>1]);
        $comment = factory(Comment::class)->make(['commentable_type'=> 'Post','commentable_id'=>$post->id,'reply'=>3]);
        $response = $this->call('POST','/comments',$comment->getAttributes());
        $json = json_decode($response->getContent());
        $this->assertEquals(422,$response->getStatusCode());
        $this->assertEquals(0, Comment::count());

        $this->assertObjectHasAttribute('reply', $json);
    }

    public function testPostReplyOnReply()
    {
        $post = factory(Post::class)->create(['admin_id'=>1]);
        $comment = factory(Comment::class)->create(['commentable_type'=> 'Post','commentable_id'=>$post->id]);
        $reply = factory(Comment::class)->create(['commentable_type'=> 'Post','commentable_id'=>$post->id,'reply'=>$comment->id]);
        $reply2 = factory(Comment::class)->make(['commentable_type'=> 'Post','commentable_id'=>$post->id,'reply'=>$reply->id]);
        $response = $this->call('POST','/comments',$reply2->getAttributes());
        $json = json_decode($response->getContent());
        $this->assertEquals(422,$response->getStatusCode());
        $this->assertEquals(2, Comment::count());

        $this->assertObjectHasAttribute('reply', $json);
    }


    public function testDeleteComment()
    {
        $post = factory(Post::class)->create(['admin_id'=>1]);
        $comment = factory(Comment::class)->create(['commentable_type'=> 'Post','commentable_id'=>$post->id,'ip'=>Request::ip()]);
        
        $json = $this->call('DELETE','/comments/'.$comment->id);
        $this->assertEquals(200,$json-> getStatusCode());
        $this->assertEquals(0, Comment::count());
    }

    public function testDeleteCommentwithoutGoodIp()
    {
        $post = factory(Post::class)->create(['admin_id'=>1]);
        $comment = factory(Comment::class)->create(['commentable_type'=> 'Post','commentable_id'=>$post->id]);
        
        $json = $this->call('DELETE','/comments/'.$comment->id);
        $this->assertEquals(403,$json->getStatusCode());
        $this->assertEquals(1, Comment::count());
    }
    

    public function testDeleteCommentOnCascade()
    {
        $post = factory(Post::class)->create(['admin_id'=>1]);
        $ip = Request::ip();
        $comment = factory(Comment::class)->create(['commentable_type'=> 'Post','commentable_id'=>$post->id,'ip'=>$ip]);
        $reply = factory(Comment::class)->create(['commentable_type'=> 'Post','commentable_id'=>$post->id,'reply'=>$comment->id]);
        
        $json = $this->call('DELETE','/comments/'.$comment->id);
        $this->assertEquals(200,$json->getStatusCode());
        $this->assertEquals(0, Comment::count());
    }
    
}

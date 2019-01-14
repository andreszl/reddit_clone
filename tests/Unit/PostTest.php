<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransations;

class PostTest extends TestCase
{
     use DatabaseMigrations; 
        
    /** @test */

    public function post_determines_its_author()
    {
    	$user = factory(\App\User::class)->create();

    	$post = factory(\App\Post::class)->create([

    		'user_id' => $user->id
    	]);

        $postByAnotherAuthor = factory(\App\Post::class)->create();

        $postByAnotherAuthor = $postByAnotherAuthor->wasCreatedBy($user);        
      

    	$postByAuthor = $post->wasCreatedBy($user);

        $this->assertTrue($postByAuthor);

        $this->assertFalse($postByAnotherAuthor);


    }

        /** @test */

    public function post_determines_its_author_if_null_return_false()
    {

        $post = factory(\App\Post::class)->create();

        $postByAuthor = $post->wasCreatedBy(null);

        $this->assertFalse($postByAuthor);
        


    }
}

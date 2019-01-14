<?php

namespace Tests\Feature;

use Tests\TestCase;

use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Foundation\Testing\DatabaseMigrations;

use Illuminate\Foundation\Testing\WithoutMiddleware;

use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostsControllerTest extends TestCase
{

	use DatabaseMigrations;

   	

   	/** @test */

    public function a_guest_can_see_all_the_posts()
    {
    

    	$posts = factory(\App\Post::class, 10)->create();

        $response = $this->get(route('posts_path'));

        $response->assertStatus(200);

        foreach ($posts as $post )
         {
        	
         	$response->assertSee($post->title);

        }
        
    }



    /** @test */

    public function it_sees_posts_author()
    {
    

        $posts = factory(\App\Post::class, 10)->create();

        $response = $this->get(route('posts_path'));

        $response->assertStatus(200);

        foreach ($posts as $post )
         {
            
            $response->assertSee($post->title);
            $response->assertSee(
                e($post->user->name)
            );
        }
        
    }


    /** @test */


    public function a_guest_cannot_see_the_creation_form()
    {
        $response = $this->get(route('create_post_path'));

        $response->assertRedirect('/login');

    }


    
     /** @test */

    public function a_guest_cannot_create_posts()
    {

        //Act

        $response = $this->post(route('store_post_path'));


        //Assert

        $response->assertRedirect('/login');
    }



    /** @test */

    public function a_registered_user_can_create_posts()
    {

        //Arrange
            
            $user = factory(\App\User::class)->create();
            
            $this->userSignId($user);
            
        //Act
        
            $response = $this->post(route('store_post_path'),[

                'title' => 'new post',
                'description' => 'descriptions of new post',
                'url' => 'http://www.urlofnewpost.com'

            ]);
                    


        //Assert


            $post = \App\Post::first(); 

            // $this->assertSame(\App\Post::count(), 1);

            $this->assertSame($user->id, $post->user->id);

    }



            
    /** @test */



    public function author_can_edit_post()
    {

        //Arrange

        $user = factory(\App\User::class)->create();

        $post = factory(\App\Post::class)->create([

            'user_id' => $user->id
        ]);

        $this->userSignId($user); 


        //Act
            
            $response = $this->put(route('update_post_path' ,['post' => $post->id]), [


                'title' => 'edited',
                'description' => 'edited',
                'url' => 'http://www.edited.com'

            ]); 



        //Assert

            $post = \App\Post::first();
            
            $this->assertSame($post->title, 'edited');
            
            $this->assertSame($post->description, 'edited');

            $this->assertSame($post->url, 'http://www.edited.com');
    }


    /** @test */



    public function if_not_author_cannot_edit_post()
    {

        //Arrange

        $user = factory(\App\User::class)->create();

        $post = factory(\App\Post::class)->create();

        $this->userSignId($user); 


        //Act
            
            $response = $this->put(route('update_post_path' ,['post' => $post->id]), [
                'title' => 'editado',
                'description' => 'editado',
                'url' => 'http://www.editado.com'
            ]); 



        //Assert

            $post = \App\Post::first();
            
            $this->assertNotSame($post->title, 'editado');
            
            $this->assertNotSame($post->description, 'editado');

            $this->assertNotSame($post->url, 'http://www.editado.com');
    }



    /** @test */



    public function author_can_delete_post()
    {

        //Arrange

            $user = factory(\App\User::class)->create();

            $post = factory(\App\Post::class)->create();
    
            $this->userSignId($user); 


        //Act

        $response = $this->delete(route('delete_post_path', ['post' => $post->id]));

        $response = $this->get(route('posts_path'));

        //Assert

        $response->assertSee($post->title);

        $post = $post->fresh();

        $this->assertNotNull($post);

    }       


/** @test */



    public function if_not_author_cannot_delete_post()
    {

        //Arrange

            $user = factory(\App\User::class)->create();

            $post = factory(\App\Post::class)->create();
    
            $this->userSignId($user); 


        //Act

        $response = $this->delete(route('delete_post_path', ['post' => $post->id]));

        $response = $this->get(route('posts_path'));

        //Assert

        $response->assertsee($post->title);

        $post = $post->fresh();

        $this->assertNotNull($post);

    }       



    /** @test */

    public function a_registered_user_can_see_all_the_posts()
    {
    
    	$user = factory(\App\User::class)->create();

    	$this->userSignId($user);

    	$posts = factory(\App\Post::class, 10)->create();

        $response = $this->get(route('posts_path'));

        $response->assertStatus(200);

        foreach ($posts as $post )
         {
        	
         	$response->assertSee($post->title);

        }
        
    }

    /** @test */
    
    public function a_admin_users_can_see_all_posts()
    {
        $user = factory(\App\User::class)->create([
            'role_id' => 2
        ]);

        $this->userSignId($user);

        $posts = factory(\App\Post::class, 10)->create();

        $response = $this->get(route('posts_path'));

        $response->assertStatus(200);

        foreach ($posts as $post)
        {
            $response->assertSee($post->title);
        }
    }
    
    /** @test */

    public function a_admin_users_can_edit_all_posts()
    {
        $user = factory(\App\User::class)->create([
            'role_id' => 2
        ]);

        $post = factory(\App\Post::class)->create();

        $this->userSignId($user);

        $response = $this->put(route('update_post_path' ,['post' => $post->id]), [
            'title' => 'edited',
            'description' => 'edited',
            'url' => 'http://www.edited.com'

        ]); 


        $post = \App\Post::first();
            
        $this->assertSame($post->title, 'edited');
        
        $this->assertSame($post->description, 'edited');

        $this->assertSame($post->url, 'http://www.edited.com');

      

        
    }
}

<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Post;

class ExampleTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        //Given i have two records in the database that are posts
        //and each one is posted a month apart
        $first = factory(Post::class)->create();
        $second = factory(Post::class)->create([
            'created_at'=>\Carbon\Carbon::now()->subMonth()
        ]);

        //when i fetch the archives
        $posts= Post::archives();
        
        //then the response sould be in the proper format
        $this->assertEquals([
            [
                "year" => $first->created_at->format('Y'),
                "month" => $first->created_at->format('F'),
                "published" => 1

            ],
            [
                "year" => $second->created_at->format('Y'),
                "month" => $second->created_at->format('F'),
                "published" => 1

            ],
        ],$posts);
    }
}

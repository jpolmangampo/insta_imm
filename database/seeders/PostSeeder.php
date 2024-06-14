<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;

class PostSeeder extends Seeder
{
    private $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            [
                'description'   => 'This is an image of a car',
                'image'         => 'data:image/car',
                'user_id'       => '1',
                'created_at'    => NOW(),
                'updated_at'    => NOW()
            ],
            [
                'description'   => 'This is an image of a tree',
                'image'         => 'data:image/tree',
                'user_id'       => '1',
                'created_at'    => NOW(),
                'updated_at'    => NOW()
            ],
            [
                'description'   => 'This is an image of a bird',
                'image'         => 'data:image/bird',
                'user_id'       => '1',
                'created_at'    => NOW(),
                'updated_at'    => NOW()
            ],
            [
                'description'   => 'This is an image of people',
                'image'         => 'data:image/people',
                'user_id'       => '1',
                'created_at'    => NOW(),
                'updated_at'    => NOW()
            ],
            [
                'description'   => 'This is an image of outer space',
                'image'         => 'data:image/space',
                'user_id'       => '1',
                'created_at'    => NOW(),
                'updated_at'    => NOW()
            ],
        ];

        $this->post->insert($posts);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Article::create([
            "slug" => "how to train your dragon",
            "title" => "How to train your dragon",
            "description" => "Ever wonder how?",
            "body" => "It takes a Jacobian",
            "tagList" => ["dragons", "training"],
            "author" => [
                "username" => "jake",
                "bio" => "I work at statefarm",
                "image" => "https://i.stack.imgur.com/xHWG8.jpg",
                "following" => false,
            ],
        ]);
    }
}

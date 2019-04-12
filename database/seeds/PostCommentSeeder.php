<?php

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Comment;

class PostCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $content = 'この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ量、字間、行間等を確認にするために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。';

        for($i = 1; $i <=20; $i++){
            $post = new Post;
            $post->title = "$i 番目の投稿";
            $post->author_id = 1;
            $post->read_more = substr($content, 0, 120);
            $post->content = $content;
            $post->save();

            $maxComments = mt_rand(3, 15);
                for ($j=0; $j <= $maxComments; $j++) {
                    $comment = new Comment;
                    $comment->commenter = '名無し';
                    $comment->comment = substr($content, 0, 120);
                    $comment->email = 'xyz@gmail.com';
                    $comment->approved = 1;
                    $post->comments()->save($comment);
                    $post->increment('comment_count');
                }
        }
    }
}

<?php


namespace app\http;


use app\models\Post;

class PostController extends Controller
{
    public function all() {
        $posts = Post::find();

        return $this->render('post/all', compact('posts'));
    }
}
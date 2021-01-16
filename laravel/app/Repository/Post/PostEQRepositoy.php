<?php

namespace App\Repository\Post;

use Auth;
use App\User;
use App\Post;

class PostEQRepositoy implements PostRepositoyInterface
{
  public function getAllPost()
  {
    return $posts = Post::with(['user'])->get();
  }
  public function storePost($post_data)
  {

  }
}

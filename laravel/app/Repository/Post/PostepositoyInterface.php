<?php

namespace App\Repository\Post;

interface PostRepositoyInterface {
  //postを全件取得するメソッド
  public function getAllPost();
  public function storePost($post_data);
}

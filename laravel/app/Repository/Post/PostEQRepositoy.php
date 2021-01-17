<?php

namespace App\Repository\Post;

use Auth;
use App\User;
use App\Post AS PostModel;
use App\Services\PostDataAccess;
use App\Entities\Post;
use App\Entities\PostList;

class PostEQRepositoy implements PostDataAccess
{
    protected $post_model;
    protected $post_list;

    public function __construct(PostModel $post_model, PostList $post_list)
    {
      $this->post_model = $post_model;
      $this->post_list = $post_list;
    }

    public function getList()
    {
        $posts = PostModel::with(['user'])->orderBy('created_at', 'desc')->get();

        //取得したデータをBook entityに流し込む
        foreach($posts as $post) {
            $this->post_list->add(new Post(
                $post->id,
                $post->title,
                $post->article,
                // $post->user_id,
                // $post->users->name
            ));
        }

        return $this->post_list;
    }
  // public function storePost($post_data)
  // {

  // }
}

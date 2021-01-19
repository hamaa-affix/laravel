<?php
//厳格な型キャストができる
declare(strict_types=1);

namespace App\Entities;

//最小単位である投稿を表現する投稿クラス
class Post
{
    protected $post_id;
    protected $title;
    protected $article;
    // protected $user_id;
    // protected $user_name;

    public function __construct(
        int $post_id,
        string $title,
        string $article
    )
    {
        $this->post_id = $post_id;
        $this->title = $title;
        $this->article = $article;
        // $this->user_id = $user_id;
        // $this->user_name = $user_name;
    }

    public function getId(): int
    {
        return $this->post_id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getArticle(): string
    {
        return $this->article;
    }

    // public function getUserId(): int
    // {
    //     return $this->user_id;
    // }

    // public function getUserName(): string
    // {
    //     return $this->user_name;
    // }
}

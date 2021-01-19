<?php

namespace App\Services;

use App\Services\PostDataAccess;

class PostService
{
    protected $post_data_access;

    public function __construct(PostDataAccess $post_data_access)
    {
        $this->post_data_access = $post_data_access;
    }

    public function getList()
    {
        return $this->post_data_access->getList();
    }
}

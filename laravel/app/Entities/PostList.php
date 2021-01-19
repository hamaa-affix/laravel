<?php

declare(strict_types=1);

namespace App\Entities;

use ArrayObject;
use IteratorAggregate;

class PostList implements \IteratorAggregate
{
    private $post_list;

    public function __construct()
    {
        $this->post_list = new \ArrayObject();
    }

    public function add(Post $post)
    {
        $this->post_list[] = $post;
    }

    public function getIterator(): \ArrayIterator
    {
        return $this->post_list->getIterator();
    }
}

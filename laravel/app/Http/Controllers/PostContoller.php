<?php

namespace App\Http\Controllers;
// use App\User;
// use App\Post;
use Illuminate\Http\Request;
use App\Services\PostService;

class PostContoller extends Controller
{
    private $post_service;

    public function __construct(PostService $post_service)
    {
        $this->post_service = $post_service;
    }

    public function index()
    {
        $post_list = $this->post_service->getlist();
        dd($post_list);
    }

    public function create() {
        return view('posts.create');
    }

    public function show() {

    }

    public function edit() {

    }

    public function destory() {

    }
}

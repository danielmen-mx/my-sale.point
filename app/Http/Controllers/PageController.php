<?php

namespace App\Http\Controllers;

use App\Models\Post;
// use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class PageController extends Controller
{
    public function posts( )
    {

        Paginator::useBootstrap();

        return view('posts',[
            'posts' => Post::with('user')->latest()->paginate(5),
        ]);
    }

    public function post(Post $post)
    {
        return view('post', ['post' => $post]);
    }

    public function sale_point()
    {
        return view('sale_point.index');
    }

    public function sale()
    {
        return view('sales');
    }
}

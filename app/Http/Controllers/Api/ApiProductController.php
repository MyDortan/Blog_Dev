<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class ApiProductController extends Controller
{
    public function randomProduct()
    {
        return Post::inRandomOrder()->get();
    }

    public function orderById()
    {
        return Post::orderBy('id','desc')->take(15)->get();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class ApiNewProductController extends Controller
{
    public function sortApi()
    {
        return Post::orderBy('id','desc')->get();
    }
}

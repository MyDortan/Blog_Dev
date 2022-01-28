<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class ApiNewProductController extends Controller
{
    public function OrderDesc()
    {
        return Post::orderBy('id','desc')->get();
    }
}

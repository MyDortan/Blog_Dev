<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class ApiLikeController extends Controller
{
    public function plusLikeComment($id)
    {
        $like = Comment::find($id)->like;
        $plusLike = $like + 1;
        $updateLike = Comment::find($id);
        $updateLike->like = $plusLike;
        $updateLike->save();
        return response()->json([
            'msg' => 'ثبت شد .'
        ]);
    }

    public function minusLikeComment($id)
    {
        $like = Comment::find($id)->like;
        if ($like >= 0){
            $minusLike = $like - 1;
            $updateLike = Comment::find($id);
            $updateLike->like = $minusLike;
            $updateLike->save();
            return response()->json([
                'msg' => 'ثبت شد .'
            ]);
        }else{
            return response()->json([
               'msg' => 'تعداد لایک نمیتواند منفی شود !'
            ]);
        }

    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Post::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $v = verta();
        Post::create([
           'title' => $request->title,
           'description' => $request->description,
           'categories' => $request->categories,
           'image' => $request->image,
            'like' => $request->like,
            'date' => $v->formatJalaliDate(), // 23:26:35,
        ]);
        return response()->json([
            'massage' => 'successful inserted',
        ]);
        return response()->json([
            'massage' => 'failed to inserted',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Post::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
//        $post->update($request->all());
        $post->post_id = $request->post_id;
        $post->text = $request->text;
        $post->name = $request->name;
        $post->email = $request->email;
        $post->ratio = $request->ratio;
        $post->save();
            return response([
                'post_information' => $post,
                'message' => 'success',
                'status' => 'ok'
            ]);
        }
//        else {
//            return response([
//                'message' => '???????????? ?????? ???? ?????? ?????????? ???? ???????? ???????????? ???????? ????????',
//                'status' => 'error'
//            ]);
//        }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::findOrFail($id)->delete();

        return response()->json([
           'msg' => 'successful deleted',
        ]);
        return response()->json([
            'massage' => 'failed to deleted',
        ]);
    }
}




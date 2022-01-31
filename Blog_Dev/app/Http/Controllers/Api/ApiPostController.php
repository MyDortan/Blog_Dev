<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
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

        $this->validate($request,[
            'file' => 'required|mimes:jpg,jpeg,png,gif|max:10240'
        ]);
        $pic_name = time().$request->file('image')->getClientOriginalName();
        $path = 'assets/image/';
        $request->image->move($path,$pic_name);
        Post::create([
           'title' => $request->title,
           'description' => $request->description,
           'categories' => $request->categories,
           'image_url' => $pic_name,
            'like' => $request->like,
        ]);
        response()->json([
            'massage' => 'successful inserted',
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
        if ($request->image == ""){
            $post = Post::findOrFail($id);
            $post->title = $request->title;
            $post->description = $request->description;
            $post->categories = $request->categories;
            $post->like = $request->like;
            $post->save();
            response()->json([
                'massage' => 'successful update',
            ]);
        }else{

            $old_img = Post::findOrFail($id)->image;
            unlink($old_img);

            $this->validate($request,[
                'file' => 'required|mimes:jpg,jpeg,png,gif|max:10240'
            ]);
            $pic_name = time().$request->file('image')->getClientOriginalName();
            $path = 'assets/image/';
            $request->image->move($path,$pic_name);


            $post = Post::findOrFail($id);
            $post->title = $request->title;
            $post->description = $request->description;
            $post->categories = $request->categories;
            $post->like = $request->like;
            $post->image = $pic_name;
            $post->save();

            response()->json([
                'massage' => 'successful update with image',
            ]);
        }



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::findOrFail($id)->delete();
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentApiRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

class ApiCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentApiRequest $request )
    {
        $v = verta(); // 1395-12-12 00:18:04
        $create = Comment::create([
            'post_id' => $request->post_id,
            'text' => $request->text,
            'name' => $request->name,
            'email' => $request->email,
            'ratio' => $request->ratio,
            'date' => $v->formatJalaliDate(),
        ]);
        if ($create) {
            return response()->json([
                'msg' => 'کامنت شما با موفقیت ذخیره شد .'
            ]);
        }else{
            return response()->json([
                'msg' => 'لطفا تمامی اطلاعات فرم را پر کنید .'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Comment::Where('post_id',$id)->count();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        dd($request->all());
        $update = Comment::find($id);
        $update->text = $request->text;
        $update->name = $request->name;
        $update->email = $request->email;
        $update->ratio = $request->ratio;
        if ($update->save()){
            return response([
               'msg' => 'کامنت شما با موفقیت بروز رسانی شد .' ,
            ]);
        }else{
            return response([
                'msg' => 'لطفا کادر ها رو پر کنید .' ,
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
        $delete = Comment::findOrFail($id)->delete();
        if ($delete){
            return response([
                'msg' => 'کامنت شما با موفقیت  حذف شد .' ,
            ]);
        }else{
            return response([
                'msg' => 'خطا در حذف کامنت لطفا دوباره تلاش کنید .' ,
            ]);
        }

    }
}

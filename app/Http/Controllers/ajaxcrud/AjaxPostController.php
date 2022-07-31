<?php

namespace App\Http\Controllers\ajaxcrud;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use Redirect,Response;


class AjaxPostController extends Controller
{
    public function index()
    {
        //
        $data['posts'] = Post::orderBy('id','desc')->paginate(8);
   
        return view('user.user',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $postID = $request->post_id;
        $post   =   Post::updateOrCreate(['id' => $postID],
                    ['userName' => $request->userName, 'userEmail' => $request->userEmail, 'userPhone' => $request->userPhone,
                    'presentDivision' => $request->presentDivision,'presentDistrict' => $request->presentDistrict,'presentThana' => $request->presentThana,
                    'permanentDivision' => $request->permanentDivision,'permanentDistrict' => $request->presentDistrict,'permanentThana' => $request->permanentThana,
                    ]);


        return Response::json($post);
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
        $where = array('id' => $id);
        $post  = Post::where($where)->first();
 
        return Response::json($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = Post::where('id',$id)->delete();
   
        return Response::json($post);
    }
}
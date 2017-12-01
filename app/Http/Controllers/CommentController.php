<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function create( Request $request)
    {
        $this->validate($request,[
            'text' => 'required|string|max:255',
        ]);
        //store in database
        $comment = new Comment();
        $comment->user_id = Auth::user()->id;
        $comment->app_id = $request->get('app_id');
        $comment->app_kind = $request->get('app_kind');
        $comment->text = $request->get('text');
        $comment->save();
        return redirect($comment->app_kind .'/'. $comment->app_id);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete(Request $request)
    {
        $id = $request->get('id');
        Comment::where('id', $id)->delete();
        return redirect($request->get('app_kind'). '/' . $request->get('app_id'));
    }
}

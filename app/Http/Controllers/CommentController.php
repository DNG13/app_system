<?php

namespace App\Http\Controllers;

use App\Actions\Comment\CreateAction;
use App\Models\Comment;
use Illuminate\Http\Request;
use Mail;

class CommentController extends Controller
{
    /**
     * @param Request $request
     * @param CreateAction $action
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function create( Request $request, CreateAction $action )
    {
        $this->validate($request,[
            'text' => 'required|string|max:255',
        ]);
        return $action->run($request);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Request $request)
    {
        $id = $request->get('id');
        Comment::where('id', $id)->delete();
        return redirect($request->get('app_kind'). '/' . $request->get('app_id'));
    }
}

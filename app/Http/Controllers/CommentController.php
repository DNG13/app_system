<?php

namespace App\Http\Controllers;

use App\Actions\Comment\CreateAction;
use App\Http\Requests\Comment\CreateRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Abstracts\Controller;

class CommentController extends Controller
{
    /**
     * @param CreateRequest $request
     * @param CreateAction $action
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function create( CreateRequest $request, CreateAction $action )
    {
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

        $kind = $request->get('app_kind');
        $kind = ($kind == 'fair') ? 'expo' : $kind;

        return redirect($kind. '/' . $request->get('app_id') . '#footer');
    }
}

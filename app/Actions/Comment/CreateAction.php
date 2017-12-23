<?php

namespace App\Actions\Comment;

use App\Abstracts\Action;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AppFair;
use App\Models\AppPress;
use App\Models\AppVolunteer;
use App\Models\AppCosplay;
use App\Models\Comment;
use App\User;
use Mail;

class CreateAction extends Action
{

    public function __construct()
    {

    }

    public function run(Request $request)
    {
        $comment = new Comment();
        $comment->user_id = Auth::user()->id;
        $comment->app_id = $request->get('app_id');
        $comment->app_kind = $request->get('app_kind');
        $comment->text = $request->get('text');
        $comment->save();

        if( $comment->app_kind == 'cosplay' ) {
            $app = AppCosplay::where('id',  $comment->app_id)->first();
        } elseif( $comment->app_kind == 'fair' ) {
            $app = AppFair::where('id',  $comment->app_id)->first();
        } elseif( $comment->app_kind == 'press' ) {
            $app = AppPress::where('id',  $comment->app_id)->first();
        } elseif( $comment->app_kind == 'volunteer' ) {
            $app = AppVolunteer::where('id',  $comment->app_id)->first();
        }

        $user = User::find($app->user_id);
        $mail['title'] = $app->title;
        $mail['page'] = '/' . $comment->app_kind. '/'. $comment->app_id;
        $mail['text'] = $comment->text;

        if (Auth::user()->isAdmin()) {
            $mail['nickname'] = $user->profile->nickname;
            $mail['email'] = $user->email;
        } else {
            $mail['nickname'] = 'Admin';
            $mail['email'] = env('ADMIN_MAIL');
        }

        Mail::send('mails.comment',  $mail , function($message) use ($mail) {
            $message->to( $mail['email']);
            $message->subject('Добавлен комментарий к заяке');
        });

        return redirect($comment->app_kind .'/'. $comment->app_id);
    }
}
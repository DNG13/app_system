<?php

namespace App\Actions\Comment;

use App\Abstracts\Action;
use App\Jobs\SendCommentEmailJob;
use App\Models\AppFair;
use App\Models\AppPress;
use App\Models\AppVolunteer;
use App\Models\AppCosplay;
use App\Models\Comment;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            $mail['title'] = $app->title;
        } elseif( $comment->app_kind == 'fair' ) {
            $app = AppFair::where('id',  $comment->app_id)->first();
            $mail['title'] = $app->group_nick;
        } elseif( $comment->app_kind == 'press' ) {
            $app = AppPress::where('id',  $comment->app_id)->first();
            $mail['title'] = $app->media_name;
        } elseif( $comment->app_kind == 'volunteer' ) {
            $app = AppVolunteer::where('id',  $comment->app_id)->first();
            $mail['title'] = $app->nickname;
        }
        $user = User::find($app->user_id);
        $mail['page'] = '/' . $comment->app_kind. '/'. $comment->app_id;
        $mail['text'] = $comment->text;
        if (Auth::user()->isAdmin()) {
            $mail['nickname'] = $user->profile->nickname;
            $mail['email'] = $user->email;
        } else {
            $mailPluses = ['show', 'fair', 'photo', 'volunteers'];
            $appKinds = ['cosplay', 'fair', 'press', 'volunteer'];
            $mailPlus = $mailPluses[array_search($comment->app_kind, $appKinds)];
            $mail['nickname'] = 'Admin';
            $mail['email'] = 'khanifest+' . $mailPlus .'@gmail.com';
        }
        SendCommentEmailJob::dispatch($mail)
            ->delay(now()->addSeconds(2));

        return redirect($comment->app_kind .'/'. $comment->app_id);
    }
}
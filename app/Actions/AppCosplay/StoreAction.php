<?php

namespace App\Actions\AppCosplay;

use App\Models\AppFile;
use App\User;
use App\Abstracts\Action;
use App\Jobs\SendApplicationEmailJob;
use App\Jobs\SendForAdminNewAppEmailJob;
use App\Models\AppCosplay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreAction extends Action
{

    public function __construct()
    {

    }

    public function run(Request $request)
    {
        $cosplays = new AppCosplay();
        $cosplays->type_id = $request->get('type_id');
        $cosplays->title = $request->get('title');
        $cosplays->group_nick = $request->get('group_nick');
        $cosplays->fandom = $request->get('fandom');
        $cosplays->length = $request->get('length');
        $cosplays->city = $request->get('city');
        $cosplays->description = $request->get('description');
        $cosplays->prev_part = $request->get('prev_part');
        $cosplays->props = $request->get('props');
        $cosplays->comment = $request->get('comment');
        $cosplays->user_id = Auth::user()->id;
        $cosplays->status = AppCosplay::APP_STATUS_IN_PROCESSING;

        $members = [];
        foreach($request->input('members') as  $key => $value) {
            $members["member{$key}"] = $value;
        }
        $cosplays->members_count = count($members);
        $cosplays->members = json_encode($members);
        $cosplays->save();

        if ($tempId = $request->get('temp_id')) {
            $files = AppFile::where('temp_id', $tempId)->get();
            foreach ($files as $file) {
                $file->app_id = $cosplays->id;
                $file->temp_id = null;
                $file->save();
            }
        }

        $user = User::find( Auth::user()->id);
        $mail['nickname'] = $user->profile->nickname;
        $mail['title'] = $cosplays->title;
        $mail['email'] = $user->email;
        $mail['page'] = '/cosplay/'. $cosplays->id;
        SendApplicationEmailJob::dispatch($mail)
            ->delay(now()->addSeconds(2));
        $mail['email'] = 'khanifest+show@gmail.com';
        $mail['nickname'] = 'Admin';
        SendForAdminNewAppEmailJob::dispatch($mail)
            ->delay(now()->addSeconds(2));

        return redirect('cosplay')->with('success', "Вашу заявку успішно відправлено.");
    }
}
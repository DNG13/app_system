<?php

namespace App\Http\Controllers;

use App\Actions\File\LoadAction;
use App\Actions\File\ZipAction;
use App\Models\AppFile;
use Illuminate\Http\Request;
use File;

class FileController extends Controller
{
    /**
     * @param Request $request
     * @param LoadAction $action
     * @return \Illuminate\Http\RedirectResponse
     */
    public function upload(Request $request, LoadAction $action)
    {
        $this->validate($request,[
            'file' => 'nullable|file|mimes:jpeg,jpg,png,ogg,mp3,wav,wma,mid,flac,aac,alac,ac3,m4a,aif,iff,m3u,mpa,ra,doc,rtf,pdf,docx,sxw,txt,odt|max:102400',

        ]);
        $file = $request->file('file');

        if($file) {
            $app_kind = $request->get('app_kind');
            $app_id = $request->get('app_id');
            $action->run($file, $app_kind, $app_id);
        }

        return back();
    }

    /**
     * @param Request $request
     * @param ZipAction $action
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function zip(Request $request, ZipAction $action )
    {
        if($request->download == 'zip') {
            $public_dir=public_path('/zip');
            $zipFileName = $action->run($request);
            $filetopath = $public_dir.'/'.$zipFileName;
            // Set Header
            $headers = array(
                'Content-Type' => 'application/octet-stream',
            );

            // Create Download Response
            if(file_exists($filetopath)){
                return response()->download($filetopath,$zipFileName,$headers);
            }
        }

        return redirect($request->get('app_kind'). '/' . $request->get('app_id'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Request $request)
    {
        $id = $request->get('id');
        $file = AppFile::where('id', $id)->first();
        unlink($file->link);

        if ($file->thumbnail_link) {
            unlink($file->thumbnail_link);
        }
        $file->delete();

        return redirect($request->get('app_kind'). '/' . $request->get('app_id'));
    }
}
<?php

namespace App\Http\Controllers;

use App\Actions\File\LoadAction;
use App\Actions\File\ZipAction;
use App\Http\Requests\File\UploadRequest;
use App\Models\AppFile;
use Illuminate\Http\Request;
use App\Abstracts\Controller;
use File;
use Illuminate\Support\Facades\Response;
use Intervention\Image\Exception\NotFoundException;

class FileController extends Controller
{
    /**
     * @param UploadRequest $request
     * @param LoadAction $action
     * @return \Illuminate\Http\RedirectResponse
     */
    public function upload(UploadRequest $request, LoadAction $action)
    {
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
            $public_dir = storage_path('/zip');
            $zipFileName = $action->run($request);
            $filetopath = $public_dir.'/'.$zipFileName;
            // Set Header
            $headers = array(
                'Content-Type' => 'application/octet-stream',
            );

            // Create Download Response
            if(file_exists($filetopath)){
                return response()->download($filetopath, $zipFileName, $headers);
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
        unlink(storage_path($file->link));

        if ($file->thumbnail_link) {
            unlink(storage_path($file->thumbnail_link));
        }
        $file->delete();

        return redirect($request->get('app_kind'). '/' . $request->get('app_id'));
    }

    /**
     * @param $fileId
     * @return mixed
     */

    public function getFile($fileId)
    {
        $file = AppFile::where('id', $fileId)->get()->first();

        if (!$file) {
            throw new NotFoundException();
        }

        $path = storage_path($file->link);

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;
    }

    /**
     * @param $fileId
     * @return mixed
     */
    public function getThumbnail($fileId)
    {
        $file = AppFile::where('id', $fileId)->get()->first();

        if (!$file) {
            throw new NotFoundException();
        }

        $path = storage_path($file->thumbnail_link);

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;
    }
}
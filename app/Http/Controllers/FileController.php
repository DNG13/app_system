<?php

namespace App\Http\Controllers;

use App\Models\AppFile;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use File;
use ZipArchive;

class FileController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function upload(Request $request)
    {
        $this->validate($request,[
            'file' => 'nullable|file|mimes:jpeg,jpg,png,ogg,mp3,wav,wma,mid,flac,aac,alac,ac3,m4a,aif,iff,m3u,mpa,ra,doc,rtf,pdf,docx,sxw,txt,odt|max:102400',

        ]);

        $file = $request->file('file');

        if($file) {
            $fileName = $file->getClientOriginalName();
            $path = 'uploads/file/' . $request->get('app_kind') . '/' . $request->get('app_id');
            $filePath = public_path( $path ).'/' . $fileName;
            $extension = $file->extension();
            $image = ['png', 'jpg', 'jpeg'];
            $audio = ['ogg','mp3','wav', 'wma', 'mid', 'flac', 'aac', 'alac', 'ac3', 'm4a', 'aif', 'iff', 'm3u', 'mpa', 'ra'];
            $document = ['doc', 'rtf', 'pdf', 'docx', 'sxw',  'txt', 'odt'];

            $appFile = new AppFile;
            $appFile->name = $fileName;
            $appFile->app_id = $request->get('app_id');
            $appFile->app_kind = $request->get('app_kind');
            $appFile->link =  $path .'/' . $fileName;

            $file->move(public_path( $path) . '/', $fileName);
            $thumbnailLink = null;

            if(in_array($extension, $image )) {
                $appFile->type = 'image';

                $img = Image::make($filePath);

                if($img->width() <= $img->height()) {
                    $img->resize(null, 70, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                } else {
                    $img->resize( 70, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                }
                $thumbnailLink = 'uploads/thumbnails/' . $request->get('app_kind') . '/' . $request->get('app_id');
                $thumbnailPath = public_path($thumbnailLink);
                if (!file_exists($thumbnailPath)) {
                    mkdir($thumbnailPath, 0700, true);
                }
                $img->save( $thumbnailPath. '/' . $fileName);
                $thumbnailLink = $thumbnailLink .'/'. $fileName;
            } elseif(in_array($extension, $document)) {
                $appFile->type = 'document';
            } elseif(in_array($extension, $audio )) {
                $appFile->type = 'audio';
            } else {
                return back()->with('We have problems Huston');
            }

            $appFile->thumbnail_link = $thumbnailLink;
            $appFile->save();
        }
        return back();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function zip(Request $request)
    {
        if($request->download == 'zip') {
            // Define Dir Folder
            $public_dir=public_path('/zip');
            //remove archive if exist
            if (file_exists($public_dir)) {
                $files = array_diff(scandir($public_dir), array('.','..'));
                foreach ($files as $file) {
                    (is_dir("$public_dir/$file")) ? delFolder("$public_dir/$file") : unlink("$public_dir/$file");
                }
                rmdir($public_dir);
            }
            mkdir($public_dir, 0700, true);

            // Zip File Name
            $zipFileName = $request->app_kind.'_'. $request->app_id . '.zip';
            // Create ZipArchive Obj
            $zip = new ZipArchive;
            if ($zip->open($public_dir . '/' . $zipFileName, ZipArchive::CREATE) === TRUE) {
                // Add Multiple file
                $files = AppFile::where('app_kind', $request->app_kind)->where('app_id', $request->app_id)->get();
                foreach($files as $file) {

                    $zip->addFile($file->link, $file->name);
                }
                $zip->close();
            }
            // Set Header
            $headers = array(
                'Content-Type' => 'application/octet-stream',
            );
            $filetopath=$public_dir.'/'.$zipFileName;
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
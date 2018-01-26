<?php

namespace App\Actions\File;

use App\Abstracts\Action;
use App\Models\AppFile;
use Illuminate\Http\Request;
use File;
use ZipArchive;

class ZipAction extends Action
{

    public function __construct()
    {

    }

    public function run(Request $request)
    {
        $public_dir = storage_path('zip');
        //remove archive if exist
        if (file_exists($public_dir)) {
            $files = array_diff(scandir($public_dir), array('.','..'));
            foreach ($files as $file) {
                (is_dir("$public_dir/$file")) ? delFolder("$public_dir/$file") : unlink("$public_dir/$file");
            }
            rmdir($public_dir);
        }

        mkdir($public_dir, 0777, true);
        $zipFileName = $request->app_kind.'_'. $request->app_id . '.zip';
        $zip = new ZipArchive;
        if ($zip->open($public_dir . '/' . $zipFileName, ZipArchive::CREATE) === TRUE) {
            $files = AppFile::where('app_kind', $request->app_kind)->where('app_id', $request->app_id)->get();
            foreach($files as $file) {
                $zip->addFile( storage_path($file->link), $file->name);
            }
            $zip->close();
        }
        return $zipFileName;
    }
}
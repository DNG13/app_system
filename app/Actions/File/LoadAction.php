<?php

namespace App\Actions\File;

use App\Abstracts\Action;
use App\Models\AppFile;
use File;
use Intervention\Image\Facades\Image;

class LoadAction extends Action
{

    public function __construct()
    {

    }

    public function run($file, $app_kind, $app_id)
    {
        $fileName =  iconv("UTF-8", "ISO-8859-1//TRANSLIT", stripslashes($file->getClientOriginalName()));
        $path = 'uploads/file/' . $app_kind . '/' . $app_id;
        $filePath = public_path( $path ).'/' . $fileName;
        $extension = $file->extension();
        $image = ['png', 'jpg', 'jpeg', 'gif', 'tiff', 'pjpeg'];
        $audio = ['ogg', 'mp3', 'wav', 'wma', 'mid', 'flac', 'aac', 'alac', 'ac3', 'm4a', 'aif', 'iff', 'm3u', 'mpa', 'ra', 'mpeg', 'mp4'];
        $document = ['doc', 'rtf', 'pdf', 'docx', 'sxw', 'txt', 'odt'];

        $appFile = new AppFile;
        $appFile->name = $fileName;
        $appFile->app_id = $app_id;
        $appFile->app_kind = $app_kind;
        $appFile->link = $path . '/' . $fileName;

        $file->move(public_path($path) . '/', $fileName);
        $thumbnailLink = null;

        if (in_array($extension, $image)) {
            $appFile->type = 'image';

            $img = Image::make($filePath);

            if ($img->width() <= $img->height()) {
                $img->resize(null, 70, function ($constraint) {
                    $constraint->aspectRatio();
                });
            } else {
                $img->resize(70, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }

            $thumbnailLink = 'uploads/thumbnails/' . $app_kind . '/' . $app_id;
            $thumbnailPath = public_path($thumbnailLink);

            if (!file_exists($thumbnailPath)) {
                mkdir($thumbnailPath, 0700, true);
            }
            $img->save($thumbnailPath . '/' . $fileName);
            $thumbnailLink = $thumbnailLink . '/' . $fileName;

        } elseif (in_array($extension, $document)) {
            $appFile->type = 'document';
        } elseif (in_array($extension, $audio)) {
            $appFile->type = 'audio';
        } else {
            $appFile->type = 'else';
        }
        $appFile->thumbnail_link = $thumbnailLink;
        $appFile->save();
    }
}
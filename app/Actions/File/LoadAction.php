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
        $fileName =  preg_replace("/[^-._a-z0-9]/i","_", $this->rus2translit($file->getClientOriginalName()));
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

    /**
     * @param $string
     * @return string
     */
    function rus2translit($string): string
    {
        $converter = array(
            'а' => 'a',   'б' => 'b',   'в' => 'v',
            'г' => 'g',   'д' => 'd',   'е' => 'e',
            'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
            'и' => 'i',   'й' => 'y',   'к' => 'k',
            'л' => 'l',   'м' => 'm',   'н' => 'n',
            'о' => 'o',   'п' => 'p',   'р' => 'r',
            'с' => 's',   'т' => 't',   'у' => 'u',
            'ф' => 'f',   'х' => 'h',   'ц' => 'c',
            'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
            'ь' => '',  'ы' => 'y',   'ъ' => '',
            'э' => 'e',   'ю' => 'yu',  'я' => 'ya',

            'А' => 'A',   'Б' => 'B',   'В' => 'V',
            'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
            'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
            'И' => 'I',   'Й' => 'Y',   'К' => 'K',
            'Л' => 'L',   'М' => 'M',   'Н' => 'N',
            'О' => 'O',   'П' => 'P',   'Р' => 'R',
            'С' => 'S',   'Т' => 'T',   'У' => 'U',
            'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
            'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
            'Ь' => '',  'Ы' => 'Y',   'Ъ' => '',
            'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
        );

        return strtr($string, $converter);
    }
}
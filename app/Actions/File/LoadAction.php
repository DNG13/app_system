<?php

namespace App\Actions\File;

use App\Abstracts\Action;
use App\Models\AppFile;
use App\Models\AppFair;
use App\Models\AppPress;
use App\Models\AppVolunteer;
use App\Models\AppCosplay;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;

class LoadAction extends Action
{

    public function __construct()
    {

    }

    public function run(Request $request)
    {
        $file = $request->file('file');

        if(!$file) {
            return false;
        }

        $app_kind = $request->get('app_kind');
        $app_id = $request->get('app_id');
        if (!$app_id) {
            $temp_id = $request->get('temp_id', null);
            if (!$temp_id) {
                return false;
            }
            $user_id = Auth::user()->id;
        }
        $fileName =  preg_replace("/[^-._a-z0-9]/i","_", $this->rus2translit($file->getClientOriginalName()));

        if ($app_id) {
            $path = 'uploads/file/' . $app_kind . '/app_' . $app_id;
        } else {
            $path = 'uploads/file/' . $app_kind . '/user_' . $user_id;
        }

        $filePath = storage_path( $path ).'/' . $fileName;
        $mime = $file->getMimeType();

        //if file with the same name exists
        $extension = $file->extension();
        $info = pathinfo($fileName);
        $i = 1;
        while(file_exists($filePath)) {
            $name = $info['filename'] . '_' . $i++ . '.' . $extension;
            $filePath = storage_path($path) . '/' . $name;
        }
        $fileName = $name ?? $fileName;

        $appFile = new AppFile;
        $appFile->name = $fileName;
        $appFile->app_id = $app_id;
        $appFile->temp_id = $temp_id ?? null;
        $appFile->app_kind = $app_kind;
        $appFile->link = $path . '/' . $fileName;

        $file->move(storage_path($path) . '/', $fileName);
        $thumbnailLink = null;

        if (strpos($mime, 'image')!== false) {
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

            if ($app_id) {
                $thumbnailLink = 'uploads/thumbnails/' . $app_kind . '/app_' . $app_id;
            } else {
                $thumbnailLink = 'uploads/thumbnails/' . $app_kind . '/user_' . $user_id;
            }

            $thumbnailPath = storage_path($thumbnailLink);

            if (!file_exists($thumbnailPath)) {
                mkdir($thumbnailPath, 0700, true);
            }
            $img->save($thumbnailPath . '/' . $fileName);
            $thumbnailLink = $thumbnailLink . '/' . $fileName;

        } elseif ((strpos($mime, 'application')!== false) || (strpos($mime, 'text')!== false)) {
            $appFile->type = 'document';
        } elseif (strpos($mime, 'audio')!== false) {
            $appFile->type = 'audio';
        } elseif (strpos($mime, 'video')!== false) {
            $appFile->type = 'video';
        } else {
            $appFile->type = 'else';
        }
        $appFile->thumbnail_link = $thumbnailLink;
        $appFile->save();

        if ($app_id) {
            if( $app_kind == 'cosplay' ) {
                $app = AppCosplay::where('id',  $app_id)->first();
            } elseif( $app_kind == 'fair' ) {
                $app = AppFair::where('id',  $app_id)->first();
            } elseif( $app_kind == 'press' ) {
                $app = AppPress::where('id',  $app_id)->first();
                $mail['title'] = $app->media_name;
            } elseif( $app_kind == 'volunteer' ) {
                $app = AppVolunteer::where('id',  $app_id)->first();
            }
            $app->updated_at = Carbon::now();
            $app->save();
        }
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
            'ь' => '',    'ы' => 'y',   'ъ' => '',
            'э' => 'e',   'ю' => 'yu',  'я' => 'ya',
            'і' => 'i',   'ї' => 'yi',  'є' => 'ye',
            'ґ' => 'g',

            'А' => 'A',   'Б' => 'B',   'В' => 'V',
            'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
            'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
            'И' => 'I',   'Й' => 'Y',   'К' => 'K',
            'Л' => 'L',   'М' => 'M',   'Н' => 'N',
            'О' => 'O',   'П' => 'P',   'Р' => 'R',
            'С' => 'S',   'Т' => 'T',   'У' => 'U',
            'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
            'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
            'Ь' => '',  '  Ы' => 'Y',   'Ъ' => '',
            'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
            'І' => 'I',   'Ї' => 'Yi',  'Є' => 'Ye',
            'Ґ' => 'G',
        );

        return strtr($string, $converter);
    }
}
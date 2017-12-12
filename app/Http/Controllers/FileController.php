<?php

namespace App\Http\Controllers;

use App\Models\AppFile;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use File;

class FileController extends Controller
{
    public function upload(Request $request)
    {
        $this->validate($request,[
            'file' => 'nullable|file|mimes:jpeg,jpg,png|max:10240',

        ]);

        $file = $request->file('file');

        if($file) {
            $fileName = uniqid(). $file->getClientOriginalName();
            $path = 'uploads/file/' . $request->get('app_kind') . '/' . $request->get('app_id');
            $filePath = public_path( $path ).'/' . $fileName;
            $extension = $file->extension();
            if($extension) {
                $file->move(public_path( $path) . '/', $fileName);

                $img = Image::make($filePath);

                if($img->width() <= $img->height()) {
                    $img->resize(null, 100, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                } else {
                    $img->resize( 100, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                }
                $img->save(public_path( $path) . '/thumbnail_' . $fileName);
            }

            $appFile = new AppFile;
            $appFile->name = $fileName;
            $appFile->app_id = $request->get('app_id');
            $appFile->type = $request->get('app_kind');
            $appFile->link =  $path .'/' . $fileName;;
            $appFile->save();
        }
        return back()->with('ok');
    }

    public function destroy(Request $request)
    {
        $id = $request->get('id');
        $file = AppFile::where('id', $id)->first();
        unlink($file->link);
        unlink('uploads/file/'.$request->get('app_kind').'/'. $request->get('app_id') .'/thumbnail_'.$file->name);
        $file->delete();
        return redirect($request->get('app_kind'). '/' . $request->get('app_id'));
    }

}
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
            $imageFile = $request->file('file');
            $imageName = uniqid(). $imageFile->getClientOriginalName();
            $imagePath = public_path('uploads/file/' . $request->get('app_kind') . '/' . $request->get('app_id') ).'/' . $imageName;
            //$extension = $imageFile->extension();
            $imageFile->move(public_path('uploads/file/'. $request->get('app_kind') . '/' . $request->get('app_id')) .'/', $imageName);

            $img = Image::make($imagePath);
            $img->resize(null, 100, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save(public_path('uploads/file/' . $request->get('app_kind') . '/' . $request->get('app_id') ).'/thumbnail_'.$imageName);

            $image = new AppFile;
            $image->name = $imageName;
            $image->app_id = $request->get('app_id');
            $image->type = $request->get('app_kind');
            $image->link = $imagePath;
            $image->save();

        }
        return back()->with('ok');
    }

}
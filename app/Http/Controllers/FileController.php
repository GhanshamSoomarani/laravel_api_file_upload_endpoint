<?php

namespace App\Http\Controllers;
use App\Models\File;
use Illuminate\Http\Request;

class FileController extends Controller
{

    public function fileUpload(Request $request) {
        $fileObj = new File;

        if($request->hasFile('file')) {
            $filename = $request->file('file')->getClientOriginalName();
            $getfilenamewitoutext = pathinfo($filename, PATHINFO_FILENAME);
            $getfileExtension = $request->file('file')->getClientOriginalExtension();
            $createnewFileName = time().'_'.str_replace(' ','_', $getfilenamewitoutext).'.'.$getfileExtension;
            $img_path = $request->file('file')->storeAs('public/post_img', $createnewFileName);
            $fileObj->file = $createnewFileName;
        }

        if($fileObj->save()) {
            return ['status' => true, 'message' => "file uploded successfully"];
        }
        else {
            return ['status' => false, 'message' => "Error : Image not uploded successfully"];

        }
    }
}


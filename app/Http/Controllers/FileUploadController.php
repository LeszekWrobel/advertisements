<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class FileUploadController extends Controller
{
  
        public function upload() 
        {
            dd();
            return view('upload');
        }
    
        public function store(Request $request)
        {
            $image = $request->file('file');
            $imageName = time() ;
            dd($imageName);
            $image->move(public_path('images'), $imageName) ;
            return response()->json(['success'=>$imageName]);
        }
        
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DropzoneController extends Controller
{
   public function index()
   {
    return view('index');
   }

   public function uploadFile(Request $request)
   {
    $data = array();

    $validator = Validator::make($request->all(), [
        'file'=> 'required|mimes:png,jpeg,jpg|max:2048'
    ]);

    if($validator->fails()){
        $data['success'] = 0;
        $data['error'] = $validator->errors()->first('file'); // error respns
    }else{
        $file = $request->file('file');
        $fileName = time().'_'.$file->getClientOriginalName();

        // file upload location
        $location = 'files';

        // upload file
        $file->move($location,$fileName);

        //response
        $data['success'] = 1;
        $data['message'] = 'Uploaded successfulle';
    }
    return response()->json($data);
   }
}

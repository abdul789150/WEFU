<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    public $success_status = 200;
    public $unauth_error = 401;

    public function update_image(Request $request){
        
        // return response()->json(['error' => $request->all()], $this->unauth_error);

        $validator = Validator::make($request->all() ,[
            'profile_img' => 'required',
            'profile_img.*' => 'mimes:jpg,jpeg,png,bmp,tiff',
        ]);
            
        if($validator->fails()){
            return response()->json(['error' => 'Please select an appropriate Image.'], $this->unauth_error);
        }

        $user = Auth::user();
        // save img
        $data = $request->all();
        // $image = $request->file('profile_img');
        $image = $data["profile_img"];
        $filename = time().'.'.$image->getClientOriginalExtension();
        // return response()->json(['error' => $filename], $this->unauth_error);
        Storage::putFileAs('/public/uploads/profile_pic', $image, $filename);
        $user->profile_img = $filename;
        $user->save();

        return response()->json(['success' => 'okk'], $this->success_status);
    }
}

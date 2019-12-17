<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use App\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
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


    public function add_new_address(Request $request){
        
        $validator = Validator::make($request->all() ,[
            'delivery_address' => 'required',
            'province' => 'required',
            'city' => 'required',
            'zipcode' => 'required',
        ]);
            
        if($validator->fails()){
            return response()->json(['error' => 'Unable to add new Address'], $this->unauth_error);
        }

        $data = $request->all();

        $address = new Address();
        $address->user_id = Auth::user()->id;
        $address->delivery_address = $data["delivery_address"];
        $address->province = $data["province"];
        $address->city = $data["city"];
        $address->zipcode = $data["zipcode"];

        $address->save();

        return response()->json(['success' => 'New Address successfully added'], $this->success_status);
    }


    public function update_info(Request $request){
        $data = $request->all();

        $user = Auth::user();
        $user->full_name = $data["full_name"];
        $user->email = $data["email"];
        $user->phone_no = $data["phone_no"];

        $user->save();

        return response()->json(['user' => $user], $this->success_status);
    }

    public function update_password(Request $request){
        $data = $request->all();

        $flag = Hash::check($data["current_password"], Auth::user()->password);    
            
        if($flag == false){
            // Password not matched
            return response()->json(['error' => 'Current password not correct'], $this->unauth_error);

        }else{
            // password matched
            $user = Auth::user();
            $user->password = bcrypt($data["password"]);
            $user->save();
            return response()->json(['success' => 'Password Updated'], $this->success_status);
        }
    }

    public function complete_registration(Request $request){
        // $data = Request::file('file');

        $validator = Validator::make($request->all() ,[
            'username' => 'required|unique:users',
            'phone_no' => 'required',
        ]);
            
        if($validator->fails()){
            return response()->json(['error' => 'Username already taken'], $this->unauth_error);
        }
        // $image = $request->file->store('uploads/profile_pic');
        // $image = $request->file->getClientOriginalName();
        $user = Auth::user();
        if( $request->has('file')){
            $image = $request->file;
            $filename = time().'.'.$image->getClientOriginalExtension();
            
            Storage::putFileAs('/public/uploads/profile_pic', $image, $filename);
            
            $user->profile_img = $filename;
        }

        $data = $request->all();
        $user->username = $data["username"];
        $user->phone_no = $data["phone_no"];
        $user->save();

        return response()->json(['user' => $user], $this->success_status);
    }



    public function get_addresses(){
        $addresses = Address::where('user_id', Auth::user()->id)->get();

        if($addresses->count() == 0){
            return response()->json(['error' => 'No address Found'], $this->unauth_error);
        }

        return response()->json(['address' => $addresses], $this->success_status);
    }

    public function delete_address(Request $request){
        $data = $request->all();

        try{
            Address::where('id', $data["address_id"])->delete();
        }catch(Exception $e){
            return response()->json(['error' => 'Unable to delete address'], $this->unauth_error);
        }


        $addresses = Address::where('user_id', Auth::user()->id)->get();

        if($addresses->count() == 0){
            return response()->json(['error' => 'No address Found'], $this->unauth_error);
        }

        return response()->json(['address' => $addresses], $this->success_status);
    }


}

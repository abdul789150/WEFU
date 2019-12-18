<?php

namespace App\Http\Controllers;

use App\User;
use App\Address;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Runner\Exception;

class profile_controller extends Controller
{
    //

    public function __construct(){
        $this->middleware('auth');
    }

    public function index($username){

        $user = User::where('username', $username)->get();
        // dd($user);

        return view('customer_portal.profile', [
            'user' => $user,
        ]);
    }

    public function passUpdate(Request $request, $username){
        
        $validator = Validator::make($request->all() ,[
            'current_password' => 'required',
            'password' => 'required',
        ]);
        
        if($validator->fails()){
            return redirect('profile/'.$username)->withErrors($validator);
        }

        $data = $request->all();
        $user = $user = User::where('username', $username)->first();    
        $flag = Hash::check($data["current_password"], $user->password);    
            
        if($flag == false){
            // Password not matched
            return redirect('profile/'.$username)->withErrors(['current_password'=>'Password is not correct!']);

        }else{
            // password matched
            $user->password = bcrypt($data["password"]);
            $user->save();
            return redirect('profile/'.$username);
        }
    }

    public function dataUpdate(Request $request, $username){
        
        // dd($request->all());
        // profile_img, full_name, username, email, phone_no
        
        $validator = Validator::make($request->all() ,[
            'full_name' => 'required|string|max:191',
            'email' => 'nullable|string|email|max:191|unique:users',
            'phone_no' => 'nullable|max:11|digits:11',
        ]);
    

        if($validator->fails()){
            return redirect('profile/'.$username)->withErrors($validator);
        }

        $data = $request->all();
        $user = $user = User::where('username', $username)->first();
       
        if(array_key_exists("phone_no", $data)){
            $user->phone_no = $data["phone_no"];
        }
        if($data["email"] != null){
            $user->email = $data["email"];
        }

        $user->full_name = $data["full_name"];

        $user->save();

        return redirect('profile/'.$username);
    }

    public function address_page($username){
        
        $user = User::where('username', $username)->get();
        // dd($user);

        return view('customer_portal.address.add_address', [
            'user' => $user,
        ]);
    
    }

    public function add_address(Request $request, $username){
        // dd($request);
        $data = $request->all();
        
        if(array_key_exists("phone_no", $data)){
            $data = request()->validate([
                'delivery_address' => 'required',
                'city' => 'required',
                'province' => 'required',
                'phone_no' => 'required',
                'zipcode' => 'required',
            ]);

            $user = User::where('username', $username)->first();
            foreach ($data as $key => $value) {
                if($value != null){
                    if($key == "phone_no"){
                        $user->phone_no = $value;
                    }
                }
            }    
            $user->save();

            $address = new Address();
            $address->user_id = $user->id;
            $address->delivery_address = $data['delivery_address'];
            $address->province = $data['province'];
            $address->city = $data['city'];
            $address->zipcode = $data['zipcode'];
            
            $address->save();
            
            return redirect()->route('profile', ['username' => $user->username]);

        }else{
            
            $data = request()->validate([
                'delivery_address' => 'required',
                'city' => 'required',
                'province' => 'required',
                'zipcode' => 'required',
            ]);

            $user = User::where('username', $username)->first();
            $address = new Address();
            $address->user_id = $user->id;
            $address->delivery_address = $data['delivery_address'];
            $address->province = $data['province'];
            $address->city = $data['city'];
            $address->zipcode = $data['zipcode'];

            $address->save();

            return redirect()->route('profile', ['username' => $user->username]);
        }

    }

    public function update_profile_image(Request $request){
        // $data = $request->all();
        
        $validator = Validator::make($request->all() ,[
            'profile_img' => 'required|mimes:jpg,jpeg,png,bmp,tiff',
        ]);

        if($validator->fails()){
            return redirect('profile/'.Auth::user()->username)->withErrors($validator);
        }
        // save img
        $user = $user = User::where('username', Auth::user()->username)->first();
        $image = $request->file('profile_img');
        $filename = time().'.'.$image->getClientOriginalExtension();
        
        Storage::putFileAs('/public/uploads/profile_pic', $image, $filename);
        
        $user->profile_img = $filename;
        $user->save();

        return redirect('profile/'.Auth::user()->username);
    }

    public function delete_address($id){

        try{
            Address::where('id', $id)->delete();
        }catch(Exception $e){

        }

        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create(Request $request){
        $this->validate($request, [
            'business_name' => 'required',
            'business_type' => 'required',
            'address' => 'required',
            'city' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8',
            'primary_phone' => 'required',
            'post_code' => 'required',
            'country' => 'required',
            'quoting_person_name'=>'required',
            'vat_no' =>'required',
            'warranty' => 'required'

        ],[
            'business_name.required'=>'Required field',
            'business_type.required'=>'Required field',  
            'address.required'=>'Required field',
            'city.required'=>'Required field',
            'email.required'=>'Required field',
            'password.required'=>'Required field',
            'password.min'=>'Minimum 8 characters',
            'primary_phone.required'=>'Required field',
            'post_code.required'=>'Required field',
            'country.required'=>'Required field',
            'quoting_person_name.required'=>'Required field',
            'vat_no.required'=>'Required field',
            'warranty.required'=>'Required field',
        ]);

        DB::beginTransaction();

        try{
         
            $id = DB::table('usersvv')->insertGetId([
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            if(!$id){
                throw new \Exception('Something wrong');
            }

            DB::table('business_profiles')->insert([
                'business_name'=>$request->business_name,
                'business_type'=>$request->business_type,  
                'address'=>$request->address,
                'city'=>$request->city,
                'user_id'=>1,
                'primary_phone'=>$request->primary_phone,
                'post_code'=>$request->post_code,
                'country'=>$request->country,
                'quoting_person_name'=>$request->quoting_person_name,
                'vat_no'=>$request->vat_no,
                'warranty'=>$request->warranty,
                'alternative_phone'=>$request->warranty
            ]);


            DB::commit();
            return redirect()->back()
                ->with('success','User created successfully');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error','User creation failed');
        }
      
    }

    public function check(Request $request){
        $this->validate($request, [
          
            'email' => 'required|exists:users,email',
            'password' => 'required|min:8',
           
        ],[
           
            'email.exists'=>'Not exist',
            'password.required'=>'Required field', 
            'password.min'=>'Minimum 8 characters',
        ]);

        $creds= $request->only('email','password');
        if(Auth::attempt($creds)){
            return redirect()->route('user.home');
        }else{
            return redirect()->back()->with('error','Credentials not correct');  
        }
    }
}

<?php

namespace App\Http\Controllers\panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Panel\User\UpdeteProfileRequest;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show(){
        return view('panel.profile');
    }
    public function update(UpdeteProfileRequest $request){
        
        $data= $request->validated();
        
        if($request->password){
            $data['password'] = Hash::make($request->password);
        }else{
            unset($data['password']);
        }
        if($request->hasFile('profile')){
        $file = $request->file('profile');
        //logo.png
        $ext = $file->getClientOriginalExtension();//png
        $file_name = auth()->user()->id . '_' . time() . '.' . $ext;
        $file->storeAs('images/users', $file_name ,'public_files');
        $data['profile']= $file_name;
        }
        
        auth()->user()->update($data);
        session()->flash('status', 'اطلاعات کاربری شما به درستی ویرایش شد');
        return back();
    }
}

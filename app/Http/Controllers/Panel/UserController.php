<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use App\Http\Requests\Panel\User\CreateUserRequest;
use App\Http\Requests\Panel\User\UpdateUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users =User:: paginate(10);
        
        return  view('panel.users.index',compact('users'));
    }

    public function create()
    { 
        
         
        return  view('panel.users.create');
    }

    public function store(CreateUserRequest $request)
    {
        

        $data = $request->validated();
        $data['password']=Hash::make('password');
        
        User::create($data);
        $request->session()->flash('status', 'کاربر به درستی ایجاد شد !');
        return redirect()->route('users.index');
    }


    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        
        return view('panel.users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
     
        $user->update(
            $request->validated()
        );
        $request->session()->flash('status', 'اطلاعات کاربر به درستی ویرایش شد');

        return redirect()->route('users.index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request ,User $user)
    {
        $user->delete();
        $request->session()->flash('status', 'کاربر مورد نظر حذف شد');

        return back();
    }
}

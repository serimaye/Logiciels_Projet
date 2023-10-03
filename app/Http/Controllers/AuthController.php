<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register()
    {
        return view('admin.users.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function registerSave(Request $request)
    {
        Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed'
        ])->validate();

        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);
        return redirect('admin/users/login');
    }

    public function loginAction(Request $request){

        Validator::make($request->all(),[
            'email'=>'required|email',
            'password' =>'required'
        ])->validate();

        if(!Auth::attempt($request->only('email' , 'password'),$request->boolean('remember'))){
            throw ValidationException::withMessage([
                'email'=>trans('auth.failed')
            ]);
        }
        $request->session()->regenerate();
        return redirect('dashboard');
    }

    public function logout(Request $request){
        Auth::guard('web')->logout();
        $request->session()->invalidate();

        return view('auth.login');
    }

}

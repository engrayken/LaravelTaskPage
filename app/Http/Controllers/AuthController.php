<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Session;


class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    public function register()
    {
        return view('auth.register');
    }


    public function loginUser(Request $request)
    {
        $request->validate([
            'email'=>'required',
            'password'=>'required',
        ],
    [
        'email.required' => 'Please Email is required.',
        'password.required' => 'Please Password is required.',

    ]);

    $selEmail= User::where('email','=',$request->email)->first();
    if(!$selEmail)
    {
        return back()->with('failed','Email or Password Does not Exist');
    }

// $check=make::Hash($request->password);

    if(Hash::check($request->password, $selEmail->Password))
    {

     $request->session()->put('loginid', $selEmail->id);
       return redirect('/dashboard');
   } else{

       return back()->with('failed', 'Invalid password');

   }


    }


    public function registerUser(Request $request)
    {
        $request->validate([
            'fullname'=>'required',
            'Email'=>'required|Email|unique:users',
            'Password'=>'required',
        ],
    [
        'fullname.required' => 'Please Full Name is required.',
        'Email.required' => 'Please Email is required.',
        'Email.unique'=>'Please dear this email already exist.',
        'Password.required' => 'Please Password is required.',

    ]);

    $insert= new User();
    $insert->FullName=$request->fullname;
    $insert->Email=$request->Email;
    $insert->Password=Hash::make($request->Password);

    $save=$insert->save();
    if(!$save)
    {
        return back()->with('failed','Unable to Register User');
    }

    return back()->with('success','Registration Successful');

    }

}

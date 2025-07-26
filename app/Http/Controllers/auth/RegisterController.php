<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller{
    public function showRegisterForm(){
        return view('auth.register');
    }


    public function register(Request $request){

        $request->validate(
            [
                'name' => 'required|string|max:225',
                'email' => 'required|string|email|max:225|unique:users',
                'password' => 'required|string|min:6|confirmed',
                           ]
            );


            $user = User::create(
                [
                    'name'=> $request->name,
                    'email'=> $request-> email,
                    'password'=> Hash::make($request->password),
                ]
                );
        Auth::login($user);
        return redirect()->route('dashboard'); // Change to your desired route

    }
    

}
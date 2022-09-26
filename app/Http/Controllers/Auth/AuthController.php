<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //login
    public function login()
    {
        return view('login');
    }

    public function register()
    {
        return view('register');
    }

    public function dashboard()
    {
        if(auth()->user()->role == 'admin'){
            return redirect()->route('category.list');
        }else{
            return redirect()->route('user.home');
        }
    }

    public function changePassword()
    {
        return view('admin.accounts.changepassword');
    }

    public function saveChangePassword()
    {
        $data = request()->validate([
            'old_password' => ['required'],
            'new_password' => ['required','min:6'],
            'confirm_password' => ['required','min:6','same:new_password'],
        ]);
        if(Hash::check(request('old_password'), auth()->user()->password)){
            $new_password = Hash::make(request()->new_password);
            User::where('id',auth()->user()->id)->update([
                'password' => $new_password,
            ]);
             Auth::logout();
             return back();
        }
        return back()->withInput()
        ->withErrors(['old_password'=>'Old password does not match!']);
    }

    
}
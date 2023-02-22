<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\RoleUser;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection;

class CustomAuthController extends Controller
{


    public function index()
    {
        return view('auth.login');
    }

    public function customLogin(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ],
    [
        'name.required'=>'Please enter username',
        'password.required'=>'Please enter your password',
    ]
    );

        if (Auth::attempt(['username'=>$request->name,'password'=>$request->password])) {
            if (Auth::User()->active ==1){
                $roles=RoleUser::where('userId',Auth::User()->id)->where('roleId', 4)->count();
                if($roles == 1)
                    return redirect()->intended('home')->withSuccess('Signed in');
                else
                    return back()->withErrors('You are not allowed to login');
            }
            else
            return back()->withErrors('You are not allowed to login');

        }

        else{
        return back()->withErrors('Login details are not valid');
    }
}
    public function home()
    {
            return view('Admin.home');
      }

    public function signOut() {
        Auth::logout();

        return Redirect('login');
    }
}

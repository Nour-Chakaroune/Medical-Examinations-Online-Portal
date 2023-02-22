<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fullname',
        'username',
        'email',
        'password',
        'phone',
        'number',
        'active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function updateProfile(Request $request){
        $task= User::where('id',Auth::user()->id)->first();
        $task->fullname = $request->fullname;
        $task->email = $request->email;
        $task->phone = $request->phone;
        $task->username = $task->username;
        $task->update();
        return back()->with('err','Profile has been updated successfully.');
    }
    public static function changePass(Request $request){
        if($request->newpass == $request->confirmpass){
            $user= User::where('id',Auth::user()->id)->first();
            if (Hash::check($request->oldpass, $user->password)) {
                $user->fill(['password' => Hash::make($request->newpass)])->save();
                return back()->with('err','Password has been changed successfully.');
                }
            else
                return back()->withErrors('Incorrect Current Password');
        }
        else
            return back()->withErrors('Password does not match');
    }
}

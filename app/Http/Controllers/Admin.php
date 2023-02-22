<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\RequestReturn;
use App\Models\Beneficiary;
use App\Models\Tests;
use App\Models\MedicalCenter;
use App\Models\Requested;
use App\Models\Task;
use Carbon\Carbon;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

class Admin extends Controller
{
    public function getProfile(){
            return view('Admin.updateProfile');
    }

    public function updateProfile(Request $request){
        $request->validate([
            'fullname' => 'required',
            'email' => 'required|unique:users,email,'.Auth::user()->id,
            'phone' => 'required|unique:users,phone,'.Auth::user()->id,
            'username' => 'required|unique:users,username,'.Auth::user()->id,
        ],
    );
        return User::updateProfile($request);
    }

    public function editPass(){
        return view('Admin.editPass');
    }
    public function changePass(Request $request){
        $request->validate([
            'oldpass' => 'required',
            'newpass' => 'required',
            'confirmpass' => 'required',
        ],
    );
        return User::changePass($request);
    }
    public function newTask(){
        $benef= Beneficiary::where('Teacher_ID',Auth()->User()->number)->orderBy('NAME')->get();
        $tests=Tests::all();
        $labmed=MedicalCenter::all();
        return view('Admin.newTask',compact('benef','tests','labmed'));
    }

    public function setNewTask(Request $request){
        $request->validate([
          'benef'=>'required',
          'test'=>'required|array',
          'labmed'=>'required',
          'date'=>'required|date',
          'image'=>'required|max:1000'
      ],
      [
        'benef.required' => 'Please select patient.',
        'test.required' => 'Please specify tests.',
        'labmed.required' => 'Please specify medical center.',
        'date.required' => 'Please add date to your request.',
        'image.required' => 'Please upload an image of the medical examinations.'
      ]);
        return Requested::setNewTask($request);
    }

    public function getWaiting(){
        $wait=Requested::where('serial',Auth()->User()->number)->where('status','Waiting')->orderBy('created_at','ASC')->get();
        return view('Admin.waiting',compact('wait'));
    }
    public function getPending(){
        $pend=Requested::where('serial',Auth()->User()->number)->where('status','Requested')->orderBy('created_at','ASC')->get();
        return view('Admin.pending',compact('pend'));
    }
    public function getAccepted(){
        $acc=Task::where('cust',Auth()->User()->number)->where('Status','Accepted')->orderBy('created_at','DESC')->get();
        return view('Admin.accepted',compact('acc'));
    }
    public function getRejected(){
        $rej=Task::where('cust',Auth()->User()->number)->where('Status','Rejected')->orderBy('created_at','DESC')->get();
        return view('Admin.rejected',compact('rej'));
    }
    public function getReturned(){
        $ret=RequestReturn::where('serial',Auth()->User()->number)->orderBy('created_at','DESC')->get();
        return view('Admin.returned',compact('ret'));
    }
    public function deleteReturned($id){
        return RequestReturn::deleteReturned($id);
    }
    public function resendReturned($id){
        return RequestReturn::resendReturned($id);
    }
    public function resubmitReturned(Request $request){
        $request->validate([
            'benef'=>'required',
            'test'=>'required|array',
            'labmed'=>'required',
            'date'=>'required|date',
            'image'=>'max:1000'
        ],
        [
          'benef.required' => 'Please select patient.',
          'test.required' => 'Please specify tests.',
          'labmed.required' => 'Please specify medical center.',
          'date.required' => 'Please add date to your request.',
        ]);
          return RequestReturn::resubmitReturned($request);
    }


}

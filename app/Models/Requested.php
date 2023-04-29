<?php

namespace App\Models;

use DateTime;
use DateTimeZone;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Image;
use Hash;

class Requested extends Model
{
    use HasFactory;
    protected $table='request';
    protected $fillable=['serial','type','pat','status','reason','labmed','date','image','imageType','userId'];

    public function getpendinglab(){
        return $this->hasOne(MedicalCenter::class,'id','labmed');
    }
    public function getpendingbenef(){
        return $this->hasOne(Beneficiary::class,'id','pat');
    }
    public function getcustomerpending(){
        return $this->hasOne(Customer::class,'id','serial');
    }

    public static function setNewTask(Request $request){
        $task=new Requested();
        $task->serial=Auth()->User()->number;
        $task->type=json_encode($request->test);
        $task->pat=$request->benef;
        $task->Status='Waiting';
        $task->labmed=$request->labmed;
        $task->date=$request->date;

        $date = new DateTime('now');
        $date->setTimezone(new DateTimeZone('Asia/Beirut'));
        $task->created_at=$date->format('Y-m-d H:i:s');
        $task->updated_at=$date->format('Y-m-d H:i:s');

        if( $request->hasFile('image')) {
            $file = $request->file('image');
            $imageType = $file->getClientOriginalExtension();
            $height = Image::make($file)->height();
            $width = Image::make($file)->width();

            $image_resize = Image::make($file)->resize( $height, $width, function ( $constraint ) {
                                                                    $constraint->aspectRatio();
                                                                })->encode( $imageType );
            $task->imageType = $imageType;
            $task->image=$image_resize;

        }

        $task->save();
        return back()->with('succ','Task has been sent successfully.');
    }

    public static function deleteReturned($id){
        $task=Requested::find($id);
        $task->delete();
        return back()->with('err','Record has been deleted successfully.');
    }

    public static function resendReturned($id){
        $task=Requested::find($id);
        $benef= Beneficiary::where('Teacher_ID',Auth()->User()->number)->orderBy('NAME')->get();
        $tests=Tests::all();
        $labmed=MedicalCenter::all();
        return view('Admin.resend',compact('task','benef','tests','labmed'));
    }

    public static function resubmitReturned(Request $request){
        $task=Requested::find($request->id);
        $task->serial=Auth()->User()->number;
        $task->type=json_encode($request->test);
        $task->pat=$request->benef;
        $task->Status='Waiting';
        $task->reason = NULL;
        $task->labmed=$request->labmed;
        $task->date=$request->date;
        $date = new DateTime('now');
        $date->setTimezone(new DateTimeZone('Asia/Beirut'));
        $task->updated_at=$date->format('Y-m-d H:i:s');
        $task->userId= NULL;

        if( $request->hasFile('image')) {
            $file = $request->file('image');
            $imageType = $file->getClientOriginalExtension();
            $height = Image::make($file)->height();
            $width = Image::make($file)->width();

            $image_resize = Image::make($file)->resize( $height, $width, function ( $constraint ) {
                                                                    $constraint->aspectRatio();
                                                                })->encode( $imageType );
            $task->imageType = $imageType;
            $task->image=$image_resize;

        }

        $task->save();
        return redirect()->route('returned')->with('err','Task has been resend successfully.');
    }


}

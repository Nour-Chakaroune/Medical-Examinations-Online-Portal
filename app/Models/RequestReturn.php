<?php

namespace App\Models;

use DateTime;
use DateTimeZone;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Requested;
use Image;
use Hash;

class RequestReturn extends Model
{
    use HasFactory;
    protected $table='requestreturn';
    protected $fillable=['serial','type','pat','status','labmed','date','reason','image','imageType'];


    public function getlabmedOn(){
        return $this->hasOne(MedicalCenter::class,'id','labmed');
    }
    public function getBeneficiarynameOn(){
        return $this->hasOne(Beneficiary::class,'id','pat');
    }
    public function getTypeOn(){
        return $this->hasOne(Tests::class,'id','type');
    }
    public function getCustomerOn(){
        return $this->hasOne(Customer::class,'id','serial');
    }

    public static function deleteReturned($id){
        $task=RequestReturn::find($id);
        $task->delete();
        return back()->with('err','Record has been deleted successfully.');
    }
    public static function resendReturned($id){
        $task=RequestReturn::find($id);
        $benef= Beneficiary::where('Teacher_ID',Auth()->User()->number)->orderBy('NAME')->get();
        $tests=Tests::all();
        $labmed=MedicalCenter::all();
        return view('Admin.resend',compact('task','benef','tests','labmed'));
    }
    public static function resubmitReturned(Request $request){
        $r=RequestReturn::find($request->id);
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
        else{
            $task->image=$r->image;
            $task->imageType=$r->imageType;
        }

        $task->save();
        $r->delete();
        return redirect()->route('returned')->with('err','Task has been resend successfully.');
    }
}

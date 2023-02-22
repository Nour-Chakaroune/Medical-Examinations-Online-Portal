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
    protected $fillable=['serial','type','pat','status','labmed','date','image','imageType'];

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
    public function getpendinglab(){
        return $this->hasOne(MedicalCenter::class,'id','labmed');
    }
    public function getpendingbenef(){
        return $this->hasOne(Beneficiary::class,'id','pat');
    }
    public function getcustomerpending(){
        return $this->hasOne(Customer::class,'id','serial');
    }

}

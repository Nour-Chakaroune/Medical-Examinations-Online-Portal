<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    use HasFactory;
    protected $table='roleuser';
    protected $fillabe=['userId' , 'roleId'];
    public $timestamps=false;

    public function getUser(){
        return $this->hasOne(User::class,'id','userId');
    }
    public function getRole(){
        return $this->hasOne(Role::class,'id','roleId');
    }

    public static function deleteRole($id){
        $task=RoleUser::find($id);
        $c=RoleUser::Where('userId',$task->userId)->count();
        if($c==1){
            return back()->with('cannotdelete','Cannot delete the last role. Please add another role before delete.');
        }
        else{
            if($task->roleId == 4){
                $u=User::where('id',$task->userId)->first();
                $u->number=null;
                $u->save();
            }
            $task->delete();
            return back()->with('err','Role has been deleted successfully.');
        }


    }

    public static function addRole(Request $request){
        if($request->role !=""){
            foreach($request->role as $t){
                if($t==4)
                {
                    $request->validate([
                        'number' => 'required|unique:users,number',
                    ],
                    [
                        'number.required' => 'Role user must have a serial number',
                    ]);

                    $u=User::find($request->uid);
                    $u->number=$request->number;
                    $u->save();
                }
            }
            foreach($request->role as $r){
                $ru = new RoleUser();
                $ru->roleId = $r;
                $ru->userId =$request->uid;
                $ru->save();
            }


            return back()->with('err','Role has been added successfully.');
        }
        else
            return back();
    }
}

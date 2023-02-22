<?php

namespace App\Models;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class Tests extends Model
{
    use HasFactory;
    protected $table='testname';
    protected $filable=['name','type'];
    public $timestamps=false;
    public function getType(){
        return $this->hasOne(Task::class);
    }
    public function getTypepending(){
        return $this->hasOne(Requested::class);
    }
    public function getname($id){
        return Tests::where('id',$id)->get('name');
    }
}

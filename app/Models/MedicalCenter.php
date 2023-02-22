<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalCenter extends Model
{
    use HasFactory;
    protected $table='labmed';
    protected $fillable=['addr','namee','fulladd','phone','fax'];
    public $timestamps=false;
    public function getlabname(){
        return $this->hasOne(Task::class);
    }
    public function getlabnamepending(){
        return $this->hasOne(Requested::class);
    }

}

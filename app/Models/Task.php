<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $table='task';
    protected $fillable=['labmed','cust','benef','type','date','Status','dtask'];

    public function getlabmed(){
        return $this->hasOne(MedicalCenter::class,'id','labmed');
    }
    public function getBeneficiaryname(){
        return $this->hasOne(Beneficiary::class,'id','benef');
    }
    public function getType(){
        return $this->hasOne(Tests::class,'id','type');
    }
    public function getCustomer(){
        return $this->hasOne(Customer::class,'id','cust');
    }
}

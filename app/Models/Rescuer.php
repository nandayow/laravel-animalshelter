<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Rescuer extends Model
{
    use HasFactory;
     use softDeletes;
    protected $primaryKey = 'id'; 
    protected $fillable =['user_id','image','fname','lname','phone'	,'addressline','town','zipcode','created_at','updated_at','deleted_at'];


    public function user(){
        return $this->belongsTo('App\Models\User','id');
    }
    

    public function animal(){
        return $this->hasMany('App\Models\Animal','id');
    }
    
}

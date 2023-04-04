<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Personnel extends Model
{
    use HasFactory;
    use softDeletes;
    protected $primaryKey = 'id'; 
    public $table='personnels';
    protected $fillable =['user_id','image','role','fname',	'lname','phone'	,'addressline','town','zipcode','birth_date','gender','email', 'created_at','updated_at','deleted_at'];
  

    public function user(){
        return $this->belongsTo('App\Models\User','id');
    }
}

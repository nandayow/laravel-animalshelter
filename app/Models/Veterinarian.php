<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Veterinarian extends Authenticatable
{
    use HasFactory,  SoftDeletes , Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id'; 
    protected $fillable =['user_id','image','fname','lname','phone'	,'addressline','town','zipcode','created_at','updated_at','deleted_at'];



    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function user(){
        return $this->belongsTo('App\Models\User','id');
    }

    public function animal(){
        return $this->hasMany('App\Models\Animal','vet_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class AnimalMedicalCondition extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    use softDeletes;


    public function animal(){
        return $this->belongsTo('App\Models\Animal','id');
    }

    public function animalhealth(){
        return $this->hasMany('App\Models\AnimalHealth','condition_id');
    }
}

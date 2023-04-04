<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class AnimalHealth extends Model
{
    use HasFactory;


    public function animal(){
        return $this->belongsTo('App\Models\Animal','id');
    }

    public function animalcondition(){
        return $this->belongsTo('App\Models\AnimalMedicalCondition','condition_id');
    }
}

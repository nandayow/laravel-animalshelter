<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdoptedAnimal extends Model
{
    use HasFactory;
    public $table = 'adopted_animals';
    public $primaryKey = 'animal_id';
    protected $fillable = ['adopter_id','status','created_at','updated_at'];

     public function animals(){
        return $this->belongsTo('App\Models\Animal','id');
    }

    
    public function animalss(){
        return $this->belongsToMany('App\Models\Animal','adopters','animal_id','adopter_id')->withPivot('status');
   }
}

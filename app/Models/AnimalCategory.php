<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnimalCategory extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'animal_categories';
    protected $fillable = ['breed_name', 'animal_type','created_at','updated_at'];


    public function animal(){
        return $this->hasMany('App\Models\Animal','id');
    }
}

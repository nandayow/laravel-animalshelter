<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Animal extends Model   implements Searchable
{
    use HasFactory;
     use softDeletes;
     protected $primaryKey = 'id';
     protected $table = 'animals';
     protected $fillable = ['animal_name', 'gender','	approximate_age','	category_id',
    'rescuer_id','healthstatus','vet_id','image','rescued_date','created_at','updated_at','deleted_at'];

    public function adopted_animals(){
        return $this->hasOne('App\Models\AdoptedAnimal','animal_id');
    }

    public function getSearchResult(): SearchResult
    {
        $url = route('animalshow', $this->id);

        return new SearchResult(
            $this,
            $this->animal_name,
            $url
         );
    }

    public function adopted(){
        return $this->belongsTo('App\Models\AdoptedAnimal','id');
    }

         
    public function rescuer(){
        return $this->belongsTo('App\Models\Rescuer','rescuer_id');
    }

    

    public function vets(){
        return $this->belongsTo('App\Models\Veterinarian','vet_id');
    }

    public function category(){
        return $this->belongsTo('App\Models\AnimalCategory','category_id');
    }

    public function animalhealth(){
        return $this->hasMany('App\Models\AnimalHealth','animal_id');
    }
    public function comments(){
        return $this->hasMany('App\Models\Comment','animal_id');
    }

    
    public function adopters(){
        return $this->belongsToMany(Adopter::class,'adopted_animals','animal_id','adopter_id')->withPivot('status')->withTimestamps();
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use Redirect;
use App\Models\Animal;
use App\Models\AnimalMedicalCondition;
use App\Models\AdoptedAnimal;
use Illuminate\Support\facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    // /**
    //  * Show the application dashboard.
    //  *
    //  * @return \Illuminate\Contracts\Support\Renderable
    //  */
    public function index()
    {
        $animals = DB::table('animals')
            ->leftjoin('animal_categories' ,'animal_categories.id', '=' , 'animals.category_id') 
            ->leftjoin('adopted_animals','adopted_animals.animal_id','=','animals.id') 
            ->where('animals.healthstatus', '=' ,'Cured') 
            ->whereNull('adopted_animals.animal_id')
            ->Select('animals.*','animal_categories.breed_name as breed_name' ,'animal_categories.animal_type as animal_type') 
             ->get();

             

        //    echo($animal);
             $adoptedAnimal= AdoptedAnimal::pluck('animal_id'); 

            return view('animalshelter/index',compact('animals')); 
            
            $animaldisease = DB::table('animal_diseases')
            ->Select('animal_diseases.*')
            ->get();
        //    echo($animal);
            return view('animalshelter/index',['animal_diseases'=>$animal]);
 
    } 
      public function search(Request $req)
    { 
        $animals = DB::table('animals')
        ->leftjoin('animal_categories' ,'animal_categories.id', '=' , 'animals.category_id') 
        ->leftjoin('adopted_animals','adopted_animals.animal_id','=','animals.id') 
        ->where('animals.healthstatus', '=' ,'Cured') 
        ->whereNull('adopted_animals.animal_id')
        ->where('animal_categories.breed_name','like' ,'%'.$req
        ->input('query').'%') 
        ->select('animals.*','animals.id as animalid','animal_categories.*','adopted_animals.*')
        ->get();

        $animals1 = DB::table('animals')
        ->leftjoin('animal_categories' ,'animal_categories.id', '=' , 'animals.category_id') 
        ->leftjoin('adopted_animals','adopted_animals.animal_id','=','animals.id') 
        ->where('animals.healthstatus', '=' ,'Cured') 
        ->whereNull('adopted_animals.animal_id')
        ->where('animal_categories.animal_type','like' ,'%'.$req
        ->input('query').'%') 
        ->select('animals.*','animals.id as animalid','animal_categories.*','adopted_animals.*')
        ->get();
 
        return view('animalshelter.search',compact('animals1','animals'));

    }
}
 
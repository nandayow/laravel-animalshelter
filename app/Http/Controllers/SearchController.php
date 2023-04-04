<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Searchable\Search;
use App\Models\Animal;

class SearchController extends Controller
{
    public function search(Request $request){
    	$searchResults = (new Search())
		   ->registerModel(Animal::class, 'animal_name','gender','approximate_age','category_id',
           'rescuer_id','healthstatus','image','rescued_date','created_at','updated_at','deleted_at')
 		   ->search($request->search);
		   // dd($searchResults);
	   // return view('item.search',compact('searchResults'));
		   return view('animal.search',compact('searchResults'));
    }
}

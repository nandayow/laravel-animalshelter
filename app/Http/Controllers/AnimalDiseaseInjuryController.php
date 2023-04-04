<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use View;
use Auth;
use Redirect;
use App\Models\Animal;
use App\Models\AnimalHealth;
use App\Models\AnimalMedicalCondition;
use DataTables; 
use Illuminate\Support\facades\DB;
use Illuminate\Support\Facades\Session;

class AnimalDiseaseInjuryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $animalconditions = DB::table('animal_medical_conditions')  
        ->where('condition_type','Disease')
        ->orderBy('animal_medical_conditions.id', 'ASC')
        ->get();
    //    echo($animal); 
        
    if ($request->ajax()) { 
        return Datatables::of($animalconditions) 
           ->addIndexColumn()
           ->addColumn('action', 'animaldisease_injury.action') 
           ->rawColumns(['action'])
           ->make(true);
   }
    return view('animaldisease_injury.animaldisease_index');
        
    } public function index2(Request $request)
    {
        $animalconditions = DB::table('animal_medical_conditions')  
        ->where('condition_type','Injury')
        ->orderBy('animal_medical_conditions.id', 'ASC')
        ->get();
        if ($request->ajax()) { 
            return Datatables::of($animalconditions) 
               ->addIndexColumn()
               ->addColumn('action', 'animaldisease_injury.action') 
               ->rawColumns(['action'])
               ->make(true);
       } 
    return view('animaldisease_injury.animalinjury_index'); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         
             return view('animaldisease_injury/animaldisease_injury');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        $validated = $request->validate
        ([
           'condition_name' => 'required|unique:animal_medical_conditions',
           'condition_type' => 'required', 
        ]); 

        $animalcondition = new AnimalMedicalCondition();
        $animalcondition -> condition_name = $request->condition_name;
        $animalcondition -> condition_type = $request->condition_type;
        $animalcondition->save(); 

        return redirect()->back()->with('success','New Animal Disease and Injury added!');  
    
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $conditions= DB::table('animal_medical_conditions')
        ->where('id',$id)
        ->get();
 
       return view('animaldisease_injury.animaldisease_injury_edit',compact('conditions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $animalcondition = AnimalMedicalCondition::find($id);  
        $animalcondition -> condition_name = $request->condition_name;
        $animalcondition -> condition_type = $request->condition_type;
        $animalcondition->save(); 

        return redirect('animaldisease_injury')->with('success','Updated!');  
    
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $animalMedicalCondition = AnimalMedicalCondition::findOrFail($id);
        $animalMedicalCondition->delete();
        return Redirect()->back()->with('success','Successfully deleted!');  
    }  public function restore($id) 
    {
        AnimalMedicalCondition::withTrashed()->where('id',$id)->restore();
        return  Redirect()->back()->with('success','Restored successfully!');
    }
  
}

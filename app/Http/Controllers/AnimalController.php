<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use view;
use redirect;
use App\Models\AnimalCategory;
use App\Models\Animal;
use App\Models\AnimalHealth; 
use App\Models\Adopter;
use App\Models\Comment;
use App\Models\AnimalMedicalCondition;
use Illuminate\Support\facades\DB;
use App\Models\AdoptedAnimal;
use Illuminate\Support\Facades\Session;
use DataTables;
use Auth;
use App\Models\Veterinarian;  
use Illuminate\Support\Facades\Event;
use App\Events\SendMail; 
use Carbon\Carbon;
class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $animal = DB::table('animals') 
            ->join('animal_categories' ,'animal_categories.id', '=' , 'animals.category_id')
            ->leftjoin('adopted_animals','adopted_animals.animal_id','=','animals.id') 
            ->Select('animals.*','animal_categories.breed_name as breed_name' ,'animal_categories.animal_type as animal_type')
            ->WhereNull('deleted_at')
            ->whereNull('adopted_animals.animal_id')
            ->orderBy('animals.id', 'ASC')
            ->get();
        //    echo($animal); 

        if ($request->ajax()) { 
            return Datatables::of($animal) 
               ->addIndexColumn()
               ->addColumn('action', 'animal.action') 
               ->rawColumns(['action'])
               ->make(true);
       }
      
       //  $profile = Veterinarian::where('user_id',Auth::id())->first();

       return view('animal.animal_index');

       $animal = Animal::all();
       dd($animal);
   }

   public function indexadopted(Request $request)
    {
        $animal = DB::table('animals') 
            ->join('animal_categories' ,'animal_categories.id', '=' , 'animals.category_id')
            ->leftjoin('adopted_animals','adopted_animals.animal_id','=','animals.id') 
            ->Select('animals.*','animal_categories.breed_name as breed_name' ,'animal_categories.animal_type as animal_type')
            ->WhereNull('deleted_at')
            ->whereNotNull('adopted_animals.animal_id')
            ->get();

            if ($request->ajax()) { 
                return Datatables::of($animal) 
                   ->addIndexColumn()
                   ->addColumn('action', 'animal.action') 
                   ->rawColumns(['action'])
                   ->make(true);
           }
        return view('animal.animal_adopted');
    }  
    public function indexTrash(Request $request)
    {
        $animal = DB::table('animals') 
            ->join('animal_categories' ,'animal_categories.id', '=' , 'animals.category_id')
            ->Select('animals.*','animal_categories.breed_name as breed_name' ,'animal_categories.animal_type as animal_type')
            ->WhereNotNull('deleted_at')
            ->get();
        //    echo($animal); 
        if ($request->ajax()) { 
            return Datatables::of($animal) 
               ->addIndexColumn()
               ->addColumn('action', 'animal.actiontrash') 
               ->rawColumns(['action'])
               ->make(true);
       }
        return view('animal.animal_trash');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $profile = Auth::user();
        if( $profile->role =='employee')
        {
            $animal_breed = AnimalCategory::pluck('breed_name' ,'id');
            return view('animal/animal_create', compact( 'animal_breed')); 
        
        }
        else
        {
            return redirect('animal')->with('error' ,'You must login!');
        }      
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
            
             'animal_name' => 'required',
             'gender' => 'required|min:1',
             'approximate_age' => 'required|min:1', 
             'image' => 'required|mimes:jpg,png,jpeg',
             'rescued_date' => 'required',
              
          ]); 
        $name = $request->file('image')->getClientOriginalName();
        $path= $request->file('image')->storeAs('public/images/',$name);
        $animal = new Animal();
      
        $animal ->animal_name = $request->animal_name;
        $animal ->gender = $request->gender;
        $animal ->approximate_age = $request->approximate_age;
        $animal ->category_id = $request->get('animal_breed');
        $animal ->rescuer_id = $request->rescuer_id;
        $animal ->healthstatus = 'Not Cured';
        $animal ->image = $name;
        $animal ->rescued_date= $request->rescued_date;
         $animal->save();
     
        foreach ($request->input("condition_id") as $condition)
          {
            $animal_condition = new AnimalHealth;
            $animal_condition->condition_id= $condition;
            $animal_condition->animal_id= $animal->id;
            $animal_condition->save();
          } 

          Event::dispatch(new SendMail(2));

        return redirect()->route('rescuer.show',$request->rescuer_id)->with('success','New Animal  added!');
      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $animalid = Animal::find($id);
        $animal = DB::table('animals') 
        ->join('animal_categories' ,'animal_categories.id', '=' , 'animals.category_id')
        ->join('rescuers' ,'rescuers.id' ,'=' ,'animals.rescuer_id')
        ->where('animals.id','=', $id)
        ->Select('animals.*','rescuers.*','animal_categories.breed_name as breed_name' ,'animal_categories.animal_type as animal_type')
        ->get();
        
        $animalhealth= DB::table('animal_healths')
        ->join('animal_medical_conditions' , 'animal_medical_conditions.id', '=' ,'animal_healths.condition_id')
        ->where( 'animal_id',$id) 
        ->Select('animal_medical_conditions.*' ,'animal_healths.*')
        ->get();
         
        $adopters= DB::table('adopters')
        ->join('adopted_animals' , 'adopters.id', '=' ,'adopted_animals.adopter_id')
        ->join('animals' , 'animals.id', '=' ,'adopted_animals.animal_id')
        ->where( 'animal_id',$id) 
        ->Select('animals.*' ,'adopters.*')
        ->get();

        // dd($animalcondition);
        // dd($animalhealth);
        return view('animal.animal_show',compact('animalid' ,'animal' ,'animalhealth' ,'adopters')); 
    }

    public function animnalshow($id)
    {
        $animalid = Animal::find($id);
        $animal = DB::table('animals') 
        ->join('animal_categories' ,'animal_categories.id', '=' , 'animals.category_id')
        ->join('rescuers' ,'rescuers.id' ,'=' ,'animals.rescuer_id')
        ->where('animals.id','=', $id)
        ->Select('animals.*','rescuers.*','animal_categories.breed_name as breed_name' ,'animal_categories.animal_type as animal_type')
        ->first();
        
        $animalhealth= DB::table('animal_healths')
        ->join('animal_medical_conditions' , 'animal_medical_conditions.id', '=' ,'animal_healths.condition_id')
        ->where( 'animal_id',$id) 
        ->Select('animal_medical_conditions.*' ,'animal_healths.*')
        ->get();
         
        $adopters= DB::table('adopters')
        ->join('adopted_animals' , 'adopters.id', '=' ,'adopted_animals.adopter_id')
        ->join('animals' , 'animals.id', '=' ,'adopted_animals.animal_id')
        ->where( 'animal_id',$id) 
        ->Select('animals.*' ,'adopters.*')
        ->get();
         $comments = Comment::where("animal_id","=",$id)->get();  

        // dd($comments);
         $date = Carbon::parse($animal->created_at)->format('Y-m-d');
         $time = Carbon::parse($animal->created_at)->format('H:i');      
         $commentCount = $comments->count();
         // dd($animalcondition);
        // dd($animalhealth);

        return view('guest.show',compact('animalid' ,'animal' ,'animalhealth' ,'adopters','date','time','comments','commentCount')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $animalid = Animal::find($id);
        $animal = DB::table('animals') 
        ->join('animal_categories' ,'animal_categories.id', '=' , 'animals.category_id')
        ->join('rescuers' ,'rescuers.id' ,'=' ,'animals.rescuer_id')
        ->where('animals.id','=', $id)
        ->Select('animals.*','rescuers.*','animal_categories.breed_name as breed_name' ,'animal_categories.animal_type as animal_type')
        ->get();
        
        $animalhealth= DB::table('animal_healths')
        ->where( 'animal_id',$id) 
        ->pluck('condition_id')->toArray();
        
        $animal_breed = AnimalCategory::pluck('breed_name' ,'id');

        $animalcondition= AnimalMedicalCondition::pluck('condition_name','id');

        // dd($animalcondition);
        // dd($animalhealth);
        return view('animal.animal_edit',compact('animalid' ,'animal' ,'animalhealth' ,'animalcondition' , 'animal_breed')); 
        
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
        $animalid = Animal::find($id);


        $animal = new Animal();
        $user = Auth::user(); 
        $profile = Veterinarian::where('user_id',Auth::id())->first();
        
        
        if(empty($request->file('image')))
        {
            //  $animalid->update($request->all());
            $animalid ->animal_name = $request->animal_name;
            $animalid ->vet_id=$profile->id;
            $animalid ->gender = $request->gender;
            $animalid ->approximate_age = $request->approximate_age;
            $animalid ->category_id = $request->category_id;
            $animalid ->rescuer_id = $request->rescuer_id; 
            $animalid ->healthstatus = $request->healthstatus;
             $animalid ->rescued_date= $request->rescued_date;
            $animalid->save();
        }else{
        
            $name = $request->file('image')->getClientOriginalName();
            $path= $request->file('image')->storeAs('public/images/',$name);
            $animalid ->animal_name = $request->animal_name;
            $animalid ->vet_id=$profile->id;
            $animalid ->gender = $request->gender;
            $animalid ->approximate_age = $request->approximate_age;
            $animalid ->category_id = $request->category_id;
            $animalid ->rescuer_id = $request->rescuer_id; 
            $animalid ->healthstatus = $request->healthstatus;
            $animalid ->image = $name;
            $animalid ->rescued_date= $request->rescued_date;
            $animalid->save();
 
        }

        $animalconditionid =$request->input('condition_id');
       
        if(empty($animalconditionid))
        {
            DB::table('animal_healths')->where('animal_id', $id)->delete();
        }
        else
        {
            foreach($animalconditionid as $conditionid)
            {
                DB::table('animal_healths')->where('animal_id', $id)->delete();
    
            }
            foreach($animalconditionid as $conditionid)
            {
                DB::table('animal_healths')->insert(['condition_id'=>$conditionid,'animal_id'=>$id]);
    
            }
        }   
        return redirect()->back()->with('success','Successfully Updated!');
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { 
     $animals = Animal::findOrFail($id);
     $animals->delete();
     return Redirect('animal')->with('success','Animal deleted!');  
    } 
//Restore method
    public function restore($id) 
    {
        Animal::withTrashed()->where('id',$id)->restore();
        return  Redirect('animal')->with('success','Animal restored successfully!');
    } 
}



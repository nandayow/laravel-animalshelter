<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use Redirect;
use Auth;
use App\Models\Animal;
use App\Models\Rescuer;
use App\Models\User;
use App\Models\AnimalCategory;
use Illuminate\Support\facades\DB;
use Illuminate\Support\Facades\Session;
use DataTables;
class RescuerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $rescuer = DB::table('rescuers')
        ->whereNull('deleted_at')
        ->get();  

        if ($request->ajax()) { 
            return Datatables::of($rescuer) 
               ->addIndexColumn()
               ->addColumn('action', 'rescuer.action') 
               ->rawColumns(['action'])
               ->make(true);
       }

       return view('rescuer.rescuer_index');


    }
    public function indexTrash(Request $request)
    {
        $rescuer = DB::table('rescuers')
        ->whereNotNull('deleted_at')
        ->get();  
        if ($request->ajax()) { 
            return Datatables::of($rescuer) 
               ->addIndexColumn()
               ->addColumn('action', 'rescuer.actiontrash') 
               ->rawColumns(['action'])
               ->make(true);
       } 
       return view('rescuer.rescuer_trash'); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()

    { 
             return view('rescuer/rescuer_create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    static function store(Request $request)
    {
        $validated = $request->validate
        ([
      
           'fname' => 'required',
           'lname' => 'required',
           'phone' => 'required|unique:rescuers|min:11',
           'addressline' => 'required',
           'town' => 'required',
           'zipcode' => 'required',
         
        ]);

        $user = new User([
              'name' => $request->input('fname').' '.$request->lname,
              'email' => $request->input('fname').' '.'gmail.com',
              'password' => bcrypt($request->input('password')),
              'role' => 'rescuer',
              'status' => "active"
          ]); 
          $user->save();
      
            $rescuer = new Rescuer();
            $rescuer->user_id = $user->id;
            $rescuer -> fname = $request->fname;
            $rescuer -> lname = $request->lname;
            $rescuer -> phone = $request->phone;
            $rescuer -> addressline = $request->addressline;
            $rescuer -> town = $request->town;
            $rescuer -> zipcode = $request->zipcode;
            $rescuer->save();
  

      
      return redirect()->route('rescuer.show',$rescuer->id);  

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         
       
            $animal_breed = AnimalCategory::orderBY('breed_name','ASC')->pluck('breed_name' ,'id');
           
            $animal_medical_condition = DB::table('animal_medical_conditions') 
            ->where('animal_medical_conditions.condition_type', '=' , 'Disease')
            ->orwhere('animal_medical_conditions.condition_type', '=' , 'disease')
            ->Select('animal_medical_conditions.condition_name as condition_name','animal_medical_conditions.condition_type as condition_type',
            'animal_medical_conditions.id as condition_id')
            ->orderBy('condition_name', 'ASC')
            ->get(); 
            $animal_medical_condition1 = DB::table('animal_medical_conditions')
            ->where('animal_medical_conditions.condition_type', '=' , 'Injury')
            ->Select('animal_medical_conditions.condition_name as condition_name','animal_medical_conditions.id as condition_id')
            ->get(); 
            $data = Rescuer::find($id);
            
            return view('animal.animal_create',compact('animal_breed','data','animal_medical_condition','animal_medical_condition1'));
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rescuer = DB::table('rescuers')
        ->where('id',$id)
        ->get();  
       return view('rescuer.rescuer_edit',['rescuers'=>$rescuer]);
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
        $rescuer = Rescuer::find($id);
        // dd($rescuer);
        $rescuer->update($request->all()); 
        return redirect()->route('rescuer.index')->with('success','Successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { 
     $rescuer = Rescuer::findOrFail($id);
     $rescuer->delete();
     return Redirect('rescuer')->with('success','Rescuer deleted!');  
    } 
//Restore method
    public function restore($id) 
    {
        Rescuer::withTrashed()->where('id',$id)->restore();
        return  Redirect('rescuer')->with('success','Rescuer restored successfully!');
    }
    public function rescuershow($id)
{
      
    $rescuers= DB::table('rescuers')
    ->join('animals','animals.rescuer_id','=', 'rescuers.id') 
    ->join('animal_categories' ,'animal_categories.id', '=' , 'animals.category_id') 
   ->where( 'rescuers.id',$id) 
   ->Select('rescuers.*','animals.*' ,'animal_categories.*')
   ->get();  


   return view('rescuer.rescuer_show',compact('rescuers'));

}
// public function getProfile(){
//     $rescuer = Rescuer::where('user_id',Auth::id())->first();
//     // $orders = Order::with('customer','items')->where('customer_id',$customer->customer_id)->get();
// return view('user.rescuer',compact('rescuer'));
// }
    
}


<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use Redirect;
use App\Models\Animal;
use App\Models\Rescuer;
use Illuminate\Support\Facades\Hash;
use App\Models\Adopter; 
use App\Models\User; 
use Illuminate\Support\facades\DB;
use App\Models\AdoptedAnimal;
use Illuminate\Support\Facades\Session;
use DataTables;
use Auth;
class AdopterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { 
        $adopters= DB::table('adopters') 
        ->whereNull('deleted_at')
       ->get(); 
       
       if ($request->ajax()) { 
        return Datatables::of($adopters) 
           ->addIndexColumn()
           ->addColumn('action', 'adopter.action') 
           ->rawColumns(['action'])
           ->make(true);
   }
       return view('adopter.adopter_index');
           
    }  public function indexTrash(Request $request)
    { 
        $adopters= DB::table('adopters') 
        ->whereNotNull('deleted_at')
       ->get();   
       if ($request->ajax()) { 
        return Datatables::of($adopters) 
           ->addIndexColumn()
           ->addColumn('action', 'adopter.actiontrash') 
           ->rawColumns(['action'])
           ->make(true);
   }
       return view('adopter.adopter_trash');    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('adopter.adopter_create');
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
        
           'fname' => 'required',
           'lname' => 'required',
           'phone' => 'required|unique:users|min:11',
           'addressline' => 'required',
           'town' => 'required',
           'zipcode' => 'required',
           'birth_date' => 'required',
           'gender' => 'required',
           'email' => 'required|email|unique:users',
           'password' => 'required|min:8',     
        ]);
        $adopter = new Adopter();
        $adopter -> fname = $request->fname;
        $adopter -> lname = $request->lname;
        $adopter -> phone = $request->phone;
        $adopter -> addressline = $request->addressline;
        $adopter -> town = $request->town;
        $adopter -> zipcode = $request->zipcode;
        $adopter -> birth_date = $request->birth_date;
        $adopter -> gender = $request->gender;
        $adopter -> email = $request->email;
        // $adopter -> password =  Hash::make($request->password);
        $adopter->save();


         
        return redirect()->back()->with('success','New Adopter added!');      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $adopter= DB::table('adopters')
        ->join('adopted_animals','adopted_animals.adopter_id','=', 'adopters.id')
        ->join('animals','animals.id','=', 'adopted_animals.animal_id')
        ->join('animal_categories' ,'animal_categories.id', '=' , 'animals.category_id') 
       ->where( 'adopters.id',$id) 
       ->Select('adopters.*','animals.*' ,'animal_categories.*')
        
       ->get();  


       return view('adopter.adopter_show',compact('adopter'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $adopters= DB::table('adopters')
        ->where('id',$id)
        ->get();
 
       return view('adopter.adopter_edit',compact('adopters'));
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
        $adopter = Adopter::find($id); 
        $adopter -> fname = $request->fname;
        $adopter -> lname = $request->lname;
        $adopter -> phone = $request->phone;
        $adopter -> addressline = $request->addressline;
        $adopter -> town = $request->town;
        $adopter -> zipcode = $request->zipcode;
        $adopter -> birth_date = $request->birth_date;
        $adopter -> gender = $request->gender;
        $adopter -> email = $request->email;
         $adopter->save();
        return Redirect('adopter')->with('success','Adopter updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $adopter = Adopter::findOrFail($id);
         $adopter->delete();
        return Redirect('adopter')->with('success','Adopter deleted!'); 


    }public function myaccount()
    {
        if(Auth::check() && auth()->user()->role =='adopter')
        {
            $userId=Auth::user();  
            // dd($userId->id);
            $adopters= DB::table('adopters')

            ->join('adopted_animals','adopted_animals.adopter_id','=', 'adopters.id')
            ->join('animals','animals.id','=', 'adopted_animals.animal_id')
            ->join('animal_categories' ,'animal_categories.id', '=' , 'animals.category_id') 
           ->where( 'adopters.email','8') 
           ->Select('adopters.*','animals.*' ,'animal_categories.*')
           ->get();   
           dd($adopters);
           return view('adopter.adopter_account',compact('adopters'));
        }  
    } public function restore($id) 
    {
        Adopter::withTrashed()->where('id',$id)->restore();
        return  Redirect('adopter')->with('success','Adopter restored successfully!');
    }
}

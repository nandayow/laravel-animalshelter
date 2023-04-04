<?php

namespace App\Http\Controllers;
use View;
use Auth;
use Carbon\Carbon;
use DB;
use App\Models\User; 
use App\Models\Personnel; 
use App\Models\Adopter; 
use App\Models\Animal; 
use App\Models\Rescuer; 
use App\Models\Veterinarian;  
use App\Models\AdoptedAnimal;
use Illuminate\Http\Request;
use DataTables;
use App\Charts\NewChart;
 use App\Charts\healthchart;

use App\Charts\adoptedchart;
 class ProfileController extends Controller
{
    public function newindex(Request $request)
    {
        if ($request->ajax()) {

             $data = Animal::with('vets')->whereHas('vets',function($q)
            {
                $profile = Veterinarian::where('user_id',Auth::id())->first();
                $q->where("vet_id","=", $profile->id);
            })->get();  
            
             return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'animal.action')  
                ->rawColumns(['action'])
                ->make(true);
        }
                  $profile = Veterinarian::where('user_id',Auth::id())->first();

        return view('user.vet' ,compact('profile'));
    }

    public function getRescue(Request $request)
    {
        if ($request->ajax()) {

             $data = Animal::with('rescuer')->whereHas('rescuer',function($q)
            {
                $profile = Rescuer::where('user_id',Auth::id())->first();
                $q->where("rescuer_id","=", $profile->id);
            })->get();  
            
             return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'animal.action') 

                ->rawColumns(['action'])
                ->make(true);
        }
                  $profile = Rescuer::where('user_id',Auth::id())->first();

        return view('user.rescuer' ,compact('profile'));
    }
    public function getAdopter(Request $request)
    {
        if ($request->ajax()) {

            
            $data = Animal::with('adopted')->whereHas('adopted',function($q)
            {
                $profile = Adopter::where('user_id',Auth::id())->first();
                $q->where("adopter_id","=", $profile->id);
            })->get();  
           
            return Datatables::of($data)
               ->addIndexColumn()
               ->addColumn('action', function($row){
                   $btn = '<a href="javascript:void(0)" class="edit btn btn-primary">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger">Delete</a>';
                   return $btn;
               })
               ->rawColumns(['action'])
               ->make(true);
       }
                 $profile = Adopter::where('user_id',Auth::id())->first();
                 
                //  dd($profile);

       return view('user.adopter' ,compact('profile')); 
        // $adopteds= Animal::with('adopted') ->get();
        // foreach ($adopteds as $adopted ) {
        //     $date = Carbon::parse($adopted->created_at)->format('Y-m-d');
        //     $time = Carbon::parse($adopted->created_at)->format('H:i');      
        // } 
        // return View::make('user.adopter',compact('date','time','data'));
    }

    public function getAdmin(Request $request)
    {
         $data = User::where('role',"!=",'admin')->get();


        if ($request->ajax()) 
        { 
            return Datatables::of($data) 
               ->addIndexColumn()
               ->addColumn('action', 'admin.action') 
               ->rawColumns(['action'])
               ->make(true);
        }
        $profile = Personnel::where('user_id',Auth::id())->first();  
        
        // $newdata = Animal::with('adopted')->whereHas('adopted',function($q)
        // {
        //      $q->select('adopted_animals.status as request','animals.animal_name')->where("status","=",null); 

        // })->get(); 
           
        // $newdata = DB::table('animals')
        // ->join('adopted_animals' , 'animals.id', '=' ,'adopted_animals.animal_id')
        // ->join('adopters' , 'adopters.id', '=' ,'adopted_animals.adopter_id') 
        // ->where( "animals.isAdopted","=",null) 
        // ->orWhere( "animals.isAdopted","!=",1) 
        // ->Select('adopted_animals.adopter_id as adopter_id' ,'animals.id as myid','animals.*','adopters.*')
        // ->get();
         
         
        $newdata = DB::table('animals') 
            ->join('adopted_animals','adopted_animals.animal_id','=','animals.id') 
            ->join('adopters','adopters.id','=','adopted_animals.adopter_id')  
            ->Select('animals.*','adopted_animals.*','adopters.*')
             ->whereNotNull('adopted_animals.animal_id')
            ->get();

        $count = DB::table('adopted_animals') 
        ->where("status","!=","Approved")  
          ->get();

        $total = count($count);
        //  dd(  $total);

//    dd( $newdata); 
        
        $users = DB::table('animals') 
        ->groupBy('month')
        ->pluck(DB::raw('COUNT(id) as views'),DB::raw('MONTHNAME(created_at) as month'))
        ->all(); 

     $userschart = new NewChart;
     // dd(array_values($customer));
      $dataset = $userschart->labels(array_keys($users));
        // dd($dataset);
        $dataset= $userschart->dataset('Rescued Per Month', 'bar', array_values($users));
        // dd($customerChart);
        $dataset= $dataset->backgroundColor(collect(['#7158e2','#3ae374', '#ff3838',"#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"]));
        // dd($customerChart);
        $userschart->options([
            'responsive' => true,
            'legend' => ['display' => true],
            'tooltips' => ['enabled'=>true],
            // 'maintainAspectRatio' =>true,
            // 'title' => 'test',
            'aspectRatio' => 1,
            'scales' => [
                'yAxes'=> [[
                            'display'=>false,
                            'ticks'=> ['beginAtZero'=> true],
                            'gridLines'=> ['display'=> false],
                          ]],
                'xAxes'=> [[
                            'categoryPercentage'=> 0.8,
                            //'barThickness' => 100,
                            'barPercentage' => 1,
                            'ticks' => ['beginAtZero' => false],
                            'gridLines' => ['display' => false],
                            'display' => true
                          ]],
            ],
        ]);
        
        $adopted_animals = DB::table('adopted_animals') 
        ->groupBy('month')
        ->pluck(DB::raw('COUNT(animal_id) as id'),DB::raw('MONTHNAME(created_at) as month'))
        ->all(); 

     $adoptedchart = new adoptedchart;
     // dd(array_values($customer));
      $dataset = $adoptedchart->labels(array_keys($adopted_animals));
        // dd($dataset);
        $dataset= $adoptedchart->dataset('Adopted Per Month Demographics', 'bar', array_values($adopted_animals));
        // dd($customerChart);
        $dataset= $dataset->backgroundColor(collect(['#7158e2','#3ae374', '#ff3838',"#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"]));
        // dd($customerChart);
        $adoptedchart->options([
            'responsive' => true,
            'legend' => ['display' => true],
            'tooltips' => ['enabled'=>true],
            // 'maintainAspectRatio' =>true,
            // 'title' => 'test',
            'aspectRatio' => 1,
            'scales' => [
                'yAxes'=> [[
                            'display'=>false,
                            'ticks'=> ['beginAtZero'=> true],
                            'gridLines'=> ['display'=> false],
                          ]],
                'xAxes'=> [[
                            'categoryPercentage'=> 0.8,
                            //'barThickness' => 100,
                            'barPercentage' => 1,
                            'ticks' => ['beginAtZero' => false],
                            'gridLines' => ['display' => false],
                            'display' => true
                          ]],
            ],
        ]); 
        $animalhealth= DB::table('animal_healths')
        ->join('animal_medical_conditions' , 'animal_medical_conditions.id', '=' ,'animal_healths.condition_id') 
        ->groupBy('condition_name') 
        ->pluck(DB::raw('count(animal_medical_conditions.condition_name) as health'),'condition_name')
        ->all();

        // dd($animalhealth);
    
 
     $healthchart = new healthchart;
     // dd(array_values($customer));
      $dataset = $healthchart->labels(array_keys($animalhealth));
        // dd($dataset);
        $dataset= $healthchart->dataset('Common Disease and Injury', 'pie', array_values($animalhealth));
        // dd($customerChart);
        $dataset= $dataset->backgroundColor(collect(['#7158e2','#3ae374', '#ff3838',"#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"]));
        // dd($customerChart);
        $healthchart->options([
            'responsive' => true,
            'legend' => ['display' => true],
            'tooltips' => ['enabled'=>true],
            // 'maintainAspectRatio' =>true,
            // 'title' => 'test',
            'aspectRatio' => 1,
            'scales' => [
                'yAxes'=> [[
                            'display'=>false,
                            'ticks'=> ['beginAtZero'=> true],
                            'gridLines'=> ['display'=> false],
                          ]],
                'xAxes'=> [[
                            'categoryPercentage'=> 0.8,
                            //'barThickness' => 100,
                            'barPercentage' => 1,
                            'ticks' => ['beginAtZero' => false],
                            'gridLines' => ['display' => false],
                            'display' => true
                          ]],
            ],
        ]);
         
        return view('admin.dashboard',compact('profile','userschart','adoptedchart','healthchart','newdata','total'));      
    }
    public function edit($id)
    {
        $user=Auth::user();
   

        if(Auth::check() && auth()->user()->role =='veterinarian')
        {
            $profile = Veterinarian::where('user_id',Auth::id())->first();
            return View::make('user.edit',compact('profile'));         
        }

        else if(Auth::check() && auth()->user()->role =='rescuer')
        {
            $profile = Rescuer::where('user_id',Auth::id())->first();
            return View::make('user.edit',compact('profile'));
        } else if(Auth::check() && auth()->user()->role =='adopter')
        {
            $profile = Adopter::where('user_id',Auth::id())->first();
            return View::make('user.edit',compact('profile'));
        }else if(Auth::check() && auth()->user()->role =='employee')
        {
            $profile = Personnel::where('user_id',Auth::id())->first();
            return View::make('user.edit',compact('profile'));
        }else
        {
            $profile = Personnel::where('user_id',Auth::id())->first();
            return View::make('user.edit',compact('profile'));
        }

        
        
    }
    public function update(Request $request, $id)
    {

        $user=Auth::user(); 
        if(Auth::check() && auth()->user()->role =='veterinarian')
        {           
            $profile =Veterinarian::where('user_id',Auth::id())->first();  
            if(empty($request->file('image')))
            {
                $profile->update($request->all());
            }else{
                $name = $request->file('image')->getClientOriginalName();
                $path= $request->file('image')->storeAs('public/images/',$name);
                $profile ->fname = $request->fname;
                $profile ->lname = $request->lname; 
                $profile ->phone = $request->phone;
                $profile ->addressline = $request->addressline;
                $profile ->town = $request->town;
                $profile ->zipcode = $request->zipcode; 
                $profile ->image = $name;
                // dd($profile);
                $profile->save();
            } 
            return redirect()->route('profile')->with('success','Successfully Updated!'); 

         }

        else if(Auth::check() && auth()->user()->role =='rescuer')
        {
            $profile = Rescuer::where('user_id',Auth::id())->first();
 
            if(empty($request->file('image')))
            {
                $profile->update($request->all());
            }else{
                $name = $request->file('image')->getClientOriginalName();
                $path= $request->file('image')->storeAs('public/images/',$name);
                $profile ->fname = $request->fname;
                $profile ->lname = $request->lname; 
                $profile ->phone = $request->phone;
                $profile ->addressline = $request->addressline;
                $profile ->town = $request->town;
                $profile ->zipcode = $request->zipcode; 
                $profile ->image = $name;
                // dd($profile);
                $profile->save();
            } 
            return redirect()->route('profile')->with('success','Successfully Updated!'); 
        }
        else if(Auth::check() && auth()->user()->role =='adopter')
        {
            $profile = Adopter::where('user_id',Auth::id())->first();
 
            if(empty($request->file('image')))
            {
                $profile->update($request->all());
            }else{
                $name = $request->file('image')->getClientOriginalName();
                $path= $request->file('image')->storeAs('public/images/',$name);
                $profile ->fname = $request->fname;
                $profile ->lname = $request->lname; 
                $profile ->phone = $request->phone;
                $profile ->addressline = $request->addressline;
                $profile ->town = $request->town;
                $profile ->zipcode = $request->zipcode; 
                $profile ->image = $name;
                // dd($profile);
                $profile->save();
            } 
            return redirect()->route('profile')->with('success','Successfully Updated!'); 
        }  else if(Auth::check() && auth()->user()->role =='employee')
        {
            $profile = Personnel::where('user_id',Auth::id())->first();
 
            if(empty($request->file('image')))
            {
                $profile->update($request->all());
            }else{
                $name = $request->file('image')->getClientOriginalName();
                $path= $request->file('image')->storeAs('public/images/',$name);
                $profile ->fname = $request->fname;
                $profile ->lname = $request->lname; 
                $profile ->phone = $request->phone;
                $profile ->addressline = $request->addressline;
                $profile ->town = $request->town;
                $profile ->zipcode = $request->zipcode; 
                $profile ->image = $name;
                // dd($profile);
                $profile->save();
            } 
            return redirect()->route('profile')->with('success','Successfully Updated!'); 
        } else  
        {
            $profile = Personnel::where('user_id',Auth::id())->first();
 
            if(empty($request->file('image')))
            {
                $profile->update($request->all());
            }else{
                $name = $request->file('image')->getClientOriginalName();
                $path= $request->file('image')->storeAs('public/images/',$name);
                $profile ->fname = $request->fname;
                $profile ->lname = $request->lname; 
                $profile ->phone = $request->phone;
                $profile ->addressline = $request->addressline;
                $profile ->town = $request->town;
                $profile ->zipcode = $request->zipcode; 
                $profile ->image = $name;
                // dd($profile);
                $profile->save();
            } 
            return redirect()->route('profile')->with('success','Successfully Updated!'); 
        }
    }
   
}

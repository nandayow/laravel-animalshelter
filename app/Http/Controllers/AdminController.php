<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\Personnel;
use App\Models\User; 
use App\Models\Adopter; 
use App\Models\Animal; 
use App\Models\Rescuer; 
use Auth;  
class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');

    }  
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        // dd($rescuer);
        if($user->status !='active')
        {
            $user->status='active'; 
            $user->save();
        }else
        {
            $user->status='deactivated'; 
            $user->save();
        }
      
        
        return redirect()->back()->with('success','Successfully Updated!');
    }
}

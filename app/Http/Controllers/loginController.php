<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use App\Models\Personnel; 
use App\Models\Adopter; 
use App\Models\Animal; 
use App\Models\Rescuer; 
use App\Models\AdoptedAnimal;
use App\Models\Veterinarian; 
use DataTables;
use Auth;

class loginController extends Controller
{
    public function postSignin(Request $request){
        $this->validate($request, [
            'email' => 'email| required',
            'password' => 'required| min:4'
        ]);

    if(auth()->attempt(array('email' => $request->email, 'password' => $request->password)))
        {
            
            if(auth()->check() && (auth()->user()->status =='deactivated')){
                    Auth::logout();

                    $request->session()->invalidate();

                    $request->session()->regenerateToken();

                    return redirect()->route('user.login')->with('error', 'Your Account is suspended, please contact Admin.');

            }
            else if (auth()->user()->role == 'admin') {
                return redirect()->route('admin.profile');
            }   
            else {
                return redirect()->route('profile');
             } 
        }
        else{
            return redirect()->route('personnel.loginnow')
                ->with('error','Email-Address And Password Are Wrong.');
        }
     }

     public function logout() {
        Auth::logout();
        return redirect()->route('home.index');
    }
    public function loginpage()
    {
        if(Auth::check())
        {
            return redirect()->route('home.index'); 
         }else{
            return view('personnel\login_personnel');

         }
    } 
    public function getProfile(){

        $user=Auth::user();


        if(Auth::check() && auth()->user()->role =='veterinarian')
        {
            return redirect()->route('vet.profile'); 
         }

        else if(Auth::check() && auth()->user()->role =='rescuer')
        {
             return redirect()->route('rescuer.profile');
        }
        else if(Auth::check() && auth()->user()->role =='adopter')
        {
            $profile = Auth::user(); 
            if($profile->email_verified_at ==null)
            {
                return view('auth.verify');

            }else
            {
                return redirect()->route('adopter.profile');

            }

        }
        else if(Auth::check() && auth()->user()->role =='employee')
        {
            
            $profile = Personnel::where('user_id',Auth::id())->first(); 
            
            return view('user.employee',compact('profile'));

        }
        else{
            return redirect()->route('admin.profile');

        }

    }

}

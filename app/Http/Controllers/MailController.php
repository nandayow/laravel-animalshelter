<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\EmailMessage;
use App\Models\Email;
use Illuminate\Support\Facades\Mail; 
use Illuminate\Support\facades\DB;
use Illuminate\Support\Facades\Session;
class MailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emails = DB::table('emails')
        ->whereNull('deleted_at')
        ->orderBy('id','desc')
        ->get(); 

        $emailtrash = DB::table('emails')
        ->whereNotNull('deleted_at')
        ->get(); 
        return view('email.email_inbox',compact('emailtrash' , 'emails'));  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('email.email_form');
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
            
             'email' => 'required',
             'body' => 'required',
             'fname' => 'required', 
             'lname' => 'required',
             
              
          ]);

       
        $details =
        [    
            'email' =>$request->email,
            'title'=>'Email From AniShelter Webpage.',
            'body'=> $request->body
        ];
         
        Mail::to("animalshelter2021@gmail.com")->send( new EmailMessage($details));


        $email = new Email();
        $email -> fname = $request->fname;
        $email -> lname = $request->lname; 
        $email -> sender = $request->email;
        $email -> message = $request->body;
        $email -> status = 'Pending';
        $email->save();
        return redirect()->route('home.index')->with('success' ,'Message Sent!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $emails = DB::table('emails')
        ->Where('id',$id) 
        ->get(); 

        $emailtrash = DB::table('emails')
        ->whereNotNull('deleted_at')
        ->get(); 

        return view('email.email_read',compact('emailtrash' , 'emails'));  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $mail = Email::find($id);
        $mail->status = 'Read';
        $mail->save();
        return redirect()->route('email.show',$id);  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        {
            $email = Email::findOrFail($id);
            $email->delete();
            return redirect('email')->with('success','Message deleted!');
        }
    }
    public function restore($id) 
    {
        Email::withTrashed()->where('id',$id)->restore();
        return  redirect('email')->with('success','message restored successfully!');
    }
    public function read(Request $request, $id)
    {
         // $album = Album::find($request->id);
         // dd($request->all());
        
     } 
     static function message()
    { 
       $count = DB::table('emails') 
                 ->where('emails.status','Pending')
                 ->whereNull('deleted_at')
                 ->select('emails.message', DB::raw('count(*) as total')) 
                 ->groupBy('emails.message')
                 ->get();
 
         $total = count($count);
         return ($total); 
 
     }
}

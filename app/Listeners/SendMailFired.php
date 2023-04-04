<?php

namespace App\Listeners;

use App\Events\SendMail;
use App\Models\User;  
use App\Models\Veterinarian;
use App\Models\Animal;  

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Mail;
use App\Mail\EmailMessage;
use App\Mail\EmailVet;

class SendMailFired
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SendMail  $event
     * @return void
     */
    public function handle(SendMail $event)
    { 
         $data =  Animal::orderBy('animals.id', 'desc')->first();   
        //  dd($data);

        $details =
        [          
            'image' =>$data->image,
            'animal_name'=>$data->animal_name,
            'healthstatus'=>$data->healthstatus,
            'gender' =>$data->gender,
           
        ]; 

         $mails =Veterinarian::pluck('email')->toArray();
        foreach ($mails as $mail)
        {
            Mail::to($mail)->send( new EmailVet($details)); 
    
        }; 
    }
}

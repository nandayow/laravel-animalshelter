<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use view;
use Redirect;
use Askedio\Laravel5ProfanityFilter\ProfanityFilter;
use ConsoleTVs\Profanity\Facades\Profanity;

class CommentController extends Controller
{
    public function postComment(Request $req)
    {

        $validated = $req->validate
          ([ 
             'body' => 'required', 
          ]); 
      
       $filter = Profanity::blocker($req->body)->filter();
       
        $comment = new Comment(); 
        $comment->animal_id = $req->animal_id;
        $comment->body = $filter;
    //    dd($comment);
        $comment->save();
       return redirect()->back();   
 } 
}

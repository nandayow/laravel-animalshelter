@extends('layouts.base')
@section('body') 

<div class="container container-email">

    {{ Form::Open(['route' =>'email.store' , 'enctype' => 'multipart/form-data']) }}
      
    <div class="well"> 

    <div class="row">
      <div class="column">
        {{ Form::label('fname' , 'First Name')}}
        {{ Form::text('fname','' , ['class' => 'form-control register-text' ,'id'=>'fname'] )}}
        <span style ="color:red">@error('fname'){{$message}}@enderror</span>

      </div>
      <div class="column">
         {{ Form::label('lname' , 'Last Name')}}
        {{ Form::text('lname','' , ['class' => 'form-control register-text' ,'id'=>'lname'] )}}
        <span style ="color:red">@error('lname'){{$message}}@enderror</span>
      </div>
    </div> 
    <div class="row">
      <div class="column">
      {{ Form::label('email' , 'Email Address')}} 
     {{ Form::email('email', '', ['class' => 'form-control register-text' , "placeholder" => "Enter your email address" ])}}
     <span style ="color:red">@error('email'){{$message}}@enderror</span>
      </div>
      </div> 
    {{ Form::label('body' , 'Subject')}} 
    {{ Form::textarea('body', null, array('class' =>'form-control input', 'placeholder'=>'Write your message here..'))}}
    <span style ="color:red">@error('body'){{$message}}@enderror</span>

    <br>
    <div class="btn-mail ">
      {{ Form::submit('Send' ,['class' => 'btn btn-primary btn-form' ] )}} 
    </div>  
      </div>
    
    {{ Form::Close() }} 

</div>
@endsection
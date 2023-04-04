@extends('layouts.base')
@section('body')
<div class="container login-body-con">
    
    <div class = "login-body">
        <div class = "well log-well ">
            {{ Form::Open(['route' => 'personnel.loginnow']) }}
                <i class="far fa-user-circle login-icon "></i>
                <h2 class="">User Login</h2>
                    <div class="font-login">
                        {{ Form::label('email' , 'Email Address')}}
                        {{ Form::text('email' ,'' , ['class' => 'form-control login-text' , "placeholder" => "Enter your email address"] ) }}
                        <span style ="color:red">@error('email'){{$message}}@enderror</span>
                        <br>        
                        {{ Form::label('password' , 'Password')}}
                        {{ Form::password('password', ['class' => 'form-control' ,  "placeholder" => "Enter your password" ] )}}
                        <span style ="color:red">@error('password'){{$message}}@enderror</span>
                    
                    <div>
                    <br>
                        {{ Form::submit('Login' ,['class' => 'btn btn-primary' ] )}} 
            {{ Form::Close() }}
        </div>
    </div>
    <a href="{{route('personnel.create')}}" role="button"><b>Create new Account</b></a>

             @if(Session::has('error'))
            
             <script>
            swal({
                title: "Warning",
                text: "{!! Session::get('error')!!}",
                icon: "warning",
                button: "Ok",
             });
            </script>

            @endif

            @if(Session::has('success'))
            <script>
                    swal(" " , "{!! Session::get('success')!!}" ,"success",{Button:"ok"}); 
            </script>
            @endif

 </div>
           
@endsection


 


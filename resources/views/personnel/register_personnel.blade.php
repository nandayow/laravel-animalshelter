@extends('layouts.base')
@section('body')

<div class="container register-form">
<div class=" form-reg ">
        <div class="row">

            <div class="column column-adopt1">
            </div>
             
            <div class="column column-adopt2"> 
            {{ Form::Open(['route' => 'personnel.store']) }}
                <h1> Registration Form </h1>
               
            
            <div class="row register-row">
            
                    <div class="column">
                                    
                                    {{ Form::label('fname' , 'First Name')}}
                                    {{ Form::text('fname' ,'' , ['class' => 'form-control register-text' , "placeholder" => "Enter your first name"] ) }}
                                    <span style ="color:red">@error('fname'){{$message}}@enderror</span>

                                    
                                    {{ Form::label('phone' , 'Contact Number')}}
                                    {{ Form::text('phone' ,'' , ['class' => 'form-control register-text' , "placeholder" => "Enter your contact number"] ) }}
                                    <span style ="color:red">@error('phone'){{$message}}@enderror</span>

                                    {{ Form::label('town' , 'Your Town')}}
                                    {{ Form::text('town' ,'' , ['class' => 'form-control  register-text' , "placeholder" => "Enter your town"] ) }}
                                    <span style ="color:red">@error('town'){{$message}}@enderror</span>

                                    {{ Form::label('birth_date' , 'Date of Birth')}}
                                    {{ Form::date('birth_date' ,'' , ['class' => 'form-control register-text' , "placeholder" => "Enter your Birth Date"] ) }}
                                    <span style ="color:red">@error('birth_date'){{$message}}@enderror</span>
                    </div> 

                    <div class="column">
                                    {{ Form::label('lname' , 'Last Name' )}}
                                    {{ Form::text('lname' ,'' , ['class' => 'form-control register-text' , "placeholder" => "Enter your last name"] ) }}
                                    <span style ="color:red">@error('lname'){{$message}}@enderror</span>

                                    {{ Form::label('addressline' , 'Your Address')}}
                                    {{ Form::text('addressline' ,'' , ['class' => 'form-control  register-text' , "placeholder" => "Enter your addressline"] ) }}
                                    <span style ="color:red">@error('addressline'){{$message}}@enderror</span>
                                    
                                

                                    {{ Form::label('zipcode' , 'Your zipcode')}}
                                    {{ Form::text('zipcode' ,'' , ['class' => 'form-control register-text' , "placeholder" => "Enter your zipcode"] ) }}
                                    <span style ="color:red">@error('zipcode'){{$message}}@enderror</span>
                                        

                                    {{ Form::label('role' , 'Role')}}
                                    {{Form::select('role', ['employee' =>'Employee', 'veterinarian' =>'Veterinarian', 'volunteer'=> 'Volunteer', 'adopter'=> 'Adopter', 'rescuer'=> 'Rescuer'], null, ['class' => ' register-text form-control' , "placeholder" => "Select a role..."])}}
                                    <span style ="color:red">@error('role'){{$message}}@enderror</span>
                    </div>  
            </div>
                    <div>
                        <div class = "row register-row">

                                <div class="column">

                                {{ Form::label('email' , 'Email Address')}} 
                                {{ Form::email('email', '', ['class' => 'form-control register-text' , "placeholder" => "Enter your email address" ])}}
                                <span style ="color:red">@error('email'){{$message}}@enderror</span>

                                
                                </div>

                                <div class="column">

                                {{ Form::label('password' , 'Password')}}
                                {{ Form::password('password', ['class' => 'form-control register-text' ,  "placeholder" => "Enter your password" ] )}}
                                <span style ="color:red">@error('password'){{$message}}@enderror</span>
                                    
                                </div>

                        </div>
                        <div class = "row register-row">

                            <div class="column">

                           
                            <div>
                                    <label class="radio-inline">{{ Form::radio('gender','Male' ,true)}}Male</label>
                                    </div>
                                    <div>
                                    <label class="radio-inline"> {{ Form::radio('gender','Female' ,false)}}Female</label>
                                    </div>


                            </div>

                            <div class="column">

                                    {{ Form::submit('Register' ,['class' => 'btn btn-info btn-submit register-text' ] )}}
                                
                            </div>

                            </div>
                    </div>
                 
                    @if(Session::has('success'))
                        <script>
                                swal("Successfully!" , "{!! Session::get('success')!!}" ,"success",{Button:"ok"}); 
                        </script>
                        @endif
                </div>

              
               
        </div>
       
         {{ Form::Close() }}
</div>
</div>
           
@endsection

  

@extends('layouts.base')
@section('body')

<div class="container register-form">
        <div class=" form-reg ">
                <div class="row">

                <div class="column column-adopt1">
                </div>
                
                <div class="column column-adopt2"> 

                @foreach($personnels as $personnel)
                {{ Form::model($personnel,['method'=>'PATCH','route' => ['personnel.update',$personnel->id] ,'enctype' => 'multipart/form-data']) }}
                        <h1> Editing Personnel Information </h1>
                
                
                <div class="row register-row">
                
                        <div class="column">
                                        
                                        {{ Form::label('fname' , 'First Name')}}
                                        {{ Form::text('fname' ,$personnel->fname, ['class' => 'form-control register-text' , "placeholder" => "Enter your first name"] ) }}
                                        <span style ="color:red">@error('fname'){{$message}}@enderror</span>

                                        
                                        {{ Form::label('phone' , 'Contact Number')}}
                                        {{ Form::text('phone' ,$personnel->phone , ['class' => 'form-control register-text' , "placeholder" => "Enter your contact number"] ) }}
                                        <span style ="color:red">@error('phone'){{$message}}@enderror</span>

                                        {{ Form::label('town' , 'Your Town')}}
                                        {{ Form::text('town' ,$personnel->town , ['class' => 'form-control  register-text' , "placeholder" => "Enter your town"] ) }}
                                        <span style ="color:red">@error('town'){{$message}}@enderror</span>

                                        {{ Form::label('birth_date' , 'Date of Birth')}}
                                        {{ Form::date('birth_date' ,$personnel->birth_date , ['class' => 'form-control register-text' , "placeholder" => "Enter your Birth Date"] ) }}
                                        <span style ="color:red">@error('birth_date'){{$message}}@enderror</span>
                        </div> 

                        <div class="column">
                                        {{ Form::label('lname' , 'Last Name' )}}
                                        {{ Form::text('lname' ,$personnel->lname , ['class' => 'form-control register-text' , "placeholder" => "Enter your last name"] ) }}
                                        <span style ="color:red">@error('lname'){{$message}}@enderror</span>

                                        {{ Form::label('addressline' , 'Your Address')}}
                                        {{ Form::text('addressline' ,$personnel->addressline, ['class' => 'form-control  register-text' , "placeholder" => "Enter your addressline"] ) }}
                                        <span style ="color:red">@error('addressline'){{$message}}@enderror</span>
                                        
                                        

                                        {{ Form::label('zipcode' , 'Your zipcode')}}
                                        {{ Form::text('zipcode' ,$personnel->zipcode, ['class' => 'form-control register-text' , "placeholder" => "Enter your zipcode"] ) }}
                                        <span style ="color:red">@error('zipcode'){{$message}}@enderror</span>
                                                

                                        {{ Form::label('role' , 'Role')}}
                                        {{Form::select('role', ['employee' =>'Employee', 'veterinarian' =>'Veterinarian', 'volunteer'=> 'Volunteer'], null, ['class' => ' register-text form-control' , "value" => $personnel->role])}}
                                        <span style ="color:red">@error('role'){{$message}}@enderror</span>
                        </div>  
                </div>
                        <div>
                                <div class = "row register-row">

                                        <div class="column">

                                        {{ Form::label('email' , 'Email Address')}} 
                                        {{ Form::email('email',$personnel->email, ['class' => 'form-control register-text' , "placeholder" => "Enter your email address" ])}}
                                        <span style ="color:red">@error('email'){{$message}}@enderror</span>

                                        
                                        </div> 
                                </div>
                                <div class = "row register-row"> 
                                <div class="column">  
                                        @if($personnel->gender =="male" || $personnel->gender =="Male")
                                        <div>
                                        <label class="radio-inline">{{ Form::checkbox('gender','Male' ,true)}}Male</label>
                                        </div>
                                        <div>
                                        <label class="radio-inline"> {{ Form::checkbox('gender','Female' ,false)}}Female</label>
                                        </div>
                                        @else
                                        <div>
                                        <label class="radio-inline">{{ Form::checkbox('gender','Male' ,false)}}Male</label>
                                        </div>
                                        <div>
                                        <label class="radio-inline"> {{ Form::checkbox('gender','Female' ,true)}}Female</label>
                                        </div>

                                        @endif
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
        @endforeach
                {{ Form::Close() }}
        </div>
</div>
           
@endsection

  

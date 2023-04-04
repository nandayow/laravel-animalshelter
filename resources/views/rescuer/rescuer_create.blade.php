@extends('layouts.base')
@section('body')

<div class="container register-form">
<div class=" form-reg ">
        <div class="row">

            <div class="column column-adopt1">
            </div>
             
            <div class="column column-adopt2"> 
            {{ Form::Open(['route' => 'rescuer.store']) }}
                <h1>Rescuer Form </h1>
               
            
            <div class="row register-row">
            
                    <div class="column">
                                    
                                    {{ Form::label('fname' , 'First Name')}}
                                    {{ Form::text('fname' ,'' , ['class' => 'form-control register-text' , "placeholder" => "Enter your first name"] ) }}
                                    <span style ="color:red">@error('fname'){{$message}}@enderror</span>

                                    {{ Form::label('lname' , 'Last Name' )}}
                                    {{ Form::text('lname' ,'' , ['class' => 'form-control register-text' , "placeholder" => "Enter your last name"] ) }}
                                    <span style ="color:red">@error('lname'){{$message}}@enderror</span>
                                    
                                    {{ Form::label('phone' , 'Contact Number')}}
                                    {{ Form::text('phone' ,'' , ['class' => 'form-control register-text' , "placeholder" => "Enter your contact number"] ) }}
                                    <span style ="color:red">@error('phone'){{$message}}@enderror</span>
 
                    </div> 

                    <div class="column">
                                   

                                    {{ Form::label('addressline' , 'Your Address')}}
                                    {{ Form::text('addressline' ,'' , ['class' => 'form-control  register-text' , "placeholder" => "Enter your addressline"] ) }}
                                    <span style ="color:red">@error('addressline'){{$message}}@enderror</span>
                                    
                                    
                                    {{ Form::label('town' , 'Your Town')}}
                                    {{ Form::text('town' ,'' , ['class' => 'form-control  register-text' , "placeholder" => "Enter your town"] ) }}
                                    <span style ="color:red">@error('town'){{$message}}@enderror</span> 

                                    {{ Form::label('zipcode' , 'Your zipcode')}}
                                    {{ Form::text('zipcode' ,'' , ['class' => 'form-control register-text' , "placeholder" => "Enter your zipcode"] ) }}
                                    <span style ="color:red">@error('zipcode'){{$message}}@enderror</span>
                                  
                    </div>  
            </div>
                    <div>
                         
                    </div>
                    {{ Form::submit('Submit' ,['class' => 'btn btn-info btn-submit' ] )}}
                    <br>
                    <br>

                    @if(Session::has('success'))
                        <script>
                                swal("Successfully  !" , "{!! Session::get('success')!!}" ,"success",{Button:"ok"}); 
                        </script>
                        @endif
                        <a class="  prev btn btn-primary" style="width:100px" role="button" href="{{route('rescuer.index')}}"><b>Existing</b></a><br>

                </div> 
        </div>
       
         {{ Form::Close() }}
</div>
</div>
           
@endsection

 
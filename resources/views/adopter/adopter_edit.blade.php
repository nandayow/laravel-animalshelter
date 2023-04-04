@extends('layouts.base')
@section('body')
 
<div class="container well myaccount-form">
    <div class="row">
        <div class="col-md-4 edit-class">
            <div class=""> 
                <img class="edit-image" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRFUgYuemV7b3RJ9bnFxeVfAtlxYXl9SG-G4B5g3Y0uRlE8JjKBy0F98p8Fd7bV1eRCclI&usqp=CAU" width="200" height="200" />
                <div class="edit"> 
                </div> 
                @foreach ($adopters as $adopter) 
                <h4>{{$adopter->fname}} {{$adopter->lname}}</h4>
                <h4>{{$adopter->email}}</h4> 
             </div>
        </div>
        <div class="col-md-8">  
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                     </div>
                    
                </div>
                <div class="row mt-2">
                    <div class="col-md-6">
                    {{ Form::model($adopter,['method'=>'PATCH','route' => ['adopter.update',$adopter->id]]) }}
                    <h6>Firstname<h6> 
                    {{ Form::text('fname',$adopter ->fname,array('class' => 'form-control')) }}
                    <h6>Phone<h6>
                    {{ Form::text('phone',$adopter ->phone,array('class' => 'form-control')) }}
                    </div>
                    <div class="col-md-6"> 
                    <h6>Lastname<h6> 
                    {{ Form::text('lname',$adopter ->lname,array('class' => 'form-control')) }} 
                    <h6>Addressline<h6> 
                    {{ Form::text('addressline',$adopter->addressline,array('class' => 'form-control')) }}
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                    
                    <h6>Town<h6>  
                    {{ Form::text('town',$adopter->town,array('class' => 'form-control')) }}
                    </div>
                    <div class="col-md-6">
                    <h6>Zipcode<h6> 
                    {{ Form::text('zipcode',$adopter ->zipcode,array('class' => 'form-control')) }}

                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                    <h6>BirthDate<h6> 
                    {{ Form::text('birth_date',$adopter->birth_date,array('class' => 'form-control')) }}
                    <h6>Email <h6>
                    {{ Form::email('email',$adopter ->email,array('class' => 'form-control')) }}
                    </div>
                    <div class="col-md-6">      
                    @if($adopter->gender =="male" || $adopter->gender =="Male")
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
                     <h6>Password<h6> 
                    {{ Form::password('password', ['class' => 'form-control  ' ,  "placeholder" => "Enter your password" ] )}}
                    <br>
                    {{ Form::submit('Update' ,['class' => 'btn btn-success ' ] )}} 
                    
                     {{ Form::Close() }}
                    </div>
                </div> 
            </div>
        </div> 
        @endforeach
    </div>
</div>
 
@endsection

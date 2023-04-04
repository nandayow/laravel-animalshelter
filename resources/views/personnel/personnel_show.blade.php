@extends('layouts.base')
@section('body')
 
<div class="container well myaccount-form">
    <div class="row">
        <div class="col-md-4 edit-class">
            <div class=""> 
                <img class="edit-image" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRFUgYuemV7b3RJ9bnFxeVfAtlxYXl9SG-G4B5g3Y0uRlE8JjKBy0F98p8Fd7bV1eRCclI&usqp=CAU" width="200" height="200" />
                <div class="edit">
             
                </div>
              
               
                <h4>{{$personnels->fname}} {{$personnels->lname}}</h4> 
                <h4>{{$personnels->email}}</h4>
                
          
            
             </div>
        </div>
        <div class="col-md-8">  
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                <a class = "fa fa-long-arrow-left"   href = "{{route('personnel.index') }}">Back</a>
                     </div>
                    
                </div>
                <div class="row mt-2">
                    <div class="col-md-6">
                    <h6>Phone<h6>
                    
                    {{ Form::text('phone',$personnels->phone,array('class' => 'form-control')) }}

                    <h6>Role<h6> 
                    {{ Form::text('birth_date',$personnels->role,array('class' => 'form-control')) }}
                    <h6>Birthdate<h6> 
                    {{ Form::text('birth_date',$personnels->birth_date,array('class' => 'form-control')) }}
                    <h6>Created_at<h6> 
                    {{ Form::text('birth_date',$personnels->created_at,array('class' => 'form-control')) }}
                    </div>
                    <div class="col-md-6">  
                    <h6>Addressline<h6> 
                    {{ Form::text('addressline',$personnels->addressline,array('class' => 'form-control')) }}
                    <h6>Town<h6>  
                    {{ Form::text('town',$personnels->town,array('class' => 'form-control')) }}
                    <h6>Zipcode<h6> 
                    {{ Form::text('zipcode',$personnels->zipcode,array('class' => 'form-control')) }}
                    <h6>Gender<h6> 
                    {{ Form::text('birth_date',$personnels->gender,array('class' => 'form-control')) }}

                   

                   
                    </div>
                    
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                 
                    </div>
                    <div class="col-md-6">
                   
                   

                    </div>
                </div>
                 
            </div>
        </div> 
    

    </div>
</div> 
 
@endsection

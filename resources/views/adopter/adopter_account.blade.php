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
                
                @endforeach
                
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
                    <h6>Phone<h6>
                    
                    {{ Form::text('phone',$adopter->phone,array('class' => 'form-control')) }}
                    </div>
                    <div class="col-md-6">  
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
                    {{ Form::text('zipcode',$adopter->zipcode,array('class' => 'form-control')) }}

                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                    <h6>BirthDate<h6> 
                    {{ Form::text('birth_date',$adopter->birth_date,array('class' => 'form-control')) }}

                    </div>
                    <div class="col-md-6">      
                    <h6>Gender<h6> 
                    {{ Form::text('gender',$adopter->gender,array('class' => 'form-control')) }}

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

<div class="container well myaccount-form"> 
    <div class="tab">
    <button class="tablinks" onclick="openCity(event, 'animal')">Adopted Animal</button>
 
    </div>


    <div id="animal" class="tabcontent">
      
       
        <br>
        <div  class="table-responsive ">
        <table class="table table-striped table-hover rescuer-table" >
                
                <thead>
                    <tr>
                        <th >Name</th> 
                        <th>Type</th>
                        <th>Breed</th>
                        <th>image</th>
                         
                    </tr>
                </thead>

                <tbody>
                @foreach ($adopters as $adopter)
              
                    <tr>  
                        <td>{{$adopter->animal_name}}</td>
                        <td>{{$adopter->animal_type}} </td> 
                        <td>{{$adopter->breed_name}} </td> 
                        <td> <img  class="table-img" src="{{asset( '/storage/public/images//'.$adopter->image)}}"></td>

                    </tr>
                 

               @endforeach

                </tbody>
        </table>
    </div>
        
    </div>  
</div>
 
 
@endsection

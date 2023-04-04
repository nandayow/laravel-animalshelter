@extends('layouts.base')
@section('body')
 
<div class="container well myaccount-form">
    <div class="row">
        <div class="col-md-4 edit-class">
            <div class=""> 
                <img class="edit-image" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRFUgYuemV7b3RJ9bnFxeVfAtlxYXl9SG-G4B5g3Y0uRlE8JjKBy0F98p8Fd7bV1eRCclI&usqp=CAU" width="200" height="200" />
                <div class="edit">
             
                </div>
              
               
                <h4>{{$rescuers[0]->fname}} {{$rescuers[0]->lname}}</h4> 
                
          
            
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
                    
                    {{ Form::text('phone',$rescuers[0]->phone,array('class' => 'form-control')) }}
                    </div>
                    <div class="col-md-6">  
                    <h6>Addressline<h6> 
                    {{ Form::text('addressline',$rescuers[0]->addressline,array('class' => 'form-control')) }}
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                    <h6>Town<h6>  
                    {{ Form::text('town',$rescuers[0]->town,array('class' => 'form-control')) }}
                    </div>
                    <div class="col-md-6">
                    <h6>Zipcode<h6> 
                    {{ Form::text('zipcode',$rescuers[0]->zipcode,array('class' => 'form-control')) }}

                    </div>
                </div>
                 
            </div>
        </div> 
    

    </div>
</div>

<div class="container well myaccount-form"> 
    <div class="">
    <button class="tablinks" onclick="openCity(event, 'animal')">Rescued Animal</button>
 
    </div>


    <div id="animal" class=" "> 
        <br>
        <div  class="table-responsive ">
        <table class="table table-striped table-hover rescuer-table" >
                
                <thead>
                    <tr>
                        <th >Name</th> 
                        <th>Type</th>
                        <th>Status</th>
                        <th>Breed</th>
                        <th>image</th>
                         
                    </tr>
                </thead>

                <tbody>
                @foreach ($rescuers as $rescuer)
              
                    <tr>  
                        <td>{{$rescuer->animal_name}}</td>
                        <td>{{$rescuer->animal_type}} </td> 
                        <td>{{$rescuer->healthstatus}} </td> 
                        <td>{{$rescuer->breed_name}} </td> 
                        <td> <img  class="table-img" src="{{asset( '/storage/public/images//'.$rescuer->image)}}"></td>

                    </tr>
                 

               @endforeach

                </tbody>
        </table>
    </div>
        
    </div>  
</div>
 
 
@endsection

@extends('layouts.base')
@section('body')
 
<div class="container well">
    <div class="row">
        <div class="col-md-4 edit-class">
            <div class=""> 
                <img class="edit-image" src="{{asset( '/storage/public/images//'.$animalid->image)}}" width="200" height="200" />
                <div class="edit">
             
                </div>
                <h4>{{$animalid->animal_name}}</h4>
                @foreach ($animal as $animals)
                <h4>{{$animals->breed_name}}</h4>
                @endforeach
                 
             </div>
        </div>
        <div class="col-md-8">  
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                <a class = "fa fa-long-arrow-left"   href = "{{route('animal.index') }}">Back</a>
                    </div>
                   
                </div>
                <div class="row mt-2">
                    <div class="col-md-6">
                    <h6>Animal Name<h6>
                    
                    {{ Form::text('animal_name',$animalid->animal_name,array('class' => 'form-control')) }}
                    </div>
                    <div class="col-md-6"> 
                    <h6>Animal Gender<h6>
                    {{ Form::text('gender',$animalid->gender,array('class' => 'form-control')) }}

                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">  
                     <h6>Rescuer<h6>{{ Form::text('rescuer_id',$animalid->rescuer_id ,array('class' => 'form-control')) }}
                    </div>
                    <div class="col-md-6">
                    <h6>HealthStatus<h6>{{ Form::text('healthstatus',$animalid->healthstatus,array('class' => 'form-control')) }}
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                    <h6>Approx. Age</h6>{{ Form::text('approximate_age',$animalid->approximate_age,array('class' => 'form-control')) }}
                    </div>
                    <div class="col-md-6">      
                    <h6>Category<h6>{{ Form::text('category_id',$animals->animal_type,array('class' => 'form-control')) }}
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                    <h5>Rescued_Date</h5> {{ Form::text('rescued_date',$animalid->rescued_date ,array('class' => 'form-control')) }}
                    </div>
                    <div class="col-md-6">
                    <h5>Created_at</h5> {{ Form::text('created_at',$animalid->created_at ,array('class' => 'form-control')) }}
                  </div>
                </div>
                @if(Session::has('success'))
            <script>
                    swal(" " , "{!! Session::get('success')!!}" ,"success",{Button:"ok"}); 
            </script>
            @endif

            </div>
        </div> 
    

    </div>
</div>
 
<div class="container well"> 
    <div class="tab">
    <button class="tablinks" onclick="openCity(event, 'rescuer')">Rescuer Info</button>
    <button class="tablinks" onclick="openCity(event, 'animalhealth')">Animal Health</button>
    <button class="tablinks" onclick="openCity(event, 'adopter')">Adopter</button>
    </div>
  
    <div id="rescuer" class="tabcontent">
        
            <br><br>
     
        <div  class="table-responsive ">
            <table class="table table-striped table-hover rescuer-table" >
                    
                    <thead>
                        <tr>
                            <th >First Name</th> 
                            <th >Last Name</th> 
                            <th>Phone Number</th>
                            <th >Addressline</th> 
                            <th >Town</th> 
                            <th>ZipCode</th>
                            
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($animal as $animalrescue)
                        <tr>  
                            <td>{{$animalrescue->fname}}</td>
                            <td>{{$animalrescue->lname}}</td> 
                            <td>{{$animalrescue->phone}}</td>
                            <td>{{$animalrescue->addressline}}</td> 
                            <td>{{$animalrescue->town}}</td>
                            <td>{{$animalrescue->zipcode}}</td> 
                        </tr>
                        @endforeach
                    </tbody>
            </table>
        </div>
      
    </div>
     
 
    <div id="animalhealth" class="tabcontent">
        <h4>Status:{{$animalid->healthstatus}}</h4> 
       
        <br>
        <div  class="table-responsive ">
        <table class="table table-striped table-hover rescuer-table" >
                
                <thead>
                    <tr>
                        <th >Condition Name</th> 
                        <th>Condition Type</th>
                         
                    </tr>
                </thead>

                <tbody>
                    @foreach($animalhealth as $animal)
                    <tr>  
                        <td>{{$animal->condition_name}}</td>
                        <td>{{$animal->condition_type}}</td> 
                    </tr>
                    @endforeach
                </tbody>
        </table>
    </div>
        
    </div> 
     
    <div id="adopter" class="tabcontent">
    @foreach($adopters as $adopter)
    <h4> Email Add: {{$adopter->email}}</h4>
    <br>
    <div  class="table-responsive ">
            <table class="table table-striped table-hover rescuer-table" >
                    
                    <thead>
                        <tr>
                            <th >First Name</th> 
                            <th >Last Name</th> 
                            <th>Phone Number</th>
                            <th >Addressline</th> 
                            <th >Town</th> 
                            <th>ZipCode</th>
                            <th>BirthDate</th>
                            <th>Gender</th> 
                        </tr>
                    </thead>

                    <tbody>
                       
                        <tr>  
                            <td>{{$adopter->fname}}</td>
                            <td>{{$adopter->lname}}</td> 
                            <td>{{$adopter->phone}}</td>
                            <td>{{$adopter->addressline}}</td> 
                            <td>{{$adopter->town}}</td>
                            <td>{{$adopter->zipcode}}</td> 
                            <td>{{$adopter->birth_date}}</td>  
                            <td>{{$adopter->gender}}</td> 
                        </tr>
                        @endforeach
                    </tbody>
            </table>
        </div>
    </div>
</div>


<script>
function openCity(evt, cityName) {
  // Declare all variables
  var i, tabcontent, tablinks;

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  // Show the current tab, and add an "active" class to the link that opened the tab
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>
 
@endsection

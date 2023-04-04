@extends('layouts.base')
@section('body')
 
<div class="container well">
    <div class="row">
        <div class="col-md-4 edit-class">
            <div class=""> 
                <img class="edit-image" src="{{asset( '/storage/public/images//'.$animalid->image)}}" width="200" height="200" />
                <div class="edit">
                {{ Form::model($animalid,['method'=>'PATCH','route' => ['animal.update',$animalid->id] ,'enctype' => 'multipart/form-data']) }}
                {{ Form::File('image', ['class'=> ' edit-file', 'id'=>'image'] )}} 
                </div>
                <h4>{{$animalid->animal_name}}</h4>
                @foreach ($animal as $animals)
                <h4>{{$animals->breed_name}}</h4>
                @endforeach
                {{ Form::submit('Update' ,['class' => 'btn btn-danger btn-submit' ] )}} 
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
                    <h6>HealthStatus<h6> 
                            @if($animalid->healthstatus !=="Cured")
                                      <div>
                                    <label class="radio-inline">{{ Form::radio('healthstatus','Cured' ,false)}}Cured</label>
                                    </div>
                                    <br>
                                    <div>
                                    <label class="radio-inline"> {{ Form::radio('healthstatus','Not Cured' ,true)}}Not Cured</label>
                                    </div>
                                    </div>
                                  
                            @else
                                      <div>
                                    <label class="radio-inline">{{ Form::radio('healthstatus','Cured' ,true)}}Cured</label>
                                    </div>
                                    <br>
                                    <div>
                                    <label class="radio-inline"> {{ Form::radio('healthstatus','Not Cured' ,false)}}Not Cured</label>
                                    </div>
                                      </div>

                    @endif

                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                    <h6>Approx. Age</h6>{{ Form::text('approximate_age',$animalid->approximate_age,array('class' => 'form-control')) }}
                    </div>
                    <div class="col-md-6">      
                    <h6>Category<h6>{{ Form::select('category_id',$animal_breed,null,['class' => 'form-control input-large']) }}
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
    <a class="tablinks btn btn-ah" onclick="openCity(event, 'rescuer')">Rescuer Info</a>
    <a class="tablinks btn btn-ah" onclick="openCity(event, 'animalhealth')">Animal Health</a>
    <a class="tablinks btn btn-ah " onclick="openCity(event, 'adopter')">Adopter</a>
</div>

<div id="animalhealth" class="tabcontent">
     <h4>Status:{{$animalid->healthstatus}}</h4> 
    
     <br>
     <div class="row">   
     <div class="column diseasecol">
             @foreach ($animalcondition as $condition_id =>$condition) 
            
             @if(in_array($condition_id,$animalhealth))

             <div class=" form-horizontal checkbox">
                 <label>
                 {{ Form::checkbox('condition_id[]',$condition_id,true,['class' => 'create-cmb'])}}{{$condition}}
                 </label>
             </div> 
             @endif 
             @endforeach  
  </div>

  <div class="column diseasecol">
             @foreach ($animalcondition as $condition_id =>$condition) 
            
             @if(in_array($condition_id,$animalhealth))

             
             @else
             <div class=" form-horizontal checkbox">
                 <label>
                 {{ Form::checkbox('condition_id[]',$condition_id,false,['class' => 'create-cmb'])}}{{$condition}}
                 </label>
             </div>
             @endif 
             @endforeach  
  </div>
           
     </div> 
  </div> 
   {{ Form::Close() }}  
    {{ Form::model($animalid,['method'=>'PATCH','route' => ['rescuer.update',$animalid->rescuer_id]]) }}
    <div id="rescuer" class="tabcontent">

    <div class="row">
    @foreach ($animal as $animalrescue) 
            <div class="column rcol-1"> 
                
                <h6>First Name</h6>
                {{ Form::text('fname',$animalrescue->fname,array('class' => 'form-control')) }} 
                <h6>Addressline</h6>
                {{ Form::text('addressline',$animalrescue->addressline,array('class' => 'form-control')) }}
                <h6>ZipCode</h6>
                {{ Form::text('zipcode',$animalrescue->zipcode,array('class' => 'form-control')) }}
            </div>
            <div class="column rcol-1">
                <h6>Last Name</h6>
                {{ Form::text('lname',$animalrescue->lname,array('class' => 'form-control')) }}
                <h6>Phone Number</h6>
                {{ Form::text('phone',$animalrescue->phone,array('class' => 'form-control')) }}
                <h6>Town</h6>
                {{ Form::text('town',$animalrescue->town,array('class' => 'form-control')) }}
                <br>
                {{ Form::submit('Update' ,['class' => 'btn btn-success btn-submit' ] )}} 
            </div>
        @endforeach
        </div> 
    </div>
    {{ Form::Close() }}
  
    <div id="adopter" class="tabcontent"> 
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

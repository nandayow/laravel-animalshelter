@extends('layouts.base')
@section('body')
 
<div class="container  container-createanimal"> 
    <div class="catitle">
    <h2 class="fas fa-paw">Creating Animal Form</h2> 
    </div> 
{{ Form::Open(['route' =>'animal.store' , 'enctype' => 'multipart/form-data']) }}
    <div class="container  well container-createanimal1">    
        <div class="row">
        <div class="column diseasecol1">
                   
                     {{ Form::hidden('rescuer_id',$data->id , ['class' => 'form-control register-text' ,'id'=>'animal_name'] )}}
                     {{ Form::label('animal_name' , 'Animal Name')}}
                     {{ Form::text('animal_name','' , ['class' => 'form-control register-text' ,'id'=>'animal_name'] )}}
                     <span style ="color:red">@error('animal_name'){{$message}}@enderror</span>
                    
                     {{ Form::label('approximate_age' , 'Approximate Age')}}
                     {{ Form::text('approximate_age','' , ['class' => ' register-text form-control' ,'id'=>'approximate_age'] )}}
                     <span style ="color:red">@error('approximate_age'){{$message}}@enderror</span>

                     <div>
                        <label class="radio-inline">{{ Form::radio('gender','Male' ,true)}}Male</label>
                     </div>
                    <div>
                        <label class="radio-inline"> {{ Form::radio('gender','Female' ,false)}}Female</label>
                     </div>
                      <span style ="color:red">@error('gender'){{$message}}@enderror</span>


        </div>   
        <div class="column diseasecol1">

                   {{ Form::label('image' , 'Animal Image')}}
                     {{ Form::File('image', ['class' => 'form-control register-text' ,'id'=>'image'] )}}
                   <span style ="color:red">@error('image'){{$message}}@enderror</span> 

                   {{ Form::label('rescued_date	' , 'Date of Rescue')}}
                    {{ Form::date('rescued_date',\Carbon\Carbon::now(),['class' => 'form-control  register-text ' , 'id'=>'rescued_date']) }}
                    <span style ="color:red">@error('rescued_date'){{$message}}@enderror</span>
 
                    {{ Form::label('animal_breed	' , 'Animal Category')}} <a href="{{route('animalbreed.create')}}" class="createanimal-text" role="button"><i>Add if not exist</i></a>

                    {{ Form::select('animal_breed',$animal_breed,null,['class' => 'form-control register-text']) }}
                 
        </div>   
        </div>   
    </div>

    <div class="container  well container-createanimal1">
    <div class="row"> 
        <div class="column diseasecol ">
        <h4 class="diseasecoltitle">Diseases</h4>
        @foreach($animal_medical_condition as $animalcondition)  
                 
             
                <div class="checkbox form-horizontal">
                    <label>
                    {{ Form::checkbox('condition_id[]',$animalcondition->condition_id ,false,['class' => 'create-cmb'])}}{{$animalcondition->condition_name}}
                    </label>
                </div>
          

      
         @endforeach   
        </div>  
        <div class="column diseasecol">
        <h4 class="diseasecoltitle">Injuries</h4>
        @foreach($animal_medical_condition1 as $animalcondition1)    
                
             
                <div class=" form-horizontal checkbox">
                    <label>
                    {{ Form::checkbox('condition_id[]',$animalcondition1->condition_id ,false,['class' => 'create-cmb'])}}{{$animalcondition1->condition_name}}
                    </label>
                </div>
         
            
        
         @endforeach  
        </div> 
        </div>  
        {{ Form::submit('Submit' ,['class' => 'btn btn-danger btn1-ca' ] )}} 
    </div> 
    {{ Form::Close() }}
           @if(Session::has('success'))
            <script>
                    swal("Successfully!" , "{!! Session::get('success')!!}" ,"success",{Button:"ok"}); 
            </script>
            @endif

</div>     
@endsection

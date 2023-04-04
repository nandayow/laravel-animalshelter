@extends('layouts.base')
@section('body')
<div class="container breed-create-body ">
    <div class = "well breed-widenew">
        <div class = "well "> 

            <div class="breed-wellnew ">
            <h2 class="fas fa-paw header-title breedtitle"> Breed and Type of Animal</h2>
            </div>

            <div class="breed-wellnew1 ">
            {{ Form::Open(['route' => 'animalbreed.store']) }}

                {{ Form::label('breed_name' , 'Breed Name')}}
                {{ Form::text('breed_name' ,'' , ['class' => 'form-control' ] ) }}
                <span style ="color:red">@error('breed_name'){{$message}}@enderror</span>
                <br>
                <br>
                <div>
                       <label class="radio-inline">{{ Form::radio('animal_type','Dog' ,true)}}Dog</label>
                 </div>
                   <div>
                          <label class="radio-inline"> {{ Form::radio('animal_type','Cat' ,false)}}Cat</label>
                   </div>
                <span style ="color:red">@error('animal_type'){{$message}}@enderror</span>
                <br>
                {{ Form::submit('Submit' ,['class' => 'btn btn-success '  ] )}}
       
            {{ Form::Close() }}
                 </div>
        </div>

        @if(Session::has('success'))
            <script>
                    swal("Created Successfully!" , "{!! Session::get('success')!!}" ,"success",{Button:"ok"}); 
            </script>
            @endif
    </div>
 </div>
@endsection


 


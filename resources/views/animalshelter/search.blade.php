@extends('layouts.base')
@section('body')

<div class ="container well">

    <div class = " ">
        <a href="">Filter</a>
        <h3>Results</h3> 
    </div>              @if(!empty($animals))
                        @foreach($animals as $animal) 
                             <div class="card trending-item">
                                  <div class="trending-card"> 
                                    <img  class="display-dog" src="{{asset( '/storage/public/images//'.$animal->image)}}"> 
                                        <h1>{{$animal->animal_name}}</h1>
                                         <p class="title">{{$animal->breed_name}}</p>
                                              <p>{{$animal->animal_type}}</p> 
                                                 <p>Adoptable</p> 
                                                   <a href="{{route('animal.show',$animal->animalid)}}"> View Profile  </a> 
                                                 
                                                 {{ Form::Open(['route' =>'adopted.store']) }}
                                                 {{ Form::hidden('animal_id',$animal->id ) }}
                                                 {{ Form::submit('Adopt Now',['class' => 'btn btn-danger btn-submit' ] )}} 
                                                  {{ Form::Close() }}
                                        </div>
                                    </div>                   
                        @endforeach  
                        @endif   
                        @foreach($animals1 as $animal1) 
                             <div class="card trending-item">
                                  <div class="trending-card"> 
                                    <img  class="display-dog" src="{{asset( '/storage/public/images//'.$animal1->image)}}"> 
                                        <h1>{{$animal1->animal_name}}</h1>
                                         <p class="title">{{$animal1->breed_name}}</p>
                                              <p>{{$animal1->animal_type}}</p> 
                                                 <p>Adoptable</p> 
                                                   <a href="{{route('animal.show',$animal1->animalid)}}"> View Profile  </a> 
                                                 
                                                 {{ Form::Open(['route' =>'adopted.store']) }}
                                                 {{ Form::hidden('animal_id',$animal1->id ) }}
                                                 {{ Form::submit('Adopt Now',['class' => 'btn btn-danger btn-submit' ] )}} 
                                                  {{ Form::Close() }}
                                        </div>
                                    </div> 
                                       
                        @endforeach  
</div>

@endsection
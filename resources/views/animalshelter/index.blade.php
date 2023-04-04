@extends('layouts.base')
@section('body')

@if (empty($animals))
<h1>No Animal Available</h1>
@else
<div class ="custom-animal">
 
<div id="mycarousel" class="carousel slide" data-ride="carousel">
    
    <div class="carousel-inner" role="listbox">

        @foreach($animals as $animal)

            <div class="item">

            <img  class="slider-img img-circle " , src="{{asset( '/storage/public/images//'.$animal->image)}}">
            
            <div class="carousel-caption slide-text">
                  <h3>{{$animal->animal_name}}</h3>
                  <p>{{$animal->breed_name}}</p>
            </div>
            </div> 
        @endforeach

    </div>


    <a class="left carousel-control" href="#mycarousel" role="button" data-slide="prev">

        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>

        <span class="sr-only">Previous</span>

    </a>
    <a class="right carousel-control" href="#mycarousel" role="button" data-slide="next">

        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>

        <span class="sr-only">Next</span>

    </a>
</div>
         <div class ="container trending-wrapper ">
           <div class="row">
                    <div class="col-sm-8  left-col">
                        @foreach($animals as $animal) 
                                    <div class="card trending-item">
                                         <div class="trending-card">
                                       
                                             <img  class="display-dog" src="{{asset( '/storage/public/images//'.$animal->image)}}"   >
                                                
                                                 <h1>{{$animal->animal_name}}</h1>
                                                    <p class="title">{{$animal->breed_name}}</p>
                                                        <p>{{$animal->animal_type}}</p> 
                                                        <p>Adoptable</p> 
                                                       <p><button class="class-button"> <a href= "{{route('animalshow',$animal->id)}}"> View Profile  </a></button></p>
                                                       {{ Form::Open(['route' =>'adopted.store']) }}

                                                       {{ Form::hidden('animal_id',$animal->id ) }}
                                                       {{ Form::submit('Adopt Now' ,['class' => 'btn btn-danger btn-submit' ] )}} 
                                                       {{ Form::Close() }}
                                        </div>
                                    </div>                   
                        @endforeach      
                   </div> 
                    <div class="col-sm-3 right-col">
                        <div class="sidevar-back"> 
                               
                        
                         
                        </div>

                        <div class="row social-icon">
                                    <div class="column"> <a href="#"><i class="fa fa-dribbble"></i></a></div>
                                    <div class="column"><a href="#"><i class="fa fa-twitter"></i></a></div>
                                    <div class="column"><a href="#"><i class="fa fa-facebook"></i></a></div>
                                    <div class="column">  <a href="#"><i class="fa fa-linkedin"></i></a></div>
                     </div>
                     <div>
                     <a class="btn btn-primary " href="{{route('email.create')}}">Message Us!!   <i class=" far fa-envelope-open"></i></a> 
                     </div>
            </div>
         
       </div>

            @if(Session::has('success'))
            <script>
                    swal("Successfully!" , "{!! Session::get('success')!!}" ,"success",{Button:"ok"}); 
            </script>
            @endif

            
            @if(Session::has('error'))
            <script>
            swal({
                title: "Permission Denied",
                text: "{!! Session::get('error')!!}",
                icon: "warning",
                button: "Ok",
             });
            </script>
            @endif
  
</div>
<script>
        document.querySelector('.carousel-inner > div:first-child').classList.add('active');
</script>
@endif
@endsection
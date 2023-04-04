@extends('layouts.base')
@section('body')

<div class="container container-class">

        <div class="container well reg-class">

            <header class="class-header">Animal Disease and Injury Form</header>
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                     <strong>{{ $message }}</strong>
                </div>
            @endif 
 
     <div class="form-outer">
     {{ Form::Open(['route' => 'animaldisease_injury.store']) }}
            <div class="page slidepage">
            <div class="title">Animal &Disease Info:</div>
            <div class="field">
                <div class = "row">

                <div class="column">

                        {{ Form::label('condition_name' , 'Condition Name')}}
                        {{ Form::text('condition_name' ,'' , ['class' => 'form-control' , "placeholder" => "Enter animal condition's name"] ) }}
                        <span style ="color:red">@error('condition_name'){{$message}}@enderror</span>
                        
                        </div>

                        <div class="column">

                        <div>
                         <label class="radio-inline">{{ Form::radio('condition_type','Disease' ,true)}}Disease</label>
                         </div>
                         <div>
                              <label class="radio-inline"> {{ Form::radio('condition_type','Injury' ,false)}}Injury</label>
                        </div>
                        <span style ="color:red">@error('condition_type'){{$message}}@enderror</span>

                </div> 
                 </div>
            </div>
            <div class="field "> 
              {{ Form::submit('Submit' ,['class' => 'btn btn-danger btn-submit' ] )}}
            </div>
            </div>
          
             
              
            {{ Form::Close() }}
      </div>
              @if(Session::has('success'))
            <script>
                    swal("Successfully!" , "{!! Session::get('success')!!}" ,"success",{Button:"ok"}); 
            </script>
            @endif
    </div>

</div>
  
@endsection

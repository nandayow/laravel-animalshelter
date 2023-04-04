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
          @foreach($conditions as $condition) 
        
     <div class="form-outer">
     {{ Form::model($conditions,['method'=>'PATCH','route' => ['animaldisease_injury.update',$condition->id]]) }}

            <div class="page slidepage">
            <div class="title">Animal &Disease Info:</div>
            <div class="field">
                <div class = "row">

                <div class="column">

                        {{ Form::label('condition_name' , 'Condition Name')}}
                        {{ Form::text('condition_name' ,$condition->condition_name, ['class' => 'form-control' , "placeholder" => "Enter animal condition's name"] ) }}
                        <span style ="color:red">@error('condition_name'){{$message}}@enderror</span>
                        
                        </div>

                        <div class="column">
                        @if($condition->condition_type !=="Injury")
                                      <div>
                                    <label class="radio-inline">{{ Form::radio('condition_type','Disease' ,true)}}Disease</label>
                                    </div>
                                    <br>
                                    <div>
                                    <label class="radio-inline"> {{ Form::radio('condition_type','Injury' ,false)}}Injury</label>
                                    </div>
                                    </div>
                                  
                            @else
                                      <div>
                                    <label class="radio-inline">{{ Form::radio('condition_type','Disease' ,false)}}Disease</label>
                                    </div>
                                    <br>
                                    <div>
                                    <label class="radio-inline"> {{ Form::radio('condition_type','Injury' ,true)}}Injury</label>
                                    </div>
                                      </div>

                     @endif
                    
                </div> 
                 </div>
                 {{ Form::submit('Update' ,['class' => 'btn btn-success ' ] )}} 
            </div>
            @endforeach
            <div class="field "> 
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

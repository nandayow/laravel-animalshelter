 
@extends('layouts.base')
@section('body') 

<div class="container well inbox-container">
    <div class="row">
        <div class="col-md-6">
            <div class="vertical-tab" role="tabpanel">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#Section1" aria-controls="home" role="tab" data-toggle="tab"> <i class="fa fa-home"></i></a></li>
                     <li role="presentation"><a href="#Section3" aria-controls="messages" role="tab" data-toggle="tab"> <i class="fas fa-trash"></i></a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content tabs">
                    <div role="tabpanel" class="tab-pane fade in active" id="Section1"> 
                    <div  class="table-responsive ">
            <table class="table table-striped table-hover rescuer-table" > 
                    <thead>
                        <tr>
                            <th >First Name</th> 
                            <th >Last Name</th> 
                            <th>Sender</th>
                            <th >Status</th> 
                            <th >Recieved</th>
                            <th >Mark</th> 
                            <th >Action</th> 
                            
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($emails as $email)
                        <tr>  
                            <td>{{$email->fname}}</td>
                            <td>{{$email->lname}}</td> 
                            <td>{{$email->sender}}</td>
                            <td>{{$email->status}}</td>
                            <td>{{$email->created_at}}</td>
                    
                            <td>
                            {{ Form::model($email,['method'=>'PATCH','route' => ['email.update',$email->id] ,'enctype' => 'multipart/form-data']) }}
                            {{ Form::submit('Read' ,['class' => 'btn btn-info  inbox-btn' ] )}}   
                            {{ Form::Close() }}  
                            </td>
                            <td>  
                          
                            <form action="{{route('email.destroy', $email->id )}}" method="POST">   
                               @csrf 
                                @method('DELETE')
                              <button type="submit" title="delete" style="border: none; background-color:transparent;">
                                  <i class="fas fa-trash fa-lg text-danger"></i>
                              </button>
                              </form>
                            </td>
                        </tr> 
                        @endforeach
                    </tbody>
            </table> 
         </div>
    
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="Section2">
                        <h3>Section 2</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce semper, magna a ultricies volutpat, mi eros viverra massa, vitae consequat nisi justo in tortor. Proin accumsan felis ac felis dapibus, non iaculis mi varius.</p>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="Section3">
                          <div  class="table-responsive ">
            <table class="table table-striped table-hover rescuer-table" > 
                    <thead>
                        <tr>
                            <th >First Name</th> 
                            <th >Last Name</th> 
                            <th>Sender</th>
                            <th >Status</th> 
                            <th >Deleted_at</th> 
                            <th >Action</th>  
                            
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($emailtrash as $email)
                        <tr>  
                            <td>{{$email->fname}}</td>
                            <td>{{$email->lname}}</td> 
                            <td>{{$email->sender}}</td>
                            <td>{{$email->status}}</td>
                            <td>{{$email->deleted_at}}</td>
                            <td> 
                          
                           
                            <form action="{{route('mail.restore', $email->id )}}" method="POST">  
                              @csrf 
                              <button type="submit" title="restore" style="border: none; background-color:transparent;">
                              <i class="fas fa-trash-restore fa-1x fa-lg text-primary"></i> 
                             </button>
                            </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
            </table>
         </div>
    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
a:hover,a:focus{
    text-decoration: none;
    outline: none;
}
.vertical-tab{
    font-family: 'Chivo', sans-serif;
    display: table;
   
}
.vertical-tab .nav-tabs{
    display: table-cell;
    width: 15%;
    min-width: 15%;
    vertical-align: top;
    border: none;
}
.vertical-tab .nav-tabs li{
   float: none;
   vertical-align: top;
}
.vertical-tab .nav-tabs li a{
    color: #fff;
    background: #555;
    font-size: 16px;
    font-weight: 700;
    text-align: center;
    letter-spacing: 1px;
    text-transform: uppercase;
    padding: 7px 10px;
    margin: 0 0 5px 0;
    border-radius: 25px 0 0 25px;
    border: none;
    transition: all 0.3s ease 0s;
}
.vertical-tab .nav-tabs li a:hover,
.vertical-tab .nav-tabs li.active a,
.vertical-tab .nav-tabs li.active a:hover{
    color: #fff;
    background: #d63031;
    border: none;
}
.vertical-tab .nav-tabs li a i{
    color: #d63031;
    background: #fff;
    font-size: 18px;
    line-height: 40px;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: block;
    transition: all 0.5s ease 0s;
}
.vertical-tab .nav-tabs li a:hover i,
.vertical-tab .nav-tabs li.active a i{
    color: #555;
    box-shadow: 0 0 5px #555;
}

.vertical-tab .tab-content h3{
    font-weight: 600;
    text-transform: uppercase;
    margin: 0 0 5px 0;
}
@media only screen and (max-width: 479px){
    .vertical-tab .nav-tabs{
        display: block;
        width: 100%;
        border-right: none;
    }
    .vertical-tab .nav-tabs li{ display: inline-block; }
    .vertical-tab .nav-tabs li a{
        padding: 7px 7px;
        margin: 0 7px 0 0;
        border-radius: 25px 25px 0 0;
    }
    .vertical-tab .tab-content{
        display: block;
        padding: 20px 15px 10px;
    }
    .vertical-tab .tab-content h3{ font-size: 18px; }
}
</style>
@endsection  
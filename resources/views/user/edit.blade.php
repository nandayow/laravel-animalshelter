@extends('layouts.base')
@section('body')
 
<div class="container well myaccount-form">
    <div class="row">
        <div class="col-md-4 edit-class"> 
        <img class="edit-image" src="{{asset( '/storage/public/images//'.$profile->image)}}" width="200" height="200" />
                {{ Form::model($profile,['method'=>'PATCH','route' => ['user.update',$profile->id] ,'enctype' => 'multipart/form-data']) }}
                {{ csrf_field() }}

                 {{ Form::File('image', ['id'=>'image'] )}}  

                 {{ Form::submit('Update' ,['class' => 'btn btn-danger btn-submit' ] )}} 

         </div>
        <div class="col-md-8">  
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                <a class = "fa fa-long-arrow-left"   href = "{{route('profile')}}">Back</a>
                     </div>
                    
                </div>
                <div class="row mt-2">
                    <div class="col-md-6">
                    <h6>Firstname<h6>
                    {{ Form::text('fname',$profile->fname,array('class' => 'form-control')) }}
                    <h6>Lastname<h6>
                    {{ Form::text('lname',$profile->lname,array('class' => 'form-control')) }}
                    <h6>Phone<h6>
                    {{ Form::text('phone',$profile->phone,array('class' => 'form-control')) }}
                    <h6>Role<h6> 
                    {{ Form::text('role',auth()->user()->role,array('class' => 'form-control')) }}
                    <h6>Created_at<h6> 
                    {{ Form::text('birth_date',$profile->created_at,array('class' => 'form-control')) }}
                   </div>
                    <div class="col-md-6">  
                    <h6>Addressline<h6> 
                    {{ Form::text('addressline',$profile->addressline,array('class' => 'form-control')) }}
                    <h6>Town<h6>  
                    {{ Form::text('town',$profile->town,array('class' => 'form-control')) }}
                    <h6>Zipcode<h6> 
                    {{ Form::text('zipcode',$profile->zipcode,array('class' => 'form-control')) }}
                    <h6>Email<h6> 
                    {{ Form::text('email',auth()->user()->email,array('class' => 'form-control')) }}
                    <h6>User_Id<h6> 
                    {{ Form::text('user_id',$profile->user_id,array('class' => 'form-control')) }}
                   </div>   
                </div>
                <div class="row mt-3">
                    <div class="col-md-6"> 
                    </div>
                    <div class="col-md-6"> 
                    </div>
                </div> 
            </div>
        </div>  
    </div>
</div>  
@endsection

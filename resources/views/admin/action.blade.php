<!-- <a href="#" data-toggle="tooltip" data-original-title="Edit" class="fas fa-lock">
</a>
<a href="#" data-toggle="tooltip" data-original-title="Edit" class="fas fa-lock-open">
</a>
  -->
 
<form action="{{route('admin.update',$id)}}" method="post">
    {{ method_field('PUT') }}
    {{ csrf_field() }}
    <button type="submit" title="active" style="border: none; background-color:transparent;">
                  <i class="fas fa-user-lock fa-lg text-primary"></i>
    </button> 
</form>
<form action = "{{route('personnel.destroy',$id)}}" method = "POST"> 
           <a class = "fas fa-eye"  href = "{{route('personnel.show',$id)}} "></a>
           <a class = "fas fa-edit "   href = "{{route('personnel.edit',$id)}}"></a>
                                @csrf 
                            @method('DELETE')
    <button type="submit" title="delete" style="border: none; background-color:transparent;">
        <i class="fas fa-trash fa-lg text-primary"></i>
    </button> 
</form> 
 
  <form action ="{{route('animal.destroy',$id)}}" method = "POST"> 
      <a class = "fas fa-eye"  href = "{{route('animal.show',$id)}}"></a>
                                <a class = "fas fa-edit "   href = "{{route('animal.edit',$id) }}"></a>
                @csrf 
                @method('DELETE')
            <button type="submit" title="delete" style="border: none; background-color:transparent;">
                  <i class="fas fa-trash fa-lg text-primary"></i>
            </button> 
  </form> 

                           
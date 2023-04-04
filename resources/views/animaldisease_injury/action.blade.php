<form action ="{{route('animaldisease_injury.destroy',$id)}}" method = "POST"> 
     <a class = "fas fa-edit "   href = "{{route('animaldisease_injury.edit',$id)}}"></a>
                             @csrf 
                             @method('DELETE')
    <button type="submit" title="delete" style="border: none; background-color:transparent;">
             <i class="fas fa-trash fa-lg text-primary"></i>
    </button> 
</form>  

<form action="{{route('condition.restore', $id )}}" method="POST">  
                              @csrf 
        <button type="submit" title="restore" style="border: none; background-color:transparent;">
                              <i class="fas fa-trash-restore fa-1x fa-lg text-primary"></i> 
        </button>
</form> 
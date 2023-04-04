<form action = "{{route('adopter.destroy',$id)}}" method = "POST">

<a class = "fas fa-eye"  href = "{{route('adopter.show',$id)}}"></a>
<a class = "fas fa-edit "   href = "{{route('adopter.edit',$id)}}"></a>
@csrf 
@method('DELETE')
<button type="submit" title="delete" style="border: none; background-color:transparent;">
<i class="fas fa-trash fa-lg text-primary"></i>
</button> 
</form>  
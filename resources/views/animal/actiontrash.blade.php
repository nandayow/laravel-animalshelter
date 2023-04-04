<form action="{{route('animal.restore', $id )}}" method="POST">  
                              @csrf 
                              <button type="submit" title="restore" style="border: none; background-color:transparent;">
                              <i class="fas fa-trash-restore fa-3x fa-lg text-primary"></i> 
                             </button>
                            </form> 
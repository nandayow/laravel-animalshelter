@extends('layouts.base')
@section('body')

<div class =" container rescuer-body"> 
    <h2> Animal Table Information </h2> 
    <div class= "row">
        <div class ="col-lg-12 margin-tb">
            <div>
            <a class = "btn btn-success" href = "{{route('rescuer.create')}}">Create New</a>
            <a class = "btn btn-danger" href = "{{route('animal.adopted')}}">Adopted list</a>
            <a class = "btn btn-danger" href = "{{route('animal.trash')}}">Trash list</a>
            </div>
        </div>
    </div>
     <table class="table yajra-dt">
                        <thead>
                            <tr>
                            <th >#</th> 
                            <th >ID</th> 
                            <th>AnimalName</th>
                            <th>HealthStatus</th> 
                            <th>Gender</th> 
                            <th>Category</th> 
                            <th>Breed</th> 
                            <th>RescuedDate</th>    
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
   </table>
                    @section('scripts')
                        <script type="text/javascript">
                            $(function () {
                                var table = $('.yajra-dt').DataTable({
                                    processing: true,
                                    serverSide: true,
                                    ajax: "{{ route('animal.index') }}",
                                    columns: [{
                                            data: 'DT_RowIndex',
                                            name: 'DT_RowIndex'
                                        },
                                        {
                                            data: 'id',
                                            name: 'id'
                                        },
                                        {
                                            data: 'animal_name',
                                            name: 'animal_name'
                                        },
                                        {
                                            data: 'healthstatus',
                                            name: 'healthstatus'
                                        },
                                        {
                                            data: 'gender',
                                            name: 'gender'
                                        }, 
                                        {
                                            data: 'animal_type',
                                            name: 'animal_type'
                                        },
                                        {
                                            data: 'breed_name',
                                            name: 'breed_name'
                                        },
                                         {
                                            data: 'rescued_date',
                                            name: 'rescued_date'
                                        },
                                    
                                        {
                                            data: 'action',
                                            name: 'action',
                                            orderable: false,
                                            searchable: false
                                        },
                                    ]
                                });
                                    
                            });  
                        </script> 
                        @endsection 

                        @if(Session::has('success'))
                        <script>
                                swal("Successfully  !" , "{!! Session::get('success')!!}" ,"success",{Button:"ok"}); 
                        </script>
                        @endif 
</div> 
@endsection
@extends('layouts.base')
@section('body')

<div class =" container rescuer-body"> 
    <h2> Injuries Table Information </h2>

    
    <div class= "row">
        <div class ="col-lg-12 margin-tb">
            <div>
            <a class = "btn btn-success" href = "{{route('animaldisease_injury.create')}}">Create New</a>
            <a class = "btn btn-danger" href = "{{route('animaldisease_injury.index')}}">Diseases list</a> 
            <a class = "btn btn-danger" href = "{{route('injury.index')}}">Injuries list</a> 
            </div>
        </div>
    </div>
    <table class="table yajra-dt">  
                <thead>
                    <tr>
                         <th >#</th> 
                        <th >ID</th> 
                        <th>Condition Name</th> 
                        <th>Created_at</th>
                        <th>Updated_at</th> 
                        <th>Deleted</th> 
                        <th>Action</th>
                    </tr>
                </thead> 
     </table> 
    @section('scripts')
                        <script type="text/javascript">
                            $(function () {
                                var table = $('.yajra-dt').DataTable({
                                    processing: true,
                                    serverSide: true,
                                    ajax: "{{ route('injury.index') }}",
                                    columns: [{
                                            data: 'DT_RowIndex',
                                            name: 'DT_RowIndex'
                                        },
                                        {
                                            data: 'id',
                                            name: 'id'
                                        },
                                        {
                                            data: 'condition_name',
                                            name: 'condition_name'
                                        },
                                        {
                                            data: 'created_at',
                                            name: 'created_at'
                                        },
                                        {
                                            data: 'updated_at',
                                            name: 'updated_at'
                                        }, 
                                        {
                                            data: 'deleted_at',
                                            name: 'deleted_at'
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
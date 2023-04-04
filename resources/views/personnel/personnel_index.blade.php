@extends('layouts.base')
@section('body')

<div class =" container rescuer-body"> 
    <h2> Personnel Information </h2>

    <div class= "row">
        <div class ="col-lg-12 margin-tb">
            <div>
        <a class = "btn btn-success" href = "{{route('personnel.create')}}">Create New</a>
            <a class = "btn btn-danger" href = " {{route('personnel.trash')}}">Trash list</a>
            </div>
        </div>
    </div>
    <table class="table yajra-dt">                
                <thead>
                    <tr>   
                        <th >#</th>  
                        <th >ID</th>  
                        <th >Role</th> 
                        <th>Fname</th>  
                        <th>Lname</th>  
                        <th>Gender</th> 
                        <th>Phone</th>
                        <th>Addressline</th>
                        <th>Town</th>
                        <th>Zipcode</th> 
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
                                    ajax: "{{ route('personnel.index')}}",
                                    columns: [{
                                            data: 'DT_RowIndex',
                                            name: 'DT_RowIndex'
                                        },
                                        {
                                            data: 'id',
                                            name: 'id'
                                        },
                                        {
                                            data: 'role',
                                            name: 'role'
                                        },
                                        {
                                            data: 'fname',
                                            name: 'fname'
                                        },
                                        {
                                            data: 'lname',
                                            name: 'lname'
                                        },
                                        {
                                            data: 'gender',
                                            name: 'gender'
                                        }, 
                                        {
                                            data: 'phone',
                                            name: 'phone'
                                        },
                                        {
                                            data: 'addressline',
                                            name: 'addressline'
                                        },
                                         {
                                            data: 'town',
                                            name: 'town'
                                        },{
                                            data: 'zipcode',
                                            name: 'zipcode'
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
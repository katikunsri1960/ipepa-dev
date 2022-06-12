@extends('layouts.admin.layout')

@section('content')
<div class="ibox float-e-margins">
    <div class="ibox-content p-md">

        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <div class="text-right mb-12">
            <a class="btn btn-success" href="{{route('admin.settings.users.create')}}">Add User</a>
        </div>

        <table class="table table-bordered table-hover" id="user-data">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Username</th>
                    <th>Name</th>
                    <th>E-Mail</th>
                    <th>Role ID</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        var table = $('#user-data').DataTable({
            processing: true,
            ajax: {
                url: "{{ route('admin.settings.users.index') }}",
                dataSrc: "",
            },
            columns: [
                {data: null, orderable: false, sortable: false,searchable: false, render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }},
                { data: 'username' },
                { data: 'name'},
                { data: 'email'},
                { data: 'role'},
                { data: 'id', searchable: false ,render: function(data, type, row) {
                    return '<a href="{{ route('admin.settings.users.edit', ':id') }}'.replace(':id', data) + '" class="btn btn-primary btn-sm">Edit</a> '
                    + '<form id="delete-user" action="{{ route('admin.settings.users.destroy', ':id') }}'.replace(':id', data) + '" method="POST" style="display: inline-block;">@csrf @method("DELETE")<button type="submit" class="btn btn-danger btn-sm">Delete</button></form>';
                    ;
                }},
            ],
            columnDefs: [
                {
                    targets: [1,2,3,4],
                    className: 'text-left',
                },
                {
                    targets: [0,5],
                    classNmae: 'text-center',
                    orderable: false,
                    sortable: false,
                }
            ],
        });

    });

    $(document).on('submit', '#delete-user', function(){
	var result = confirm('Do you want to perform this action?');
    if(!result){
    	return false;
    }
})


</script>
@endpush

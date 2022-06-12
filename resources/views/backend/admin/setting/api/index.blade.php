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
            <a class="btn btn-success" href="{{route('admin.settings.api-configs.create')}}">Add Config</a>
        </div>

        <table class="table table-bordered table-hover" id="api-data">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>API Url</th>
                    <th>API Key</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">

 function strtrunc(str, max, add){
    add = add || '...';
    return (typeof str === 'string' && str.length > max ? str.substring(0, max) + add : str);
    };

    $(document).ready(function() {
        var table = $('#api-data').DataTable({
            processing: true,
            ajax: {
                url: "{{ route('admin.settings.api-configs.index') }}",
                dataSrc: "",
            },
            columns: [
                {data: null, orderable: false, sortable: false,searchable: false, render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }},
                { data: 'name'},
                { data: 'api_url'},
                { data: 'api_key'},
                { data: 'id', searchable: false ,render: function(data, type, row) {
                    return '<a href="{{ route('admin.settings.api-configs.edit', ':id') }}'.replace(':id', data) + '" class="btn btn-primary btn-sm">Edit</a> '
                    + '<form id="delete-api" action="{{ route('admin.settings.api-configs.destroy', ':id') }}'.replace(':id', data) + '" method="POST" style="display: inline-block;">@csrf @method("DELETE")<button type="submit" class="btn btn-danger btn-sm">Delete</button></form>';
                    ;
                }},
            ],
            columnDefs: [
                {
                    targets: [1,2,3],
                    className: 'text-left',
                },
                {
                    targets: [3],
                    render: function(data, type, full, meta){
                    if(type === 'display'){
                    data = strtrunc(data, 20);
              }

              return data;
           }
                },
                {
                    targets: [0,3],
                    classNmae: 'text-center',
                    orderable: false,
                    sortable: false,
                }
            ],
        });

    });

    $(document).on('submit', '#delete-api', function(){
	var result = confirm('Do you want to perform this action?');
    if(!result){
    	return false;
    }
})


</script>
@endpush

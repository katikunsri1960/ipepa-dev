@extends('layouts.admin.layout')
@section('content')

<div class="ibox float-e-margins">
    <div class="ibox-content p-md">
        <div class="alert alert-success hidden" id="status-message">
            <span id="status-message-text"></span>
        </div>
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <button class="btn btn-primary" id="sync">Syncronize data</button>
        <div class="text-right mb-12">
            <a class="btn btn-success" href="{{route('admin.sync.create')}}">Add Data</a>
        </div>

        <table class="table table-bordered table-hover" id="table-data">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Table Name</th>
                    <th>API Path</th>
                    <th>Last Sync</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">

</script>
<script type="text/javascript">
    $(document).ready(function() {
        var table = $('#table-data').DataTable({
            processing: true,
            ajax: {
                url: "{{ route('admin.sync.index') }}",
                dataSrc: "",
            },
            columns: [
                {data: null, orderable: false, sortable: false,searchable: false, render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }},
                { data: 'name' },
                { data: 'table_name'},
                { data: 'api_path'},
                { data: 'last_sync'},
                { data: 'id', searchable: false ,render: function(data, type, row) {
                    return '<a href="{{ route('admin.sync.edit', ':id') }}'.replace(':id', data) + '" class="btn btn-primary btn-sm">Edit</a> '
                    + '<form id="delete-data" action="{{ route('admin.sync.destroy', ':id') }}'.replace(':id', data) + '" method="POST" style="display: inline-block;">@csrf @method("DELETE")<button type="submit" class="btn btn-danger btn-sm">Delete</button></form>';
                    ;
                }},
            ],
        });


        $("#sync").click(function(e){
            e.preventDefault();

            $.ajax({
                url: "{{ route('admin.sync-data') }}",
                method: 'GET',
                dataSrc: 'data',
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                },
                success: function(data) {
                    $("#status-message").removeClass('hidden');
                    (data.message).forEach(element => {
                        $("#status-message-text").append(element + '<br>');
                    });
                    // $("#status-message-text").text(data.message);
                    $("#status-message").fadeOut(5000);
                    console.log(data.message);
                    table.ajax.reload();
                }
            });
        });
    });

    $(document).on('submit', '#delete-data', function(){
        var result = confirm('Do you want to perform this action?');
        if(!result){
            return false;
        }
    });
</script>
@endpush

@extends('layouts.admin.layout')
@section('content')

<div class="ibox float-e-margins">
    <div class="ibox-content p-md">

        <div class="alert alert-success hidden" id="status-message">

            <div class="progress progress-striped active">
                <div id="progressFetch" style="width: 100%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="10"
                    role="progressbar" class="progress-bar progress-bar-danger">
                    <span class="sr-only"></span>
                </div>
            </div>

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

        <form id="form-table-data" action="{{route('admin.sync-data-selected')}}">
            <button class="btn btn-danger" id="sync-selected" type="submit">Sync Selected Data</button>
            <table class="table table-bordered table-hover" id="table-data">
                <thead>
                    <tr>
                        <th></th>
                        <th>#</th>
                        <th>Name</th>
                        <th>Table Name</th>
                        <th>API Path</th>
                        <th>Last Sync</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </form>

    </div>
</div>
@endsection

@push('css')
<link href="{{asset('assets/css/plugins/dataTables/dataTables.checkboxes.min.css')}}" rel="stylesheet">
@endpush

@push('scripts')
<script src="{{asset('assets/js/plugins/dataTables/dataTables.checkboxes.min.js')}}"></script>
<script type="text/javascript">



    $(document).ready(function() {

        function callProgress(id) {
            $.ajax({
                url: "{{ route('admin.sync-data-process') }}" + "?id=" + id,
                method: 'GET',
                dataSrc: 'data',
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                },
                success: function(data) {

                    if (data.progress < 100 && data.finishedAt == null) {
                            $("#progressFetch").css("width", data.progress + "%");
                            setTimeout(function() {
                                callProgress(id);
                            }, 100);
                    } else {
                        $("#progressFetch").css("width", "100%");
                        table.ajax.reload();
                    }
                }
            });
        }

        $('#form-table-data').on('submit', function(e){
            e.preventDefault();

            var form = this;

            var rows_selected = table.column(0).checkboxes.selected();

            // Iterate over all selected checkboxes
            $.each(rows_selected, function(index, rowId){
                // Create a hidden element
                $(form).append(
                    $('<input>')
                        .attr('type', 'hidden')
                        .attr('name', 'id[]')
                        .val(rowId)
                );
            });

            // data = JSON.stringify(rows_selected.join(','));
            data = $(form).serialize();
            // Output form data to a console
            // console.log(data);

            $.ajax({
                url: "{{ route('admin.sync-data-selected') }}" + "?id=" + data,
                method: 'GET',
                dataSrc: 'data',
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                },
                success: function(data) {
                    $("#status-message").removeClass('hidden');
                    // console.log(data);
                    callProgress(data.id);
                }
            });

            // // Output form data to a console
            // console.log($(form).serialize());

            // Remove added elements
            $('input[name="id\[\]"]', form).remove();

            // Prevent actual form submission

        });




        //datatable jquery
        var table = $('#table-data').DataTable({
            processing: true,
            pageLength: 50,
            scrollY: 400,
            deferRender: true,
            scroller: true,
            ajax: {
                url: "{{ route('admin.sync.index') }}",
                dataSrc: "",
            },
            columns: [
                {
                    data: 'id',
                    // render: function(data, type, row, meta) {
                    //     return '<input id="checkItem" type="checkbox" class="checkbox" name="id[]" value="' + data.id + '">';
                    // }
                },
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
            columnDefs: [{
                targets: [0],
                searchable: false,
                sortable: false,
                checkboxes: {
                    selectRow: true,
                },
            }],
            select: {
                style: 'multi',
            },
            order: [
                [1, 'asc']
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

                    $.ajax({
                        url: "{{ route('admin.sync-data-process') }}" + "?id=" + data.id,
                        method: 'GET',
                        dataSrc: 'data',
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                        },
                        success: function(data) {
                            callProgress(data.id);
                           }
                        });
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

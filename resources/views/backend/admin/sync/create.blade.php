@extends('layouts.admin.layout')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Add Data</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <form method="POST" class="form-horizontal" action="{{route('admin.sync-store')}}">
                        @csrf
                        <div class="form-group"><label class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-10">
                                <input id="name" type="name" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                                    placeholder="Name">

                                @error('name')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Table Name</label>
                            <div class="col-sm-10">
                                <input id="table_name" type="text"
                                    class="form-control @error('table_name') is-invalid @enderror" name="table_name"
                                    value="{{ old('table_name') }}" required autocomplete="table_name" autofocus
                                    placeholder="table_name">

                                @error('table_name')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group"><label class="col-sm-2 control-label">API Path</label>
                            <div class="col-sm-10">
                                <input id="api_path" type="text"
                                    class="form-control @error('api_path') is-invalid @enderror" name="api_path"
                                    value="{{ old('api_path') }}" required autocomplete="api_path" autofocus
                                    placeholder="api_path">

                                @error('api_path')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-primary" type="submit">Save</button>
                                <a class="btn btn-white" href="{{route('admin.sync-page')}}">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

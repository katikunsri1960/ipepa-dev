@extends('layouts.admin.layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">

                    <form method="POST" class="form-horizontal" action="{{route('admin.settings.api-configs.store')}}">
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
                        <div class="form-group"><label class="col-sm-2 control-label">Username</label>
                            <div class="col-sm-10">
                                <input id="username" type="name" class="form-control @error('username') is-invalid @enderror"
                                    name="username" value="{{ old('username') }}" required autocomplete="username" autofocus
                                    placeholder="username">
                                @error('username')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-10">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" value="{{ old('password') }}" required autocomplete="password" autofocus
                                    placeholder="password">
                                @error('password')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">API URL</label>
                            <div class="col-sm-10">
                                <input id="api_url" type="url" class="form-control @error('api_url') is-invalid @enderror"
                                    name="api_url" value="{{ old('api_url') }}" required autocomplete="api_url"
                                    placeholder="Example (https://api.pd.com/api)">

                                @error('api_url')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">API Key</label>
                            <div class="col-sm-10">
                                <textarea id="api_key"
                                    class="form-control" name="api_key"
                                    required></textarea>
                                @error('api_key')
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
                                <a class="btn btn-white" href="{{route('admin.settings.api-configs.index')}}">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

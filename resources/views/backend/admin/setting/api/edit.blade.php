@extends('layouts.admin.layout')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Add Config</h5>
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
                    <form method="POST" class="form-horizontal" action="{{route('admin.settings.api-configs.update', $data->id)}}">
                        @csrf
                        @method('PUT')

                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-10">
                                <input id="name" type="name" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ $data->name }}" required autocomplete="name" autofocus
                                    placeholder="Name">

                                @error('name')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Username / E-mail</label>
                            <div class="col-sm-10">
                                <input id="username" type="email" class="form-control @error('username') is-invalid @enderror"
                                    name="username" value="{{ $data->username }}" required autocomplete="username" autofocus
                                    placeholder="Name">

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
                                    name="password" value="{{ old('password') }}" autocomplete="password" autofocus
                                    placeholder="Blank if not Change">
                                @error('password')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">E-Mail</label>
                            <div class="col-sm-10">
                                <input id="api_url" type="text" class="form-control @error('api_url') is-invalid @enderror"
                                    name="api_url" value="{{ $data->api_url }}" required autocomplete="api_url" autofocus
                                    placeholder="api_url">

                                @error('api_url')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">E-Mail</label>
                            <div class="col-sm-10">
                                <textarea id="api_key" class="form-control @error('api_key') is-invalid @enderror"
                                    name="api_key" required autocomplete="api_key" autofocus
                                    placeholder="api_key">{{ $data->api_key }}</textarea>

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
                                <button class="btn btn-primary" type="submit">Save Changes</button>
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

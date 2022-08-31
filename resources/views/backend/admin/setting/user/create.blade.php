@extends('layouts.admin.layout')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Add User</h5>
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
                    <form method="POST" class="form-horizontal" action="{{route('admin.settings.users.store')}}">
                        @csrf
                        <div class="form-group"><label class="col-sm-2 control-label">Username</label>
                            <div class="col-sm-10">
                                <input id="username" type="name"
                                    class="form-control @error('username') is-invalid @enderror" name="username"
                                    value="{{ old('username') }}" required autocomplete="username" autofocus
                                    placeholder="Username">

                                @error('username')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
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
                        <div class="form-group"><label class="col-sm-2 control-label">E-Mail</label>
                            <div class="col-sm-10">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                    placeholder="email">

                                @error('email')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-10">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    autocomplete="new-password" placeholder="Password">

                                @error('password')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Confirm Password</label>
                            <div class="col-sm-10">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" autocomplete="new-password" placeholder="Password Confirmation">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Role</label>

                            <div class="col-sm-10">
                                <select id="role" class="form-control m-b" name="role_id" onChange="getFakProdi()">
                                    <option value="">Select Role</option>
                                    @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>

                                @error('role_id')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        
                        <div id="selectProdi" class="form-group" style="visibility: hidden">
                            <label class="col-sm-2 control-label">Pilih Fakultas/Prodi</label>
                            <div class="col-sm-10">
                                <select id="fak_prodi" class="form-control m-b" name="fak_prodi">
                                    <option value="">Select Role</option>
                                </select>

                                @error('fak_prodi')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-primary" type="submit">Save</button>
                                <a class="btn btn-white" href="{{route('admin.settings.users.index')}}">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('css')
<link href="{{asset('assets/css/plugins/select2/select2.min.css')}}" rel="stylesheet">
@endpush
@push('scripts')
<script src="{{asset('assets/js/plugins/select2/select2.full.min.js')}}" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        $('#fak_prodi').select2();
        $('#role').select2();
    });

    function getFakProdi() {

        var roleId = $('#role').val();

        if(roleId != 4){
            if($("#selectProdi").is(":hidden")){
            } else {
                document.getElementById("selectProdi").style.visibility = "hidden";
            }
        } else if(roleId == 4) {
            $.ajax({
                url: "{{route('admin.get-fak-prodi')}}",
                method: "GET",
                dataSrc: "data",
                success: function(data){
                    document.getElementById("selectProdi").style.visibility = "";
                    for (let i = 0; i < data.length; i++) {
                        $('#fak_prodi').append($('<option>', {
                            value: data[i]['id_prodi'],
                            text: data[i]['nama_jenjang_pendidikan'] + " - " + data[i]['nama_program_studi']
                        }, '</option>'));
                    }
                },
            });
        }
    }
    
</script>
@endpush

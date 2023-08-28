@extends('layouts.frontend-layout')
@section('content')
<div class="page login-page">
    <div class="col col-login mx-auto mt-7">
        <div class="container">
            @if(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <div class="card border-primary">
                <div class="card-header">
                    <h4 class="card-title">Pembuatan Akun E-learning</h4><br>
                </div>
                <div class="card-body">
                    <span class="text-xl text-danger"><strong>Sebelum Melakukan Pembuatan akun, Pastikan email institusi sudah
                        aktif dan dapat diakses terlebih dahulu!</strong> </span>
                    <div class="row mt-3">
                        <div class="col-md-6">

                                <div class="mb-3">
                                    <label for="nim" class="form-label">NIM</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control @if ($errors->has('nim')) is-invalid @endif" name="nim" id="nim"
                                            aria-describedby="helpId" placeholder="" value="{{old('nim')}}">
                                        <button class="input-group-text btn btn-primary" onclick="checkNim()">Periksa
                                            NIM!!</button>
                                    </div>
                                    <small id="helpId" class="form-text text-muted">Pastikan NIM sesuai dengan
                                        KPM</small>
                                </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
    {{-- sweetalert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        function checkNim()
        {
            var nim = $('#nim').val();
            // show loading
            $('#loading-overlay').show();
            $.ajax({
                type: "POST",
                url: "{{route('check-nim')}}",
                data: {
                    _token: "{{ csrf_token() }}",
                    nim: nim
                },
                success: function (response) {
                    // hide loading
                    $('#loading-overlay').hide();
                    if(response.status == 200){
                        Swal.fire({
                            icon: 'info',
                            text: 'Akun anda sudah terdaftar di E-learning, Silahkan Melakukan Forget Password/Lost Password!!',
                        });
                    }else if(response.status == 999){
                        Swal.fire({
                            icon: 'info',
                            text: 'Akun anda sudah terdaftar di E-learning, Silahkan Check di E-mail anda terkait Username & Password!!',
                        });
                    }else if(response.status == 888){
                        Swal.fire({
                            icon: 'info',
                            text: 'Akun anda dalam proses verifikasi, Silahkan Tunggu 1x24 Jam!!',
                        });
                    }
                    else if(response.status == 404){
                        let url = "{{route('elearning.create', ':nim')}}";
                        url = url.replace(':nim', response.nim);

                        window.location.href = url;
                    }
                }
            });
        }
    </script>
@endpush


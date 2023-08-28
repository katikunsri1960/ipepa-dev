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
                    <small class="form-text text-muted">Sebelum Melakukan Pembuatan akun, Pastikan email institusi sudah
                        aktif dan dapat diakses terlebih dahulu!</small>
                    <form action="{{route('elearning.store')}}" method="post" enctype="multipart/form-data" id="submitForm">
                        @csrf

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nim" class="form-label">NIM</label>
                                    <input type="text" class="form-control @if ($errors->has('nim')) is-invalid @endif"
                                        name="nim" id="nim" aria-describedby="helpId" placeholder="" value="{{$nim}}"
                                        readonly required>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6 mb-3">
                                <label for="nama_depan" class="form-label">Nama Depan</label>
                                <input type="text"
                                    class="form-control @if ($errors->has('nama_depan')) is-invalid @endif"
                                    name="nama_depan" id="nama_depan" aria-describedby="helpId" placeholder="" required value="{{old('nama_depan')}}">
                                <small id="helpId" class="form-text text-muted"></small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="nama_belakang" class="form-label">Nama Belakang</label>
                                <input type="text"
                                    class="form-control @if ($errors->has('nama_belakang')) is-invalid @endif"
                                    name="nama_belakang" id="nama_belakang" aria-describedby="helpId" placeholder="" required value="{{old('nama_belakang')}}">
                                <small id="helpId" class="form-text text-muted">Jika hanya memiliki 1 suku kata, ulangi
                                    kembali nama depan!</small>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @if ($errors->has('email')) is-invalid @endif"
                                    name="email" id="email" aria-describedby="helpId" placeholder="" required value="{{$nim}}@student.unsri.ac.id" readonly>
                                <small id="helpId" class="form-text text-muted">Pastikan email institusi sudah aktif dan
                                    dapat diakses!</small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="no_hp" class="form-label">KPM / KPM Sementara</label>
                                <input type="file" name="kpm" id="kpm"
                                    class="form-control @if ($errors->has('kpm')) is-invalid @endif @if (session('status')) is-invalid @endif"
                                    placeholder="" aria-describedby="helpId" required>
                                <small id="helpId" class="form-text text-muted">Kirim dalam bentuk PDF, Jpeg, JPG, PNG,
                                    dengan max File 5mb</small>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
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
    // on submit form, swal to confirm
    $('#submitForm').submit(function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Apakah data yang anda masukkan sudah benar?',
            text: "Pastikan data yang anda masukkan sudah benar, karena data yang sudah dikirim tidak dapat diubah kembali!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#submitForm').unbind('submit').submit();
            }
        })
    })
</script>
@endpush

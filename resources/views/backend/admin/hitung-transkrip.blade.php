@extends('layouts.admin.layout')
@section('content')
<div class="ibox float-e-margins">
    <div class="ibox-content p-md">
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="prodi" class="control-label">Program Studi</label>
                    <select name="prodi" id="prodi" class="form-control col-md-8">
                        <option value=""> -- Pilih Prodi --</option>
                        @foreach ($prodi as $item)
                        <option value="{{$item->id_prodi}}">{{$item->kode_program_studi}} - {{$item->nama_program_studi}} ({{$item->nama_jenjang_pendidikan}})</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <label for="angkatan" class="control-label">Angkatan</label>
                <select name="angkatan" id="angkatan" class="form-control choosen-select">
                    <option value=""> -- Pilih Angkatan -- </option>
                    @foreach ($angkatan as $item => $value)
                    <option value="{{$value->id_tahun_ajaran}}">{{$value->id_tahun_ajaran}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="" class="control-label">.</label>
                <button class="btn btn-success btn-sm btn-block" id="btn-hitung" onclick="test()">Hitung</button>
            </div>
        </div>
    </div>
</div>
@endsection
@push('css')
<link href="{{ asset('assets/css/plugins/chosen/bootstrap-chosen.css') }}" rel="stylesheet">
{{-- sweetalert --}}
<link href="{{ asset('assets/css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">

@endpush
@push('scripts')
<script src="{{ asset('assets/js/plugins/chosen/chosen.jquery.js') }}"></script>
{{-- sweetalert --}}
<script src="{{ asset('assets/js/plugins/sweetalert/sweetalert.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#angkatan').chosen({
            width: "100%"
        });
        $('#prodi').chosen({
            width: "100%"
        });
    });

    function test(){
        var prodi = $('#prodi').val();
        var angkatan = $('#angkatan').val();
        if(prodi == '' || angkatan == ''){
            swal({
                title: "Gagal!",
                text: "Silahkan pilih prodi dan angkatan terlebih dahulu!",
                icon: "error",
                button: "OK",
            });
        }else{
            $('#loading-overlay').show();
            $.ajax({
                url: "{{route('admin.hitung-transkrip-angkatan')}}",
                type: "POST",
                data: {
                    prodi: prodi,
                    angkatan: angkatan,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response){
                    $('#loading-overlay').hide();
                    swal({
                        title: "Berhasil!",
                        text: "Transkrip berhasil dihitung sebanyak " + response.data + " data!",
                        icon: "success",
                        button: "OK",
                    });
                },
                error: function(response){
                    $('#loading-overlay').hide();
                    console.log(response);
                    swal({
                        title: "Gagal!",
                        text: response,
                        icon: "error",
                        button: "OK",
                    });
                }
            });
        }
    }
</script>
@endpush

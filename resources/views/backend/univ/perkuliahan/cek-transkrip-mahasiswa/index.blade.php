@extends('layouts.admin-univ.layout')
@section('content')
    <div class="ibox float-e-margins">
        {{-- <div class="ibox-title text-center">
            <h5>Checklist Transkip Mahasiswa</h5>
        </div> --}}

        <div class="ibox-content">
            <div class="row">
                <form method="get">
                    <h4>Checklist Transkip Mahasiswa</h4><br>
                        <div class="col-lg-12 align-center">
                            <form method="GET" role="search">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="keyword" placeholder="Search by NIDN or Nama"
                                        value="{{ request()->get('keyword', '') }}">
                                        <span class="input-group-btn"></span>
                                </div><br>
                                <button class="btn btn-primary " type="submit"><i class="fa-solid fa-search"></i> <span> Tampilkan Data</span></button>
                            </form>
                        </div>
                    </div>
                </form>

            </div><br>

            {{-- {!! $aktivitas_kuliah_mahasiswa->withQueryString()->links() !!} --}}
        </div>
    </div>
@endsection
@push('css')
    <link href="{{ asset('assets/css/plugins/chosen/bootstrap-chosen.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <!-- Chosen -->
    <script src="{{ asset('assets/js/plugins/chosen/chosen.jquery.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.chosen-select').chosen({
                width: "100%"
            });
        });
    </script>
@endpush

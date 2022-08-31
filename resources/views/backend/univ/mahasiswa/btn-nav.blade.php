<div class="ibox-content">
    <a href="{{route('admin-univ.detail-mahasiswa', ['id' => $mahasiswa->id_mahasiswa])}}" class="btn @if (request()->routeIs('admin-univ.detail-mahasiswa')) btn-primary @else btn-default @endif">
        Detail Mahasiswa
        </a>
    <a href="{{route('admin-univ.histori-pendidikan', ['id' => $mahasiswa->id_mahasiswa])}}" class="btn @if (request()->routeIs('admin-univ.histori-pendidikan')) btn-primary @else btn-default @endif">
        Histori Pendidikan</a>
    <a href="{{route('admin-univ.krs-mahasiswa', ['id' => $mahasiswa->id_mahasiswa])}}" class="btn @if (request()->routeIs('admin-univ.krs-mahasiswa')) btn-primary @else btn-default @endif">
        KRS Mahasiswa</a>
    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#exampleModal">
        Histori Nilai</button>
    <a href="{{route('admin-univ.aktivitas-perkuliahan', ['id' => $mahasiswa->id_mahasiswa])}}" class="btn @if (request()->routeIs('admin-univ.aktivitas-perkuliahan')) btn-primary @else btn-default @endif">
        Aktivitas Perkuliahan</a>
    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#exampleModal">
        Prestasi</button>
    <a href="{{route('admin-univ.transkrip-mahasiswa', ['id' => $mahasiswa->id_mahasiswa])}}" class="btn @if (request()->routeIs('admin-univ.transkrip-mahasiswa')) btn-primary @else btn-default @endif">
        Transkrip</a>
</div>

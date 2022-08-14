<div class="ibox-content">
    <a href="{{route('admin-prodi.detail-mahasiswa', ['id' => $mahasiswa->id_mahasiswa])}}" class="btn @if (request()->routeIs('admin-prodi.detail-mahasiswa')) btn-primary @else btn-default @endif">
        Detail Mahasiswa
        </a>
    <a href="{{route('admin-prodi.histori-pendidikan', ['id' => $mahasiswa->id_mahasiswa])}}" class="btn @if (request()->routeIs('admin-prodi.histori-pendidikan')) btn-primary @else btn-default @endif">
        Histori Pendidikan</a>
    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#exampleModal">
        KRS Mahasiswa</button>
    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#exampleModal">
        Histori Nilai</button>
    <a href="{{route('admin-prodi.aktivitas-perkuliahan', ['id' => $mahasiswa->id_mahasiswa])}}" class="btn @if (request()->routeIs('admin-prodi.aktivitas-perkuliahan')) btn-primary @else btn-default @endif">
        Aktivitas Perkuliahan</a>
    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#exampleModal">
        Prestasi</button>
    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#exampleModal">
        Transkrip</button>
</div>

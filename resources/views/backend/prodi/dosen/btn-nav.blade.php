<div class="ibox-content">
    <a href="{{route('admin-prodi.detail-dosen', ['id' => $dosen->id_dosen])}}" class="btn @if (request()->routeIs('admin-prodi.detail-dosen')) btn-primary @else btn-default @endif">
        Detail Dosen</a>
    <a href="{{route('admin-prodi.penugasan-dosen', ['id' => $dosen->id_dosen])}}" class="btn @if (request()->routeIs('admin-prodi.penugasan-dosen')) btn-primary @else btn-default @endif">
        Penugasan Dosen</a>
    <a href="{{route('admin-prodi.aktivitas-mengajar-dosen', ['id' => $dosen->id_dosen])}}" class="btn @if (request()->routeIs('admin-prodi.aktivitas-mengajar-dosen')) btn-primary @else btn-default @endif">
        Aktivitas Mengajar Dosen</a>
    <a href="{{route('admin-prodi.riwayat-fungsional-dosen', ['id' => $dosen->id_dosen])}}" class="btn @if (request()->routeIs('admin-prodi.riwayat-fungsional-dosen')) btn-primary @else btn-default @endif">
        Riwayat Fungsional</a>
    <a href="{{route('admin-prodi.riwayat-kepangkatan-dosen', ['id' => $dosen->id_dosen])}}" class="btn @if (request()->routeIs('admin-prodi.riwayat-kepangkatan-dosen')) btn-primary @else btn-default @endif">
        Riwayat Kepangkatan</a>
    <a href="{{route('admin-prodi.riwayat-pendidikan-dosen', ['id' => $dosen->id_dosen])}}" class="btn @if (request()->routeIs('admin-prodi.riwayat-pendidikan-dosen')) btn-primary @else btn-default @endif">
        Riwayat Pendidikan</a>
    <a href="{{route('admin-prodi.riwayat-sertifikasi-dosen', ['id' => $dosen->id_dosen])}}" class="btn @if (request()->routeIs('admin-prodi.riwayat-sertifikasi-dosen')) btn-primary @else btn-default @endif">
        Riwayat Sertifikasi</a>
    <a href="{{route('admin-prodi.riwayat-penelitian-dosen', ['id' => $dosen->id_dosen])}}" class="btn @if (request()->routeIs('admin-prodi.riwayat-penelitian-dosen')) btn-primary @else btn-default @endif">
        Riwayat Penelitian</a>
    <a href="{{route('admin-prodi.pembimbing-aktivitas-mahasiswa', ['id' => $dosen->id_dosen])}}" class="btn @if (request()->routeIs('admin-prodi.pembimbing-aktivitas-mahasiswa')) btn-primary @else btn-default @endif">
        Pembimbing Aktivitas Mahasiswa</a>
    <a href="{{route('admin-prodi.penguji-aktivitas-mahasiswa', ['id' => $dosen->id_dosen])}}" class="btn @if (request()->routeIs('admin-prodi.penguji-aktivitas-mahasiswa')) btn-primary @else btn-default @endif">
        Penguji Aktivitas Mahasiswa</a>
</div>

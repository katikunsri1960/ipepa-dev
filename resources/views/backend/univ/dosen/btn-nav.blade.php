<div class="ibox-content">
    <a href="{{route('admin-univ.detail-dosen', ['id' => $dosen->id_dosen])}}" class="btn @if (request()->routeIs('admin-univ.detail-dosen')) btn-primary @else btn-default @endif">
        Detail Dosen</a>
    <a href="{{route('admin-univ.penugasan-dosen', ['id' => $dosen->id_dosen])}}" class="btn @if (request()->routeIs('admin-univ.penugasan-dosen')) btn-primary @else btn-default @endif">
        Penugasan Dosen</a>
    <a href="{{route('admin-univ.aktivitas-mengajar-dosen', ['id' => $dosen->id_dosen])}}" class="btn @if (request()->routeIs('admin-univ.aktivitas-mengajar-dosen')) btn-primary @else btn-default @endif">
        Aktivitas Mengajar Dosen</a>
    <a href="{{route('admin-univ.riwayat-fungsional-dosen', ['id' => $dosen->id_dosen])}}" class="btn @if (request()->routeIs('admin-univ.riwayat-fungsional-dosen')) btn-primary @else btn-default @endif">
        Riwayat Fungsional</a>
    <a href="{{route('admin-univ.riwayat-kepangkatan-dosen', ['id' => $dosen->id_dosen])}}" class="btn @if (request()->routeIs('admin-univ.riwayat-kepangkatan-dosen')) btn-primary @else btn-default @endif">
        Riwayat Kepangkatan</a>
    <a href="{{route('admin-univ.riwayat-pendidikan-dosen', ['id' => $dosen->id_dosen])}}" class="btn @if (request()->routeIs('admin-univ.riwayat-pendidikan-dosen')) btn-primary @else btn-default @endif">
        Riwayat Pendidikan</a>
    <a href="{{route('admin-univ.riwayat-sertifikasi-dosen', ['id' => $dosen->id_dosen])}}" class="btn @if (request()->routeIs('admin-univ.riwayat-sertifikasi-dosen')) btn-primary @else btn-default @endif">
        Riwayat Sertifikasi</a>
    <a href="{{route('admin-univ.riwayat-penelitian-dosen', ['id' => $dosen->id_dosen])}}" class="btn @if (request()->routeIs('admin-univ.riwayat-penelitian-dosen')) btn-primary @else btn-default @endif">
        Riwayat Penelitian</a>
    <a href="{{route('admin-univ.detail-dosen', ['id' => $dosen->id_dosen])}}" class="btn @if (request()->routeIs('admin-univ.detail-dosen')) btn-primary @else btn-default @endif">
        Pembimbing Aktivitas Mahasiswa</a>
    <a href="{{route('admin-univ.detail-dosen', ['id' => $dosen->id_dosen])}}" class="btn @if (request()->routeIs('admin-univ.detail-dosen')) btn-primary @else btn-default @endif">
        Penguji Aktivitas Mahasiswa</a>
</div>

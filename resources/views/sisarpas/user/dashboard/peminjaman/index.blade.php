@extends('sisarpas.user.layouts.app')

@section('title', 'Halaman Peminjaman');

@section('content-user-dashboard')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Data Peminjaman /</span> Website Si Sarpras
        </h4>
        @session('success')
            <div class="alert alert-success" role="alert">
                {{ $value }}
            </div>
        @endsession
        @session('error')
            <div class="alert alert-danger" role="alert">
                {{ $value }}
            </div>
        @endsession

        <!-- DataTable with Buttons -->
        <div class="card">
            <div class="dataTables_wrapper dt-bootstrap5 no-footer">
            </div>
            <div class="table-responsive text-nowrap">
                <table id="example" class="table" style="width: 100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Pengembalian</th>
                            <th>Status</th>
                            <th>Tanggal Dibuat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($peminjaman as $p)
                            <tr>
                                <td>
                                    <button type="button" data-item="{{ $p->id }}"
                                        class="btn rounded-pill btn-icon btn-secondary" data-bs-toggle="modal"
                                        data-bs-target="#detailModalBarang--{{ $p->id }}">
                                        <i class='bx bx-info-circle' style='color:#8f0d04'></i>
                                    </button>
                                    {{ $p->id }}
                                </td>
                                <td>{{ $p->users_id }}</td>
                                <td>{{ $p->tanggal_pinjam }}</td>
                                <td>{{ $p->tanggal_pengembalian }}</td>
                                <td>
                                    @if ($p->status_pinjam == 'dipinjam' || $p->status_pinjam == 'dikembalikan')
                                        <span class="badge bg-label-success me-1"> {{ $p->status_pinjam }}
                                        @elseif($p->status_pinjam == 'diajukan')
                                            <span class="badge bg-label-warning me-1"> {{ $p->status_pinjam }}
                                            @elseif($p->status_pinjam == 'ditolak')
                                                <span class="badge bg-label-danger me-1"> {{ $p->status_pinjam }}
                                    @endif
                                    </span>
                                </td>
                                <td>{{ $p->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Pengembalian</th>
                            <th>Status</th>
                            <th>Tanggal Dibuat</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        @foreach ($peminjaman as $p)
            <!-- modal detail -->
            <div class="modal fade" id="detailModalBarang--{{ $p->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel1">Detail Data Peminjaman</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table">
                                <tbody>
                                    <tr data-dt-row="99" data-dt-column="2">
                                        <td>File Pendukung:</td>
                                        <td><a href="{{ asset('sisarpas/file_pendukung/' . $p->dokumen_pendukung) }}"
                                                target="_blank"></a></td>
                                    </tr>
                                    <tr data-dt-row="99" data-dt-column="3">
                                        <td>ID:</td>
                                        <td>{{ $p->id }}</td>
                                    </tr>
                                    <tr data-dt-row="99" data-dt-column="3">
                                        <td>Barang ID:</td>
                                        <td>{{ $p->barangs_id }}</td>
                                    </tr>
                                    <tr data-dt-row="99" data-dt-column="3">
                                        <td>Nama:</td>
                                        <td>{{ $p->users_id }}</td>
                                    </tr>
                                    <tr data-dt-row="99" data-dt-column="3">
                                        <td>Tanggal Pinjam:</td>
                                        <td>{{ $p->tanggal_pinjam }}</td>
                                    </tr>
                                    <tr data-dt-row="99" data-dt-column="3">
                                        <td>Tanggal Pengembalian:</td>
                                        <td>{{ $p->tanggal_pengembalian }}</td>
                                    </tr>
                                    <tr data-dt-row="99" data-dt-column="3">
                                        <td>Kategori Peminjaman:</td>
                                        <td>{{ $p->kategori_pinjam }}</td>
                                    </tr>
                                    <tr data-dt-row="99" data-dt-column="3">
                                        <td>Keterangan Peminjaman:</td>
                                        <td>{{ $p->keterangan_pinjam }}</td>
                                    </tr>
                                    <tr data-dt-row="99" data-dt-column="4">
                                        <td>Status:</td>
                                        <td>
                                            @if ($p->status_pinjam == 'dipinjam' || $p->status_pinjam == 'dikembalikan')
                                                <span class="badge bg-label-success me-1"> {{ $p->status_pinjam }}
                                                @elseif($p->status_pinjam == 'diajukan')
                                                    <span class="badge bg-label-warning me-1"> {{ $p->status_pinjam }}
                                                    @elseif($p->status_pinjam == 'ditolak')
                                                        <span class="badge bg-label-danger me-1"> {{ $p->status_pinjam }}
                                            @endif
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- modal detail-->
        @endforeach
    </div>
    <!-- / Content -->

@endsection

@extends('sisarpas.admin.layouts.app')

@section('title', 'Halaman Verifikasi Peminjaman');

@section('content-admin-dashboard')

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Data Verifikasi Peminjaman /</span> Website Si Sarpras
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
                            <th>Nama Peminjam</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Pengembalian</th>
                            <th>Status</th>
                            <th>Tanggal Diajukan</th>
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
                                <td>{{ $p->users->name }}</td>
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
                            <th>Nama Peminjam</th>
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
                            <h5 class="modal-title" id="exampleModalLabel1">Detail Data Verifikasi Peminjaman</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table">
                                <tbody>
                                    <tr data-dt-row="99" data-dt-column="2">
                                        <td>File Pendukung:</td>
                                        <td><a href="{{ asset('sisarpas/file_pendukung/' . $p->dokumen_pendukung) }}">Lihat
                                                File</a></td>
                                    </tr>
                                    <tr data-dt-row="99" data-dt-column="3">
                                        <td>ID Transaction:</td>
                                        <td>{{ $p->id }}</td>
                                    </tr>
                                    <tr data-dt-row="99" data-dt-column="3">
                                        <td>Barang ID:</td>
                                        <td>{{ $p->barangs_id }}</td>
                                    </tr>
                                    <tr data-dt-row="99" data-dt-column="3">
                                        <td>Nama Barang:</td>
                                        <td>{{ $p->barangs->nama_barang }}</td>
                                    </tr>
                                    <tr data-dt-row="99" data-dt-column="3">
                                        <td>Nama Peminjam:</td>
                                        <td>{{ $p->users->name }}</td>
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
                                    <tr data-dt-row="99" data-dt-column="3">
                                        <td>Tujuan Peminjaman:</td>
                                        <td>{{ $p->tujuan_pinjam }}</td>
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
                                    <tr data-dt-row="99" data-dt-column="8">
                                        <td>Aksi:</td>
                                        <td>
                                            <button type="button" class="btn btn-warning"
                                                data-bs-target="#modalVerifikasiPeminjamanUser--{{ $p->id }}"
                                                data-bs-toggle="modal" data-bs-dismiss="modal">
                                                <i class="bx bx-edit-alt" style="margin-right: 5px"></i>
                                                Verifikasi
                                            </button>
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

        @foreach ($peminjaman as $p)
            <!-- modal edit -->
            <div class="modal fade" id="modalVerifikasiPeminjamanUser--{{ $p->id }}" tabindex="-1"
                aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalToggleLabel2">Verifikasi Peminjaman</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.dashboard_verifikasi_peminjaman') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body table-responsive">
                                <table class="table">
                                    <tbody>
                                        <input type="text" name="id" value="{{ $p->id }}" hidden>
                                        <tr data-dt-row="99" data-dt-column="2">
                                            <td>File Pendukung:</td>
                                            <td><a id="preview"
                                                    href="{{ asset('/sisarpas/assets/file_pendukung/' . $p->dokumen_pendukung) }}">Lihat
                                                    File</a>
                                            </td>
                                            <td>ID Transaction:</td>
                                            <td>
                                                <input type="text" id="id" class="form-control"
                                                    aria-describedby="defaultFormControlHelp" value="{{ $p->id }}"
                                                    disabled />
                                            </td>
                                        </tr>
                                        <tr data-dt-row="99" data-dt-column="2">

                                            <td>ID Barang:</td>
                                            <td>
                                                <input type="text" id="barangs_id" class="form-control"
                                                    aria-describedby="defaultFormControlHelp"
                                                    value="{{ $p->barangs_id }}" disabled />
                                            </td>
                                            <td>Tanggal Peminjaman:</td>
                                            <td>
                                                <input type="date" id="tanggal_pinjam " class="form-control "
                                                    aria-describedby="defaultFormControlHelp"
                                                    value="{{ $p->tanggal_pinjam }}" disabled />
                                            </td>

                                        </tr>
                                        <tr data-dt-row="99" data-dt-column="2">
                                            <td>Barang Yang Di Pinjam:</td>
                                            <td>
                                                <input type="text" id="barangs_id" class="form-control"
                                                    aria-describedby="defaultFormControlHelp"
                                                    value="{{ $p->barangs->nama_barang }}" disabled />
                                            </td>
                                            <td>Nama Peminjam:</td>
                                            <td>
                                                <input type="text" id="barangs_id" class="form-control"
                                                    aria-describedby="defaultFormControlHelp"
                                                    value="{{ $p->users->name }}" disabled />
                                            </td>

                                        </tr>
                                        <tr data-dt-row="99" data-dt-column="2">
                                            <td>Tujuan Pinjam:</td>
                                            <td>
                                                <textarea id="tujuan_pinjam" class="form-control" aria-describedby="defaultFormControlHelp" disabled>{{ $p->tujuan_pinjam }}</textarea>
                                            </td>
                                            <td>Keterangan Pinjam:</td>
                                            <td>
                                                <textarea id="keterangan_pinjam" class="form-control" aria-describedby="defaultFormControlHelp" disabled>{{ $p->keterangan_pinjam }}</textarea>
                                            </td>
                                        </tr>
                                        <tr data-dt-row="99" data-dt-column="2">
                                            <td>Tanggal Pengembalian:</td>
                                            <td>
                                                <input type="date" id="tanggal_pengembalian"
                                                    class="form-control @error('tanggal_pengembalian') is-invalid @enderror"
                                                    placeholder="Masukan tanggal pengembalian" name="tanggal_pengembalian"
                                                    aria-describedby="defaultFormControlHelp"
                                                    value="{{ $p->tanggal_pengembalian }}" />
                                                @error('tanggal_pengembalian')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td>Status:</td>
                                            <td>
                                                <div class="form-check form-check-inline mt-3">
                                                    <input
                                                        class="form-check-input @error('status_pinjam') is-invalid @enderror"
                                                        type="radio" name="status_pinjam" id="inlineRadio1"
                                                        value="dipinjam" />
                                                    <label class="form-check-label" for="inlineRadio1">Disetujui</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input
                                                        class="form-check-input  @error('status_pinjam') is-invalid @enderror"
                                                        type="radio" name="status_pinjam" id="inlineRadio2"
                                                        value="ditolak" />
                                                    <label class="form-check-label" for="inlineRadio2">Ditolak</label>
                                                </div>
                                                @error('status_pinjam')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Ya,
                                    Batal</button>
                                <button type="submit" class="btn btn-success">
                                    <i class="bx bx-save" style="color: #ffffff; margin-right: 5px"></i>
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
    <!-- / Content -->
@endsection

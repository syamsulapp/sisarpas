@extends('sisarpas.admin.layouts.app')

@section('title', 'Penjadwalan Inventori Data')

@section('content-admin-dashboard')

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Data Ruangan /</span> Website Si Sarpras
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
                <div class="card-header flex-column flex-md-row">
                    <div class="head-label text-center">
                        <h5 class="card-title mb-0">Daftar Data Ruangan SARPRAS</h5>
                    </div>
                    <div class="dt-action-buttons text-end pt-3 pt-md-0">
                        <div class="dt-buttons btn-group flex-wrap">
                            <button class="btn btn-primary" type="button" data-bs-target="#createPenjadwalanRuangan"
                                data-bs-toggle="modal" data-bs-dismiss="modal">
                                <span class="tf-icons bx bxs-file-plus me-1"></span>
                                Create Penjadwalan Ruangan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <table id="example" class="table" style="width: 100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Ruangan ID</th>
                            <th>Nama Ruangan</th>
                            <th>Start At</th>
                            <th>End At</th>
                            <th>Tanggal Dibuat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($penjadwalan as $p)
                            <tr>
                                <td>
                                    <button type="button" data-item="{{ $p->id }}"
                                        class="btn rounded-pill btn-icon btn-secondary" data-bs-toggle="modal"
                                        data-bs-target="#detailModalPenjadwalan--{{ $p->id }}">
                                        <i class='bx bx-info-circle' style='color:#8f0d04'></i>
                                    </button>
                                    {{ $p->id }}
                                </td>
                                <td>{{ $p->barangs_id }}</td>
                                <td>{{ $p->barangs->nama_barang }}</td>
                                <td>{{ $p->start_at }}</td>
                                <td>{{ $p->end_at }}</td>
                                <td>{{ $p->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Ruangan ID</th>
                            <th>Nama Ruangan</th>
                            <th>Start At</th>
                            <th>End At</th>
                            <th>Tanggal Dibuat</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        @foreach ($penjadwalan as $p)
            <!-- modal detail -->
            <div class="modal fade" id="detailModalPenjadwalan--{{ $p->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel1">Detail Data Penjadwalan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table">
                                <tbody>
                                    <tr data-dt-row="99" data-dt-column="3">
                                        <td>ID Jadwal:</td>
                                        <td>{{ $p->id }}</td>
                                    </tr>
                                    <tr data-dt-row="99" data-dt-column="3">
                                        <td>ID Barang:</td>
                                        <td>{{ $p->barangs_id }}</td>
                                    </tr>
                                    <tr data-dt-row="99" data-dt-column="3">
                                        <td>Nama Ruangan:</td>
                                        <td>{{ $p->barangs->nama_barang }}</td>
                                    </tr>
                                    <tr data-dt-row="99" data-dt-column="3">
                                        <td>Start At:</td>
                                        <td>{{ $p->start_at }}</td>
                                    </tr>
                                    <tr data-dt-row="99" data-dt-column="3">
                                        <td>End At:</td>
                                        <td>{{ $p->end_at }}</td>
                                    </tr>
                                    <tr data-dt-row="99" data-dt-column="3">
                                        <td>Created At:</td>
                                        <td>{{ $p->created_at }}</td>
                                    </tr>
                                    <tr data-dt-row="99" data-dt-column="8">
                                        <td>Aksi:</td>
                                        <td>
                                            <form
                                                action="{{ route('admin.dashboard_inventori_delete_penjadwalan', $p->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="bx bx-trash" style="color: #ffffff; margin-right: 5px"></i>
                                                    Hapus
                                                </button>
                                                |
                                                <button type="button" class="btn btn-warning"
                                                    data-bs-target="#modalEditPenjadwalan--{{ $p->id }}"
                                                    data-bs-toggle="modal" data-bs-dismiss="modal">
                                                    <i class="bx bx-edit-alt" style="margin-right: 5px"></i>
                                                    Edit
                                                </button>
                                            </form>
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

        @foreach ($penjadwalan as $p)
            <!-- modal edit -->
            <div class="modal fade" id="modalEditPenjadwalan--{{ $p->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalToggleLabel2">Edit Data Penjadwalan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.dashboard_inventori_update_penjadwalan') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="modal-body table-responsive">
                                <table class="table">
                                    <tbody>
                                        <input type="text" name="barangs_id" value="{{ $p->barangs_id }}" hidden>
                                        <tr data-dt-row="99" data-dt-column="2">

                                            <td>ID Ruangan:</td>
                                            <td>
                                                <input type="text" id="jumlah_barang" class="form-control "
                                                    aria-describedby="defaultFormControlHelp"
                                                    value="{{ $p->barangs_id }}" disabled />
                                            </td>
                                            <td>Nama Ruangan:</td>
                                            <td>
                                                <input type="text" id="nama_ruangan" class="form-control"
                                                    aria-describedby="defaultFormControlHelp"
                                                    value="{{ $p->barangs->nama_barang }}" disable />

                                            </td>
                                        </tr>
                                        <tr data-dt-row="99" data-dt-column="2">
                                            <td>Start At:</td>
                                            <td>
                                                <input type="text" id="start_at"
                                                    class="form-control @error('start_at') is-invalid @enderror"
                                                    name="start_at" aria-describedby="defaultFormControlHelp"
                                                    value="{{ $p->start_at }}" />
                                                @error('start_at')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td>End At:</td>
                                            <td>
                                                <input type="text" id="end_at"
                                                    class="form-control @error('end_at') is-invalid @enderror"
                                                    name="end_at" aria-describedby="defaultFormControlHelp"
                                                    value="{{ $p->end_at }}" />
                                                @error('end_at')
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

        <!-- modal edit -->


        <!-- modal create -->
        <div class="modal fade" id="createPenjadwalanRuangan" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalToggleLabel2">Create Inventori Ruangan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('admin.dashboard_inventori_create_ruangan') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr data-dt-row="99" data-dt-column="2">
                                        <td>Image:</td>
                                        <td>
                                            <input type="file" id="gambar_barang"
                                                class="form-control @error('gambar_barang') is-invalid @enderror"
                                                placeholder="Please Drop File Here" name="gambar_barang"
                                                aria-describedby="defaultFormControlHelp" />
                                            @error('gambar_barang')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </td>
                                        <td>Nama:</td>
                                        <td>
                                            <input type="text" id="selectImage"
                                                class="form-control @error('nama_barang') is-invalid @enderror"
                                                placeholder="masukan nama barang" name="nama_barang"
                                                aria-describedby="defaultFormControlHelp"
                                                value="{{ old('nama_barang') }}" />
                                            @error('nama_barang')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </td>

                                    </tr>
                                    <tr data-dt-row="99" data-dt-column="2">

                                        <td>Jumlah:</td>
                                        <td>
                                            <input type="text" id="jumlah_barang"
                                                class="form-control @error('jumlah_barang') is-invalid @enderror"
                                                placeholder="masukan jumlah barang" name="jumlah_barang"
                                                aria-describedby="defaultFormControlHelp"
                                                value="{{ old('jumlah_barang') }}" />
                                            @error('jumlah_barang')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </td>
                                        <td>Kondisi:</td>
                                        <td>
                                            <input type="text" id="kondisi_barang"
                                                class="form-control @error('kondisi_barang') is-invalid @enderror"
                                                placeholder="masukan kondisi barang" name="kondisi_barang"
                                                aria-describedby="defaultFormControlHelp"
                                                value="{{ old('kondisi_barang') }}" />
                                            @error('kondisi_barang')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr data-dt-row="99" data-dt-column="2">
                                        <td>Informasi Detail:</td>
                                        <td>
                                            <input type="text" id="detailBarang"
                                                class="form-control @error('detail_barang') is-invalid @enderror"
                                                placeholder="masukan informasi detail barang" name="detail_barang"
                                                aria-describedby="defaultFormControlHelp"
                                                value="{{ old('detail_barang') }}" />
                                            @error('detail_barang')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr data-dt-row="99" data-dt-column="2">
                                        <td>Spesifikasi Barang:</td>
                                        <td>
                                            <textarea name="spesifikasi_barang" class="form-control @error('spesifikasi_barang') is-invalid @enderror"
                                                aria-describedby="defaultFormControlHelp">{{ old('spesifikasi_barang') }}</textarea>
                                            @error('spesifikasi_barang')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr data-dt-row="99" data-dt-column="8">
                                        <td>Status:</td>
                                        <td>
                                            <div class="form-check form-check-inline mt-3">
                                                <input
                                                    class="form-check-input @error('status_barang') is-invalid @enderror"
                                                    type="radio" name="status_barang" id="inlineRadio1"
                                                    value="ready" />
                                                <label class="form-check-label" for="inlineRadio1">ready</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input
                                                    class="form-check-input  @error('status_barang') is-invalid @enderror"
                                                    type="radio" name="status_barang" id="inlineRadio2"
                                                    value="not-ready" />
                                                <label class="form-check-label" for="inlineRadio2">not-ready</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input
                                                    class="form-check-input  @error('status_barang') is-invalid @enderror"
                                                    type="radio" name="status_barang" id="inlineRadio2"
                                                    value="maintenance" />
                                                <label class="form-check-label" for="inlineRadio2">maintenance</label>
                                            </div>
                                            @error('status_barang')
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
        <!-- modal create -->
    </div>
    <!-- / Content -->

@endsection
@push('script-image-prev')
    <script>
        selectImage.onchange = evt => {
            preview = document.getElementById('preview');
            preview.style.display = 'block';
            const [file] = selectImage.files
            if (file) {
                preview.src = URL.createObjectURL(file)
            }
        }
    </script>
@endpush

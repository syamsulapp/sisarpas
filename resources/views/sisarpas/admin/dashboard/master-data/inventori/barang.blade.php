@extends('sisarpas.admin.layouts.app')

@section('title', 'Barang Inventori Data')

@section('content-admin-dashboard')

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Data Barang /</span> Website Si Sarpras
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
                        <h5 class="card-title mb-0">Daftar Data Barang SARPRAS</h5>
                    </div>
                    <div class="dt-action-buttons text-end pt-3 pt-md-0">
                        <div class="dt-buttons btn-group flex-wrap">
                            <button class="btn btn-primary" type="button" data-bs-target="#createBarangLanding"
                                data-bs-toggle="modal" data-bs-dismiss="modal">
                                <span class="tf-icons bx bxs-file-plus me-1"></span>
                                Tambah Data
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
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Status</th>
                            <th>Tanggal Dibuat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($barang as $b)
                            <tr>
                                <td>
                                    <button type="button" data-item="{{ $b->id }}"
                                        class="btn rounded-pill btn-icon btn-secondary" data-bs-toggle="modal"
                                        data-bs-target="#detailModalBarang--{{ $b->id }}">
                                        <i class='bx bx-info-circle' style='color:#8f0d04'></i>
                                    </button>
                                    {{ $b->id }}
                                </td>
                                <td>{{ $b->nama_barang }}</td>
                                <td>{{ $b->kategori_barang }}</td>
                                <td>
                                    @if ($b->status_barang == 'ready')
                                        <span class="badge bg-label-success me-1"> {{ $b->status_barang }}
                                        @elseif($b->status_barang == 'not-ready')
                                            <span class="badge bg-label-warning me-1"> {{ $b->status_barang }}
                                            @elseif($b->status_barang == 'maintenance')
                                                <span class="badge bg-label-danger me-1"> {{ $b->status_barang }}
                                    @endif
                                    </span>
                                </td>
                                <td>{{ $b->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Status</th>
                            <th>Tanggal Dibuat</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        @foreach ($barang as $b)
            <!-- modal detail -->
            <div class="modal fade" id="detailModalBarang--{{ $b->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel1">Detail Data Barang</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table">
                                <tbody>
                                    <tr data-dt-row="99" data-dt-column="2">
                                        <td>Image:</td>
                                        <td><img src="{{ asset('/sisarpas/assets/inventoriFile/' . $b->gambar_barang) }}"
                                                width="100%"></td>
                                    </tr>
                                    <tr data-dt-row="99" data-dt-column="3">
                                        <td>ID:</td>
                                        <td>{{ $b->id }}</td>
                                    </tr>
                                    <tr data-dt-row="99" data-dt-column="3">
                                        <td>Nama:</td>
                                        <td>{{ $b->nama_barang }}</td>
                                    </tr>
                                    <tr data-dt-row="99" data-dt-column="3">
                                        <td>Jumlah:</td>
                                        <td>{{ $b->jumlah_barang }}</td>
                                    </tr>
                                    <tr data-dt-row="99" data-dt-column="3">
                                        <td>Kondisi:</td>
                                        <td>{{ $b->kondisi_barang }}</td>
                                    </tr>
                                    <tr data-dt-row="99" data-dt-column="3">
                                        <td>Kategori:</td>
                                        <td>{{ $b->kategori_barang }}</td>
                                    </tr>
                                    <tr data-dt-row="99" data-dt-column="3">
                                        <td>Informasi Detail:</td>
                                        <td>{{ $b->detail_barang }}</td>
                                    </tr>
                                    <tr data-dt-row="99" data-dt-column="3">
                                        <td>Spesifikasi:</td>
                                        <td>{{ $b->spesifikasi_barang }}</td>
                                    </tr>
                                    <tr data-dt-row="99" data-dt-column="4">
                                        <td>Status:</td>
                                        <td>
                                            @if ($b->status_barang == 'ready')
                                                <span class="badge bg-label-success me-1"> {{ $b->status_barang }}
                                                @elseif($b->status_barang == 'not-ready')
                                                    <span class="badge bg-label-warning me-1"> {{ $b->status_barang }}
                                                    @elseif($b->status_barang == 'maintenance')
                                                        <span class="badge bg-label-danger me-1"> {{ $b->status_barang }}
                                            @endif
                                            </span>
                                        </td>
                                    </tr>
                                    <tr data-dt-row="99" data-dt-column="8">
                                        <td>Aksi:</td>
                                        <td>
                                            <form action="{{ route('admin.dashboard_inventori_delete_barang', $b->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="bx bx-trash" style="color: #ffffff; margin-right: 5px"></i>
                                                    Hapus
                                                </button>
                                                |
                                                <button type="button" class="btn btn-warning"
                                                    data-bs-target="#modalEditBarang--{{ $b->id }}"
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

        @foreach ($barang as $b)
            <!-- modal edit -->
            <div class="modal fade" id="modalEditBarang--{{ $b->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalToggleLabel2">Edit Data Barang</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.dashboard_inventori_update_barang') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="modal-body table-responsive">
                                <table class="table">
                                    <tbody>
                                        <input type="text" name="id" value="{{ $b->id }}" hidden>
                                        <tr data-dt-row="99" data-dt-column="2">
                                            <td>Preview Image:</td>
                                            <td><img id="preview"
                                                    src="{{ asset('/sisarpas/assets/inventoriFile/' . $b->gambar_barang) }}"
                                                    width="50%" />
                                            </td>
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
                                        </tr>
                                        <tr data-dt-row="99" data-dt-column="2">
                                            <td>Nama:</td>
                                            <td>
                                                <input type="text" id="selectImage"
                                                    class="form-control @error('nama_barang') is-invalid @enderror"
                                                    placeholder="masukan nama barang" name="nama_barang"
                                                    aria-describedby="defaultFormControlHelp"
                                                    value="{{ $b->nama_barang }}" />
                                                @error('nama_barang')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td>Jumlah:</td>
                                            <td>
                                                <input type="text" id="jumlah_barang"
                                                    class="form-control @error('jumlah_barang') is-invalid @enderror"
                                                    placeholder="masukan jumlah barang" name="jumlah_barang"
                                                    aria-describedby="defaultFormControlHelp"
                                                    value="{{ $b->jumlah_barang }}" />
                                                @error('jumlah_barang')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr data-dt-row="99" data-dt-column="2">
                                            <td>Kondisi:</td>
                                            <td>
                                                <input type="text" id="kondisi_barang"
                                                    class="form-control @error('kondisi_barang') is-invalid @enderror"
                                                    placeholder="masukan kondisi barang" name="kondisi_barang"
                                                    aria-describedby="defaultFormControlHelp"
                                                    value="{{ $b->kondisi_barang }}" />
                                                @error('kondisi_barang')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td>Informasi Detail:</td>
                                            <td>
                                                <input type="text" id="detailBarang"
                                                    class="form-control @error('detail_barang') is-invalid @enderror"
                                                    placeholder="masukan informasi detail barang" name="detail_barang"
                                                    aria-describedby="defaultFormControlHelp"
                                                    value="{{ $b->detail_barang }}" />
                                                @error('detail_barang')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                        </tr>

                                        <tr data-dt-row="99" data-dt-column="2">
                                            <td>Spesifikasi Barang:</td>
                                            <td>
                                                <textarea name="spesifikasi_barang" class="form-control @error('spesifikasi_barang') is-invalid @enderror"
                                                    aria-describedby="defaultFormControlHelp">{{ $b->spesifikasi_barang }}</textarea>
                                                @error('spesifikasi_barang')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
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
        @endforeach

        <!-- modal edit -->


        <!-- modal create -->
        <div class="modal fade" id="createBarangLanding" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalToggleLabel2">Create Inventori Barang</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('admin.dashboard_inventori_create_barang') }}" method="POST"
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

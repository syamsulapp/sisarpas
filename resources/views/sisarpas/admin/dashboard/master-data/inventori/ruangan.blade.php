@extends('sisarpas.admin.layouts.app')

@section('title', 'Ruangan Inventori Data')

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

        <div class="accordion" id="accordionPanelsStayOpenExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                        aria-controls="panelsStayOpen-collapseOne">
                        <span class="tf-icons bx bxs-image-add me-1"></span>
                        Image Ruangan Instruction
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show"
                    aria-labelledby="panelsStayOpen-headingOne">
                    <div class="accordion-body">
                        <span class="tf-icons bx bxs-file-plus me-1"></span>
                        <strong>Spesifikasi Gambar Landing Yang Di Upload:.</strong>
                        <ul>
                            <li>Jenis Gambar Harus jpg png jpeg</li>
                            <li>kapasitas gambar yang di upload maksimal 3MB</li>
                            <li> setelah diupload dan jika ingin ditampilkan harap mengatur status nya menjadi unhide</li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
        <br>

        <!-- DataTable with Buttons -->
        <div class="card">
            <div class="dataTables_wrapper dt-bootstrap5 no-footer">
                <div class="card-header flex-column flex-md-row">
                    <div class="head-label text-center">
                        <h5 class="card-title mb-0">Daftar Data Ruangan SARPRAS</h5>
                    </div>
                    <div class="dt-action-buttons text-end pt-3 pt-md-0">
                        <div class="dt-buttons btn-group flex-wrap">
                            <button class="btn btn-primary" type="button" data-bs-target="#createRuangan"
                                data-bs-toggle="modal" data-bs-dismiss="modal">
                                <span class="tf-icons bx bxs-file-plus me-1"></span>
                                Tambah Ruangan
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
                        @foreach ($ruangan as $r)
                            <tr>
                                <td>
                                    <button type="button" data-item="{{ $r->id }}"
                                        class="btn rounded-pill btn-icon btn-secondary" data-bs-toggle="modal"
                                        data-bs-target="#detailModalRuangan--{{ $r->id }}">
                                        <i class='bx bx-info-circle' style='color:#8f0d04'></i>
                                    </button>
                                    {{ $r->id }}
                                </td>
                                <td>{{ $r->nama_barang }}</td>
                                <td>{{ $r->kategori_barang }}</td>
                                <td>
                                    @if ($r->status_barang == 'ready')
                                        <span class="badge bg-label-success me-1"> {{ $r->status_barang }}
                                        @elseif($r->status_barang == 'not-ready')
                                            <span class="badge bg-label-warning me-1"> {{ $r->status_barang }}
                                            @elseif($r->status_barang == 'maintenance')
                                                <span class="badge bg-label-danger me-1"> {{ $r->status_barang }}
                                    @endif
                                    </span>
                                </td>
                                <td>{{ $r->created_at }}</td>
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

        @foreach ($ruangan as $r)
            <!-- modal detail -->
            <div class="modal fade" id="detailModalRuangan--{{ $r->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel1">Detail Data Ruangan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table">
                                <tbody>
                                    <tr data-dt-row="99" data-dt-column="2">
                                        <td>Image:</td>
                                        <td><img src="{{ asset('/sisarpas/assets/inventoriFile/' . $r->gambar_barang) }}"
                                                width="100%"></td>
                                    </tr>
                                    <tr data-dt-row="99" data-dt-column="3">
                                        <td>ID:</td>
                                        <td>{{ $r->id }}</td>
                                    </tr>
                                    <tr data-dt-row="99" data-dt-column="3">
                                        <td>Nama:</td>
                                        <td>{{ $r->nama_barang }}</td>
                                    </tr>
                                    <tr data-dt-row="99" data-dt-column="3">
                                        <td>Kapasitas Ruangan:</td>
                                        <td>{{ $r->jumlah_barang }}</td>
                                    </tr>
                                    <tr data-dt-row="99" data-dt-column="3">
                                        <td>Kondisi:</td>
                                        <td>{{ $r->kondisi_barang }}</td>
                                    </tr>
                                    <tr data-dt-row="99" data-dt-column="3">
                                        <td>Kategori:</td>
                                        <td>{{ $r->kategori_barang }}</td>
                                    </tr>
                                    <tr data-dt-row="99" data-dt-column="3">
                                        <td>Informasi Detail:</td>
                                        <td>{{ $r->detail_barang }}</td>
                                    </tr>
                                    <tr data-dt-row="99" data-dt-column="3">
                                        <td>Spesifikasi:</td>
                                        <td>{{ $r->spesifikasi_barang }}</td>
                                    </tr>
                                    <tr data-dt-row="99" data-dt-column="4">
                                        <td>Status:</td>
                                        <td>
                                            @if ($r->status_barang == 'ready')
                                                <span class="badge bg-label-success me-1"> {{ $r->status_barang }}
                                                @elseif($r->status_barang == 'not-ready')
                                                    <span class="badge bg-label-warning me-1"> {{ $r->status_barang }}
                                                    @elseif($r->status_barang == 'maintenance')
                                                        <span class="badge bg-label-danger me-1"> {{ $r->status_barang }}
                                            @endif
                                            </span>
                                        </td>
                                    </tr>
                                    <tr data-dt-row="99" data-dt-column="8">
                                        <td>Aksi:</td>
                                        <td>
                                            <form action="{{ route('admin.dashboard_inventori_delete_ruangan', $r->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="bx bx-trash" style="color: #ffffff; margin-right: 5px"></i>
                                                    Hapus
                                                </button>
                                                |
                                                <button type="button" class="btn btn-warning"
                                                    data-bs-target="#modalEditRuangan--{{ $r->id }}"
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

        @foreach ($ruangan as $r)
            <!-- modal edit -->
            <div class="modal fade" id="modalEditRuangan--{{ $r->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalToggleLabel2">Edit Data Ruangan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.dashboard_inventori_update_ruangan') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="modal-body table-responsive">
                                <table class="table">
                                    <tbody>
                                        <input type="text" name="id" value="{{ $r->id }}" hidden>
                                        <tr data-dt-row="99" data-dt-column="2">
                                            <td>Preview Image:</td>
                                            <td><img id="preview"
                                                    src="{{ asset('/sisarpas/assets/inventoriFile/' . $r->gambar_barang) }}"
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
                                                    placeholder="masukan kapasitas ruangan" name="nama_barang"
                                                    aria-describedby="defaultFormControlHelp"
                                                    value="{{ $r->nama_barang }}" />
                                                @error('nama_barang')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td>Kapasitas Ruangan:</td>
                                            <td>
                                                <input type="text" id="jumlah_barang"
                                                    class="form-control @error('jumlah_barang') is-invalid @enderror"
                                                    placeholder="masukan jumlah barang" name="jumlah_barang"
                                                    aria-describedby="defaultFormControlHelp"
                                                    value="{{ $r->jumlah_barang }}" />
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
                                                    value="{{ $r->kondisi_barang }}" />
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
                                                    value="{{ $r->detail_barang }}" />
                                                @error('detail_barang')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                        </tr>

                                        <tr data-dt-row="99" data-dt-column="2">
                                            <td>Spesifikasi Ruangan:</td>
                                            <td>
                                                <textarea name="spesifikasi_barang" class="form-control @error('spesifikasi_barang') is-invalid @enderror"
                                                    aria-describedby="defaultFormControlHelp">{{ $r->spesifikasi_barang }}</textarea>
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
        <div class="modal fade" id="createRuangan" tabindex="-1" aria-hidden="true">
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

                                        <td>Kapasitas Ruangan:</td>
                                        <td>
                                            <input type="text" id="jumlah_barang"
                                                class="form-control @error('jumlah_barang') is-invalid @enderror"
                                                placeholder="masukan kapasitas ruangan" name="jumlah_barang"
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
                                        <td>Spesifikasi Ruangan:</td>
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

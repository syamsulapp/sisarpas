@extends('sisarpas.admin.layouts.app')

@section('title', 'Video Landing Master Data')

@section('content-admin-dashboard')

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Data Footer Landing /</span> Website Si Sarpras
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
                        <h5 class="card-title mb-0">Daftar Data Footer Landing SARPRAS</h5>
                    </div>
                    <div class="dt-action-buttons text-end pt-3 pt-md-0">
                        <div class="dt-buttons btn-group flex-wrap">
                            <button class="btn btn-primary" type="button" data-bs-target="#createDataLandingFooter"
                                data-bs-toggle="modal" data-bs-dismiss="modal">
                                <span class="tf-icons bx bxs-file-plus me-1"></span>
                                Tambah Data Footer Landing
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
                            <th>Alamat Gedung</th>
                            <th>Nomor Telpon</th>
                            <th>Email</th>
                            <th>Tanggal Dibuat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($landing_footer as $l)
                            <tr>
                                <td>
                                    <button type="button" data-item="{{ $l->id }}"
                                        class="btn rounded-pill btn-icon btn-secondary" data-bs-toggle="modal"
                                        data-bs-target="#detailModalLandingHeader--{{ $l->id }}">
                                        <i class='bx bx-info-circle' style='color:#8f0d04'></i>
                                    </button>
                                    {{ $l->id }}
                                </td>
                                <td>{{ $l->alamat_gedung }}</td>
                                <td>{{ $l->nomor_telpon }}</td>
                                <td>{{ $l->email }}</td>
                                <td>{{ $l->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Alamat Gedung</th>
                            <th>Nomor Telpon</th>
                            <th>Email</th>
                            <th>Tanggal Dibuat</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        @foreach ($landing_footer as $l)
            <!-- modal detail -->
            <div class="modal fade" id="detailModalLandingHeader--{{ $l->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel1">Detail Data Landing Footer</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table">
                                <tbody>
                                    <tr data-dt-row="99" data-dt-column="3">
                                        <td>Alamat Gedung:</td>
                                        <td>{{ $l->alamat_gedung }}</td>
                                    </tr>
                                    <tr data-dt-row="99" data-dt-column="3">
                                        <td>Nomor Telpon:</td>
                                        <td>{{ $l->nomor_telpon }}</td>
                                    </tr>
                                    <tr data-dt-row="99" data-dt-column="3">
                                        <td>Email:</td>
                                        <td>{{ $l->email }}</td>
                                    </tr>
                                    <tr data-dt-row="99" data-dt-column="3">
                                        <td>Nama Gedung:</td>
                                        <td>{{ $l->nama_gedung }}</td>
                                    </tr>
                                    <tr data-dt-row="99" data-dt-column="3">
                                        <td>Facebook:</td>
                                        <td>{{ $l->facebook }}</td>
                                    </tr>
                                    <tr data-dt-row="99" data-dt-column="3">
                                        <td>Instagram:</td>
                                        <td>{{ $l->instagram }}</td>
                                    </tr>
                                    <tr data-dt-row="99" data-dt-column="3">
                                        <td>Youtube:</td>
                                        <td>{{ $l->youtube }}</td>
                                    </tr>
                                    <tr data-dt-row="99" data-dt-column="4">
                                        <td>Status:</td>
                                        <td>
                                            @if ($l->status != 'unhide')
                                                <span class="badge bg-label-danger me-1"> {{ $l->status }}
                                                @else
                                                    <span class="badge bg-label-success me-1"> {{ $l->status }}
                                            @endif
                                            </span>
                                        </td>
                                    </tr>
                                    <tr data-dt-row="99" data-dt-column="8">
                                        <td>Aksi:</td>
                                        <td>
                                            <form action="{{ route('admin.dashboard_delete_landing_footer', $l->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="bx bx-trash" style="color: #ffffff; margin-right: 5px"></i>
                                                    Hapus
                                                </button>
                                                |
                                                <button type="button" class="btn btn-warning"
                                                    data-bs-target="#modalEditLandingFooter--{{ $l->id }}"
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

        @foreach ($landing_footer as $l)
            <!-- modal edit -->
            <div class="modal fade" id="modalEditLandingFooter--{{ $l->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalToggleLabel2">Edit Data Landing Footer</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.dashboard_update_landing_footer') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="modal-body table-responsive">
                                <table class="table">
                                    <tbody>
                                        <input type="number" name="id" value="{{ $l->id }}" hidden>
                                        <tr data-dt-row="99" data-dt-column="2">
                                            <td>Alamat Gedung:</td>
                                            <td>
                                                <input type="text" id="alamat_gedung"
                                                    class="form-control @error('alamat_gedung') is-invalid @enderror"
                                                    name="alamat_gedung" placeholder="Masukan Alamat Gedung"
                                                    value="{{ $l->alamat_gedung }}" />
                                                @error('alamat_gedung')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td>Nama Gedung:</td>
                                            <td>
                                                <input type="text" id="nama_gedung"
                                                    class="form-control @error('nama_gedung') is-invalid @enderror"
                                                    name="nama_gedung" placeholder="Masukan Nama Gedung"
                                                    value="{{ $l->nama_gedung }}" />
                                                @error('nama_gedung')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr data-dt-row="99" data-dt-column="2">
                                            <td>Email:</td>
                                            <td>
                                                <input type="email" id="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    name="email" placeholder="Masukan Email"
                                                    value="{{ $l->email }}" />
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td>Nomor Telpon:</td>
                                            <td>
                                                <input type="text" id="nomor_telpon"
                                                    class="form-control @error('nomor_telpon') is-invalid @enderror"
                                                    name="nomor_telpon" placeholder="Masukan Nomor Telpon"
                                                    value="{{ $l->nomor_telpon }}" />
                                                @error('nomor_telpon')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr data-dt-row="99" data-dt-column="2">
                                            <td>Facebook :</td>
                                            <td>
                                                <input type="text" id="facebook"
                                                    class="form-control @error('facebook') is-invalid @enderror"
                                                    name="facebook" placeholder="Masukan Facebook"
                                                    value="{{ $l->facebook }}" />
                                                @error('facebook')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td>Instagram:</td>
                                            <td>
                                                <input type="text" id="instagram"
                                                    class="form-control @error('instagram') is-invalid @enderror"
                                                    name="instagram" placeholder="Masukan Instagram"
                                                    value="{{ $l->instagram }}" />
                                                @error('instagram')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr data-dt-row="99" data-dt-column="8">
                                            <td>Youtube:</td>
                                            <td>
                                                <input type="text" id="youtube"
                                                    class="form-control @error('youtube') is-invalid @enderror"
                                                    name="youtube" placeholder="Masukan Youtube"
                                                    value="{{ $l->youtube }}" />
                                                @error('youtube')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td>Status:</td>
                                            <td>
                                                <div class="form-check form-check-inline mt-3">
                                                    <input class="form-check-input @error('status') is-invalid @enderror"
                                                        type="radio" name="status" id="inlineRadio1"
                                                        value="hide" />
                                                    <label class="form-check-label" for="inlineRadio1">Hide</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input  @error('status') is-invalid @enderror"
                                                        type="radio" name="status" id="inlineRadio2"
                                                        value="unhide" />
                                                    <label class="form-check-label" for="inlineRadio2">Unhide</label>
                                                </div>
                                                @error('status')
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
        <div class="modal fade" id="createDataLandingFooter" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalToggleLabel2">Create Data Landing Footer</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('admin.dashboard_create_landing_footer') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr data-dt-row="99" data-dt-column="2">
                                        <td>Alamat Gedung:</td>
                                        <td>
                                            <input type="text" id="alamat_gedung"
                                                class="form-control @error('alamat_gedung') is-invalid @enderror"
                                                name="alamat_gedung" placeholder="Masukan Alamat Gedung"
                                                value="{{ old('alamat_gedung') }}" />
                                            @error('alamat_gedung')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </td>
                                        <td>Nama Gedung:</td>
                                        <td>
                                            <input type="text" id="nama_gedung"
                                                class="form-control @error('nama_gedung') is-invalid @enderror"
                                                name="nama_gedung" placeholder="Masukan Nama Gedung"
                                                value="{{ old('nama_gedung') }}" />
                                            @error('nama_gedung')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr data-dt-row="99" data-dt-column="2">
                                        <td>Email:</td>
                                        <td>
                                            <input type="email" id="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                placeholder="Masukan Email" value="{{ old('email') }}" />
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </td>
                                        <td>Nomor Telpon:</td>
                                        <td>
                                            <input type="text" id="nomor_telpon"
                                                class="form-control @error('nomor_telpon') is-invalid @enderror"
                                                name="nomor_telpon" placeholder="Masukan Nomor Telpon"
                                                value="{{ old('nomor_telpon') }}" />
                                            @error('nomor_telpon')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr data-dt-row="99" data-dt-column="2">
                                        <td>Facebook :</td>
                                        <td>
                                            <input type="text" id="facebook"
                                                class="form-control @error('facebook') is-invalid @enderror"
                                                name="facebook" placeholder="Masukan Facebook"
                                                value="{{ old('facebook') }}" />
                                            @error('facebook')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </td>
                                        <td>Instagram:</td>
                                        <td>
                                            <input type="text" id="instagram"
                                                class="form-control @error('instagram') is-invalid @enderror"
                                                name="instagram" placeholder="Masukan Instagram"
                                                value="{{ old('instagram') }}" />
                                            @error('instagram')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr data-dt-row="99" data-dt-column="8">
                                        <td>Youtube:</td>
                                        <td>
                                            <input type="text" id="youtube"
                                                class="form-control @error('youtube') is-invalid @enderror"
                                                name="youtube" placeholder="Masukan Youtube"
                                                value="{{ old('youtube') }}" />
                                            @error('youtube')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </td>
                                        <td>Status:</td>
                                        <td>
                                            <div class="form-check form-check-inline mt-3">
                                                <input class="form-check-input @error('status') is-invalid @enderror"
                                                    type="radio" name="status" id="inlineRadio1" value="hide" />
                                                <label class="form-check-label" for="inlineRadio1">Hide</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input  @error('status') is-invalid @enderror"
                                                    type="radio" name="status" id="inlineRadio2" value="unhide" />
                                                <label class="form-check-label" for="inlineRadio2">Unhide</label>
                                            </div>
                                            @error('status')
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

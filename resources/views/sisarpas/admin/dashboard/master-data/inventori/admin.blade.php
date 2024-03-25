@extends('sisarpas.admin.layouts.app')

@section('title', 'Admin Inventori Data')

@section('content-admin-dashboard')

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Data Pengguna (admin) /</span> Website Si Sarpras
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
                        Image Profile Admin Instruction
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
                        <h5 class="card-title mb-0">Daftar Data Pengguna (admin) SARPRAS</h5>
                    </div>
                    <div class="dt-action-buttons text-end pt-3 pt-md-0">
                        <div class="dt-buttons btn-group flex-wrap">
                            <button class="btn btn-primary" type="button" data-bs-target="#createUsers"
                                data-bs-toggle="modal" data-bs-dismiss="modal">
                                <span class="tf-icons bx bxs-file-plus me-1"></span>
                                Tambah Data Pengguna (admin)
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
                            <th>Email</th>
                            <th>Tanggal Dibuat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($admin as $u)
                            <tr>
                                <td>
                                    <button type="button" data-item="{{ $u->id }}"
                                        class="btn rounded-pill btn-icon btn-secondary" data-bs-toggle="modal"
                                        data-bs-target="#detailModalUsers--{{ $u->id }}">
                                        <i class='bx bx-info-circle' style='color:#8f0d04'></i>
                                    </button>
                                    {{ $u->id }}
                                </td>
                                <td>{{ $u->name }}</td>
                                <td>{{ $u->email }}</td>
                                <td>{{ $u->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Tanggal Dibuat</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        @foreach ($admin as $u)
            <!-- modal detail -->
            <div class="modal fade" id="detailModalUsers--{{ $u->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel1">Detail Data Pengguna (admin)</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table">
                                <tbody>
                                    <tr data-dt-row="99" data-dt-column="2">
                                        <td>Photo Profile:</td>
                                        <td><img src="{{ asset('/sisarpas/assets/adminAkunImage/' . $u->image) }}"
                                                width="20%"></td>
                                    </tr>
                                    <tr data-dt-row="99" data-dt-column="3">
                                        <td>ID:</td>
                                        <td>{{ $u->id }}</td>
                                    </tr>
                                    <tr data-dt-row="99" data-dt-column="3">
                                        <td>Nama:</td>
                                        <td>{{ $u->name }}</td>
                                    </tr>
                                    <tr data-dt-row="99" data-dt-column="3">
                                        <td>Email:</td>
                                        <td>{{ $u->email }}</td>
                                    </tr>
                                    <tr data-dt-row="99" data-dt-column="3">
                                        <td>Tanggal Dibuat:</td>
                                        <td>{{ $u->created_at }}</td>
                                    </tr>
                                    <tr data-dt-row="99" data-dt-column="8">
                                        <td>Aksi:</td>
                                        <td>
                                            <form action="{{ route('admin.dashboard_inventori_delete_admin', $u->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="bx bx-trash" style="color: #ffffff; margin-right: 5px"></i>
                                                    Hapus
                                                </button>
                                                |
                                                <button type="button" class="btn btn-warning"
                                                    data-bs-target="#modalEditUsers--{{ $u->id }}"
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

        @foreach ($admin as $u)
            <!-- modal edit -->
            <div class="modal fade" id="modalEditUsers--{{ $u->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalToggleLabel2">Edit Data Pengguna (admin)</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.dashboard_inventori_update_admin') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="modal-body table-responsive">
                                <table class="table">
                                    <tbody>
                                        <input type="text" name="id" value="{{ $u->id }}" hidden>
                                        <tr data-dt-row="99" data-dt-column="2">
                                            <td>Preview Image:</td>
                                            <td><img id="preview"
                                                    src="{{ asset('/sisarpas/assets/adminAkunImage/' . $u->image) }}"
                                                    width="20%" />
                                            </td>
                                        </tr>
                                        <tr data-dt-row="99" data-dt-column="2">
                                            <td>Image:</td>
                                            <td>
                                                <input type="file" id="image"
                                                    class="form-control @error('image') is-invalid @enderror"
                                                    placeholder="Upload Photo Profile" name="image"
                                                    aria-describedby="defaultFormControlHelp" />
                                                @error('image')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr data-dt-row="99" data-dt-column="2">
                                            <td>Nama:</td>
                                            <td>
                                                <input type="text" id="selectImage"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    placeholder="masukan nama lengkap" name="name"
                                                    aria-describedby="defaultFormControlHelp"
                                                    value="{{ $u->name }}" />
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr data-dt-row="99" data-dt-column="2">
                                            <td>Email:</td>
                                            <td>
                                                <input type="text" id="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    placeholder="masukan email" name="email"
                                                    aria-describedby="defaultFormControlHelp"
                                                    value="{{ $u->email }}" />
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr data-dt-row="99" data-dt-column="2">

                                            <td>Password:</td>
                                            <td>
                                                <input type="password" id="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    placeholder="masukan password" name="password"
                                                    aria-describedby="defaultFormControlHelp" />
                                                @error('password')
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
        <div class="modal fade" id="createUsers" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalToggleLabel2">Create Inventori Pengguna (Admin)</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('admin.dashboard_inventori_create_admin') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr data-dt-row="99" data-dt-column="2">
                                        <td>Image:</td>
                                        <td>
                                            <input type="file" id="image"
                                                class="form-control @error('image') is-invalid @enderror"
                                                placeholder="Please Drop File Here" name="image"
                                                aria-describedby="defaultFormControlHelp" />
                                            @error('image')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </td>
                                        <td>Nama:</td>
                                        <td>
                                            <input type="text" id="name"
                                                class="form-control @error('name') is-invalid @enderror"
                                                placeholder="Masukan nama lengkap" name="name"
                                                aria-describedby="defaultFormControlHelp" value="{{ old('name') }}" />
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </td>

                                    </tr>
                                    <tr data-dt-row="99" data-dt-column="2">
                                        <td>Email:</td>
                                        <td>
                                            <input type="email" id="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                placeholder="Masukan Email" name="email"
                                                aria-describedby="defaultFormControlHelp" value="{{ old('email') }}" />
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </td>
                                        <td>Password:</td>
                                        <td>
                                            <input type="password" id="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                placeholder="Masukan password" name="password"
                                                aria-describedby="defaultFormControlHelp"
                                                value="{{ old('password') }}" />
                                            @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr data-dt-row="99" data-dt-column="2">

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

@extends('sisarpas.admin.layouts.app')

@section('title', 'Landing Master Data')

@section('content-admin-dashboard')

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Data Landing /</span> Website Si Sarpras
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
                        <h5 class="card-title mb-0">Daftar Data Landing SARPRAS</h5>
                    </div>
                    <div class="dt-action-buttons text-end pt-3 pt-md-0">
                        <div class="dt-buttons btn-group flex-wrap">
                            <button class="btn btn-primary" type="button" data-bs-target="#createDataLanding"
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
                            <th>File</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Tanggal Dibuat</th>
                            <!-- <th>Tanggal Pinjam</th>
                                                                                                                                                                                                                                                                                                                                                                                                                                <th>Tanggal Kembali</th>
                                                                                                                                                                                                                                                                                                                                                                                                                                <th>Tujuan</th>
                                                                                                                                                                                                                                                                                                                                                                                                                                <th>Keterangan</th> -->
                            <!-- <th>Aksi</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($landing as $l)
                            <tr>
                                <td>
                                    <button type="button" data-item="{{ $l->file }}"
                                        class="btn rounded-pill btn-icon btn-secondary" data-bs-toggle="modal"
                                        data-bs-target="#detailModal--{{ $l->id }}">
                                        <i class='bx bx-info-circle' style='color:#8f0d04'></i>
                                    </button>
                                    {{ $l->id }}
                                </td>
                                <td>{{ $l->file }}</td>
                                <td>{{ $l->type }}</td>
                                <td>
                                    @if ($l->status != 'unhide')
                                        <span class="badge bg-label-danger me-1"> {{ $l->status }}
                                        @else
                                            <span class="badge bg-label-success me-1"> {{ $l->status }}
                                    @endif
                                    </span>
                                </td>
                                <td>{{ $l->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>File</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Tanggal Dibuat</th>

                            <!-- <th>Tanggal Pinjam</th>
                                                                                                                                                                                                                                                                                                                                                                                                                                <th>Tanggal Kembali</th>
                                                                                                                                                                                                                                                                                                                                                                                                                                <th>Tujuan</th>
                                                                                                                                                                                                                                                                                                                                                                                                                                <th>Keterangan</th> -->
                            <!-- <th>Aksi</th> -->
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        @foreach ($landing as $l)
            <!-- modal detail -->
            <div class="modal fade" id="detailModal--{{ $l->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel1">Detail Data Peminjam</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table">
                                <tbody>
                                    <tr data-dt-row="99" data-dt-column="2">
                                        <td>File:</td>
                                        <td><img src="{{ asset('/sisarpas/assets/landingFile/' . $l->file) }}"
                                                width="100%"></td>
                                    </tr>
                                    <tr data-dt-row="99" data-dt-column="3">
                                        <td>Tipe:</td>
                                        <td>{{ $l->type }}</td>
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
                                            <form action="{{ route('admin.dashboard_delete_landing', $l->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="bx bx-trash" style="color: #ffffff; margin-right: 5px"></i>
                                                    Hapus
                                                </button>
                                                |
                                                <button type="button" class="btn btn-warning"
                                                    data-bs-target="#modalEditLanding" data-bs-toggle="modal"
                                                    data-bs-dismiss="modal">
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

        <!-- modal edit -->
        <div class="modal fade" id="modalEditLanding" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalToggleLabel2">Edit Data Peminjam</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body table-responsive">
                        <table class="table">
                            <tbody>
                                <tr data-dt-row="99" data-dt-column="2">
                                    <td>ID Peminjam:</td>
                                    <td>
                                        <input type="text" class="form-control" id="defaultFormControlInput"
                                            placeholder="John Doe" aria-describedby="defaultFormControlHelp" />
                                    </td>

                                    <td>Tanggal Pinjam:</td>
                                    <td>
                                        <input class="form-control" type="date" value="2021-06-18"
                                            id="html5-date-input" />
                                    </td>
                                </tr>
                                <tr data-dt-row="99" data-dt-column="3">
                                    <td>NIM:</td>
                                    <td>
                                        <input type="text" class="form-control" id="defaultFormControlInput"
                                            placeholder="John Doe" aria-describedby="defaultFormControlHelp" />
                                    </td>

                                    <td>Tanggal Kembali:</td>
                                    <td>
                                        <input class="form-control" type="date" value="2021-06-18"
                                            id="html5-date-input" />
                                    </td>
                                </tr>
                                <tr data-dt-row="99" data-dt-column="4">
                                    <td>Nama:</td>
                                    <td>
                                        <input type="text" class="form-control" id="defaultFormControlInput"
                                            placeholder="John Doe" aria-describedby="defaultFormControlHelp" />
                                    </td>

                                    <td>Tujuan:</td>
                                    <td>
                                        <input type="text" class="form-control" id="defaultFormControlInput"
                                            placeholder="John Doe" aria-describedby="defaultFormControlHelp" />
                                    </td>
                                </tr>
                                <tr data-dt-row="99" data-dt-column="5">
                                    <td>Barang Pinjam:</td>
                                    <td>
                                        <input type="text" class="form-control" id="defaultFormControlInput"
                                            placeholder="John Doe" aria-describedby="defaultFormControlHelp" />
                                    </td>

                                    <td>Keterangan:</td>
                                    <td>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    </td>
                                </tr>
                                <tr data-dt-row="99" data-dt-column="8">
                                    <td>Status:</td>
                                    <td>
                                        <div class="form-check form-check-inline mt-3">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                                id="inlineRadio1" value="option1" />
                                            <label class="form-check-label" for="inlineRadio1">Pending</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                                id="inlineRadio2" value="option2" />
                                            <label class="form-check-label" for="inlineRadio2">Completed</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                                id="inlineRadio2" value="option2" />
                                            <label class="form-check-label" for="inlineRadio2">Active</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                                id="inlineRadio2" value="option2" />
                                            <label class="form-check-label" for="inlineRadio2">Scheduled</label>
                                        </div>
                                    </td>
                                </tr>
                                <!-- <tr data-dt-row="99" data-dt-column="8">
                                                                                                                                                                                                                                                                                                                                                                                                                                        <td>Aksi:</td>
                                                                                                                                                                                                                                                                                                                                                                                                                                        <td>
                                                                                                                                                                                                                                                                                                                                                                                                                                            <button type="button" class="btn btn-success">
                                                                                                                                                                                                                                                                                                                                                                                                                                                <i class="bx bx-save" style="color: #ffffff; margin-right: 5px"></i>
                                                                                                                                                                                                                                                                                                                                                                                                                                                Simpan
                                                                                                                                                                                                                                                                                                                                                                                                                                            </button>
                                                                                                                                                                                                                                                                                                                                                                                                                                        </td>
                                                                                                                                                                                                                                                                                                                                                                                                                                    </tr> -->
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Ya,
                            Batal</button>
                        <button type="button" class="btn btn-success">
                            <i class="bx bx-save" style="color: #ffffff; margin-right: 5px"></i>
                            Simpan
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal edit -->


        <!-- modal create -->
        <div class="modal fade" id="createDataLanding" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalToggleLabel2">Create Data Landing</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('admin.dashboard_create_landing') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr data-dt-row="99" data-dt-column="2">
                                        <td>File:</td>
                                        <td>
                                            <input type="file" class="form-control @error('file') is-invalid @enderror"
                                                id="defaultFormControlInput" placeholder="Please Drop File Here"
                                                name="file" aria-describedby="defaultFormControlHelp" />
                                            @error('file')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </td>

                                        <td>Type:</td>
                                        <td>
                                            <select name="type" id="defaultFormControlInput"
                                                class="form-control @error('type') is-invalid @enderror"
                                                placeholder="Pilih Jenis File">
                                                <option value="" selected>Pilih Jenis File</option>
                                                <option value="image">image</option>
                                                <option value="video">video</option>
                                            </select>
                                            @error('type')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr data-dt-row="99" data-dt-column="8">
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
                                    <!-- <tr data-dt-row="99" data-dt-column="8">
                                                                                                                                                                                                                                                                                                                                                                                                                                    <td>Aksi:</td>
                                                                                                                                                                                                                                                                                                                                                                                                                                    <td>
                                                                                                                                                                                                                                                                                                                                                                                                                                        <button type="button" class="btn btn-success">
                                                                                                                                                                                                                                                                                                                                                                                                                                            <i class="bx bx-save" style="color: #ffffff; margin-right: 5px"></i>
                                                                                                                                                                                                                                                                                                                                                                                                                                            Simpan
                                                                                                                                                                                                                                                                                                                                                                                                                                        </button>
                                                                                                                                                                                                                                                                                                                                                                                                                                    </td>
                                                                                                                                                                                                                                                                                                                                                                                                                                </tr> -->
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

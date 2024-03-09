@extends('sisarpas.admin.layouts.app')

@section('title', 'Landing Master Data')

@section('content-admin-dashboard')

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Data Landing /</span> Website Si Sarpras
        </h4>

        <!-- DataTable with Buttons -->
        <div class="card">
            <h5 class="card-header">Daftar Data Landing SARPRAS</h5>
            <div class="table-responsive text-nowrap">
                <table id="example" class="table" style="width: 100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>File</th>
                            <th>Type</th>
                            <th>Status</th>
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
                                    <button type="button" class="btn rounded-pill btn-icon btn-secondary"
                                        data-bs-toggle="modal" data-bs-target="#basicModal">
                                        <i class='bx bx-info-circle' style='color:#8f0d04'></i> </button>
                                    </button>
                                    {{ $l->id }}
                                </td>
                                <td>{{ $l->file }}</td>
                                <td>{{ $l->Type }}</td>
                                <td><span class="badge bg-label-danger me-1">{{ $l->status }}</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>File</th>
                            <th>Type</th>
                            <th>Status</th>
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

        <!-- modal detail -->
        <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
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
                                    <td>Tanggal Pinjam:</td>
                                    <td>01 Januari 2024</td>
                                </tr>
                                <tr data-dt-row="99" data-dt-column="3">
                                    <td>Tanggal Kembali:</td>
                                    <td>03 Maret 2024</td>
                                </tr>
                                <tr data-dt-row="99" data-dt-column="4">
                                    <td>Tujuan:</td>
                                    <td>Pribadi</td>
                                </tr>
                                <tr data-dt-row="99" data-dt-column="5">
                                    <td>Keterangan:</td>
                                    <td>Apapun yang penting saya pinjam</td>
                                </tr>
                                <tr data-dt-row="99" data-dt-column="8">
                                    <td>Aksi:</td>
                                    <td>
                                        <button type="button" class="btn btn-danger">
                                            <i class="bx bx-trash" style="color: #ffffff; margin-right: 5px"></i>
                                            Hapus
                                        </button>
                                        |
                                        <button type="button" class="btn btn-warning" data-bs-target="#modalToggle2"
                                            data-bs-toggle="modal" data-bs-dismiss="modal">
                                            <i class="bx bx-edit-alt" style="margin-right: 5px"></i>
                                            Edit
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- model detail-->

        <!-- modal edit -->
        <div class="modal fade" id="modalToggle2" tabindex="-1" aria-hidden="true">
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
    </div>
    <!-- / Content -->

@endsection

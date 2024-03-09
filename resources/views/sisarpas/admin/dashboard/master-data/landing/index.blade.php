@extends('sisarpas.admin.layouts.app')

@section('title', 'Landing Master Data')

@section('content-admin-dashboard')

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Data Peminjaman /</span> Alat dan Barang SARPRAS ITERA
        </h4>

        <!-- DataTable with Buttons -->
        <div class="card">
            <h5 class="card-header">Daftar Peminjaman Barang SARPRAS</h5>
            <div class="table-responsive text-nowrap">
                <table id="example" class="table" style="width: 100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Peminjaman</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Barang Dipinjam</th>
                            <th>Status</th>
                            <!-- <th>Tanggal Pinjam</th>
                                                            <th>Tanggal Kembali</th>
                                                            <th>Tujuan</th>
                                                            <th>Keterangan</th> -->
                            <!-- <th>Aksi</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <button type="button" class="btn rounded-pill btn-icon btn-secondary" data-bs-toggle="modal"
                                    data-bs-target="#basicModal">
                                    <i class='bx bx-info-circle' style='color:#8f0d04'></i> </button>
                                </button>
                                1
                            </td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                            <td>2011-04-25</td>
                            <td><span class="badge bg-label-primary me-1">Active</span></td>
                        </tr>
                        <tr>
                            <td>
                                <button type="button" class="btn rounded-pill btn-icon btn-secondary"
                                    data-bs-toggle="modal" data-bs-target="#basicModal">
                                    <i class='bx bx-info-circle' style='color:#8f0d04'></i> </button>
                                </button>
                                2
                            </td>
                            <td>Accountant</td>
                            <td>Tokyo</td>
                            <td>63</td>
                            <td>2011-07-25</td>
                            <td><span class="badge bg-label-success me-1">Completed</span></td>
                        </tr>
                        <tr>
                            <td>
                                <button type="button" class="btn rounded-pill btn-icon btn-secondary"
                                    data-bs-toggle="modal" data-bs-target="#basicModal">
                                    <i class='bx bx-info-circle' style='color:#8f0d04'></i> </button>
                                </button>
                                3
                            </td>
                            <td>Junior Technical Author</td>
                            <td>San Francisco</td>
                            <td>66</td>
                            <td>2009-01-12</td>
                            <td><span class="badge bg-label-success me-1">Completed</span></td>
                        </tr>
                        <tr>
                            <td>
                                <button type="button" class="btn rounded-pill btn-icon btn-secondary"
                                    data-bs-toggle="modal" data-bs-target="#basicModal">
                                    <i class='bx bx-info-circle' style='color:#8f0d04'></i> </button>
                                </button>
                                4
                            </td>
                            <td>Senior Javascript Developer</td>
                            <td>Edinburgh</td>
                            <td>22</td>
                            <td>2012-03-29</td>
                            <td><span class="badge bg-label-warning me-1">Pending</span></td>
                        </tr>
                        <tr>
                            <td>
                                <button type="button" class="btn rounded-pill btn-icon btn-secondary"
                                    data-bs-toggle="modal" data-bs-target="#basicModal">
                                    <i class='bx bx-info-circle' style='color:#8f0d04'></i> </button>
                                </button>
                                5
                            </td>
                            <td>Accountant</td>
                            <td>Tokyo</td>
                            <td>33</td>
                            <td>2008-11-28</td>
                            <td><span class="badge bg-label-info me-1">Scheduled</span></td>
                        </tr>
                        <tr>
                            <td>
                                <button type="button" class="btn rounded-pill btn-icon btn-secondary"
                                    data-bs-toggle="modal" data-bs-target="#basicModal">
                                    <i class='bx bx-info-circle' style='color:#8f0d04'></i> </button>
                                </button>
                                6
                            </td>
                            <td>Integration Specialist</td>
                            <td>New York</td>
                            <td>61</td>
                            <td>2012-12-02</td>
                            <td><span class="badge bg-label-warning me-1">Pending</span></td>
                        </tr>
                        <tr>
                            <td>
                                <button type="button" class="btn rounded-pill btn-icon btn-secondary"
                                    data-bs-toggle="modal" data-bs-target="#basicModal">
                                    <i class='bx bx-info-circle' style='color:#8f0d04'></i> </button>
                                7
                            </td>
                            <td>Sales Assistant</td>
                            <td>San Francisco</td>
                            <td>59</td>
                            <td>2012-08-06</td>
                            <td><span class="badge bg-label-warning me-1">Pending</span></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>ID Peminjaman</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Barang Dipinjam</th>
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

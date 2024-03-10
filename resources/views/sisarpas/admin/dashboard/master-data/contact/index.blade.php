@extends('sisarpas.admin.layouts.app')

@section('title', 'Landing Contact Data')

@section('content-admin-dashboard')

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Data Contact /</span> Website Si Sarpras
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
                        <h5 class="card-title mb-0">Daftar Data Contacts SARPRAS</h5>
                    </div>
                    {{-- <div class="dt-action-buttons text-end pt-3 pt-md-0">
                        <div class="dt-buttons btn-group flex-wrap">
                            <button class="btn btn-primary" type="button" data-bs-target="#createDataLanding"
                                data-bs-toggle="modal" data-bs-dismiss="modal">
                                <span class="tf-icons bx bxs-file-plus me-1"></span>
                                Tambah Data
                            </button>
                        </div>
                    </div> --}}
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <table id="example" class="table" style="width: 100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Tanggal Dibuat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contacs as $c)
                            <tr>
                                <td>
                                    <button type="button" class="btn rounded-pill btn-icon btn-secondary"
                                        data-bs-toggle="modal" data-bs-target="#detailModal--{{ $c->id }}">
                                        <i class='bx bx-info-circle' style='color:#8f0d04'></i>
                                    </button>
                                    {{ $c->id }}
                                </td>
                                <td>{{ $c->email }}</td>
                                <td>{{ $c->message }}</td>
                                <td>{{ $c->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Tanggal Dibuat</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        @foreach ($contacs as $c)
            <!-- modal detail -->
            <div class="modal fade" id="detailModal--{{ $c->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel1">Detail Data Contacts</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table">
                                <tbody>
                                    <tr data-dt-row="99" data-dt-column="3">
                                        <td>Tipe:</td>
                                        <td>{{ $c->email }}</td>
                                    </tr>
                                    <tr data-dt-row="99" data-dt-column="3">
                                        <td>Message:</td>
                                        <td>{{ $c->message }}</td>
                                    </tr>
                                    <tr data-dt-row="99" data-dt-column="3">
                                        <td>Message:</td>
                                        <td>{{ $c->created_at }}</td>
                                    </tr>
                                    <tr data-dt-row="99" data-dt-column="8">
                                        <td>Aksi:</td>
                                        <td>
                                            <form action="{{ route('admin.dashboard_delete_contacts', $c->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="bx bx-trash" style="color: #ffffff; margin-right: 5px"></i>
                                                    Hapus
                                                </button>
                                                |
                                                <button type="button" class="btn btn-warning"
                                                    data-bs-target="#modalEditLanding--{{ $c->id }}"
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

        @foreach ($contacs as $c)
            <!-- modal edit -->
            <div class="modal fade" id="modalEditLanding--{{ $c->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalToggleLabel2">Edit Data Landing</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.dashboard_update_contacts') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="modal-body table-responsive">
                                <table class="table">
                                    <tbody>
                                        <input type="number" name="id" value="{{ $c->id }}" hidden>
                                        <tr data-dt-row="99" data-dt-column="10">
                                            <td>Email:</td>
                                            <td>
                                                <input type="text" id="selectImage"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    placeholder="Please Insert Email" name="email"
                                                    aria-describedby="defaultFormControlHelp"
                                                    value="{{ $c->email }}" />
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr data-dt-row="99" data-dt-column="9">
                                            <td>Message:</td>
                                            <td>
                                                <input type="text" id="selectImage"
                                                    class="form-control @error('message') is-invalid @enderror"
                                                    placeholder="Please Insert Message" name="message"
                                                    aria-describedby="defaultFormControlHelp"
                                                    value="{{ $c->message }}" />
                                                @error('message')
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

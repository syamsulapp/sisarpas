@extends('sisarpas.admin.layouts.app')

@section('title', 'Informasi Penting Master Data')

@section('content-admin-dashboard')

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Data Informasi Penting Landing /</span> Website Si Sarpras
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
                        <h5 class="card-title mb-0">Daftar Data Informasi Penting Landing SARPRAS</h5>
                    </div>
                    <div class="dt-action-buttons text-end pt-3 pt-md-0">
                        <div class="dt-buttons btn-group flex-wrap">
                            <button class="btn btn-primary" type="button"
                                data-bs-target="#createDataLandingInformasiPenting" data-bs-toggle="modal"
                                data-bs-dismiss="modal">
                                <span class="tf-icons bx bxs-file-plus me-1"></span>
                                Tambah Data Infomasi Penting Landing
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
                            <th>Judul</th>
                            <th>Tanggal Dibuat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($informasi_penting as $l)
                            <tr>
                                <td>
                                    <button type="button" data-item="{{ $l->id }}"
                                        class="btn rounded-pill btn-icon btn-secondary" data-bs-toggle="modal"
                                        data-bs-target="#detailModalLandingInformasiPenting--{{ $l->id }}">
                                        <i class='bx bx-info-circle' style='color:#8f0d04'></i>
                                    </button>
                                    {{ $l->id }}
                                </td>
                                <td>{{ $l->judul_informasi }}</td>
                                <td>{{ $l->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Tanggal Dibuat</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        @foreach ($informasi_penting as $l)
            <!-- modal detail -->
            <div class="modal fade" id="detailModalLandingInformasiPenting--{{ $l->id }}" tabindex="-1"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel1">Detail Data Landing Informasi Penting</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table">
                                <tbody>
                                    <tr data-dt-row="99" data-dt-column="3">
                                        <td>Judul:</td>
                                        <td>{{ $l->judul_informasi }}</td>
                                    </tr>
                                    <tr data-dt-row="99" data-dt-column="3">
                                        <td>Isi:</td>
                                        <td>{{ $l->isi_informasi }}</td>
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
                                                    data-bs-target="#modalEditLandingIsiInformasi--{{ $l->id }}"
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

        @foreach ($informasi_penting as $l)
            <!-- modal edit -->
            <div class="modal fade" id="modalEditLandingIsiInformasi--{{ $l->id }}" tabindex="-1"
                aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalToggleLabel2">Edit Data Landing Isi Informasi</h5>
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
                                            <td>Judul:</td>
                                            <td>
                                                <input type="text" id="judul_informasi"
                                                    class="form-control @error('judul_informasi') is-invalid @enderror"
                                                    name="judul_informasi" placeholder="Masukan Alamat Gedung"
                                                    value="{{ $l->judul_informasi }}" />
                                                @error('judul_informasi')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr data-dt-row="99" data-dt-column="2">
                                            <td>Informasi:</td>
                                            <td>
                                                <input type="email" id="isi_informasi"
                                                    class="form-control @error('isi_informasi') is-invalid @enderror"
                                                    name="isi_informasi" placeholder="Masukan Isi Informasi"
                                                    value="{{ $l->isi_informasi }}" />
                                                @error('isi_informasi')
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
        <div class="modal fade" id="createDataLandingInformasiPenting" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalToggleLabel2">Create Data Landing Informasi Penting</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('admin.dashboard_create_landing_footer') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr data-dt-row="99" data-dt-column="2">
                                        <td>Judul:</td>
                                        <td>
                                            <input type="text" id="judul_informasi"
                                                class="form-control @error('judul_informasi') is-invalid @enderror"
                                                name="judul_informasi" placeholder="Masukan Alamat Gedung" />
                                            @error('judul_informasi')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr data-dt-row="99" data-dt-column="2">
                                        <td>Informasi:</td>
                                        <td>
                                            {{-- <input type="email" id="isi_informasi"
                                                class="form-control @error('isi_informasi') is-invalid @enderror"
                                                name="isi_informasi" placeholder="Masukan Isi Informasi" />
                                            @error('isi_informasi')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror --}}
                                            <textarea id="isi_informasi" class="form-control @error('isi_informasi') is-invalid @enderror">{{ old('isi_informasi') }}</textarea>
                                             @error('isi_informasi')
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
@push('js')
    <script src="{{ asset('sisarpas/assets/js/wysiwyg.js') }}"></script>
    <script>
        tinymce.init({
            selector: "textarea#isi_informasi",
            plugins: [
                "a11ychecker",
                "advlist",
                "advcode",
                "advtable",
                "autolink",
                "checklist",
                "export",
                "lists",
                "link",
                "image",
                "charmap",
                "preview",
                "anchor",
                "searchreplace",
                "visualblocks",
                "powerpaste",
                "fullscreen",
                "formatpainter",
                "insertdatetime",
                "media",
                "table",
                "help",
                "wordcount",
            ],
            toolbar: "undo redo | a11ycheck casechange blocks | bold italic backcolor | alignleft aligncenter alignright alignjustify |" +
                "bullist numlist checklist outdent indent | removeformat | code table help",
        });
    </script>
@endpush

@extends('sisarpas.admin.layouts.app')

@section('title', 'Video Landing Master Data')

@section('content-admin-dashboard')

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Data Video Landing /</span> Website Si Sarpras
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
                        data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="false"
                        aria-controls="panelsStayOpen-collapseOne">
                        <span class="tf-icons bx bxs-video-plus me-1"></span>
                        Video Landing Header Instruction
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show"
                    aria-labelledby="panelsStayOpen-headingOne">
                    <div class="accordion-body">
                        <span class="tf-icons bx bxs-file-plus me-1"></span>
                        <strong>Spesifikasi Video Yang Di Upload:.</strong>
                        <ul>
                            <li>Jenis Video Harus <strong>.mp4</strong></li>
                            <li>kapasitas video yang di upload maksimal <strong>3MB</strong></li>
                            <li> setelah diupload dan jika ingin ditampilkan harap mengatur status nya menjadi <strong>
                                    unhide</strong></li>
                        </ul>

                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
                        aria-controls="panelsStayOpen-collapseTwo">
                        <span class="tf-icons bx bxl-youtube me-1"></span>
                        Video From Youtube Insturction Upload
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse"
                    aria-labelledby="panelsStayOpen-headingTwo">
                    <div class="accordion-body">
                        <span class="tf-icons bx bxs-file-plus me-1"></span>
                        <strong>Spesifikasi Video Yang Di Upload:.</strong>
                        <ul>
                            <li>buka url/link youtube video</li>
                            <li>klik tombol share</li>
                            <li>copy link share</li>
                            <li>paste di kolom input <strong>masukan embed youtube</strong> pada forms tambah data landing
                                video </li>
                            <li> setelah diupload dan jika ingin ditampilkan harap mengatur status nya menjadi
                                <strong>unhide</strong>
                            </li>

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
                        <h5 class="card-title mb-0">Daftar Data Video Landing SARPRAS</h5>
                    </div>
                    <div class="dt-action-buttons text-end pt-3 pt-md-0">
                        <div class="dt-buttons btn-group flex-wrap">
                            <button class="btn btn-primary" type="button" data-bs-target="#createDataLandingVideo"
                                data-bs-toggle="modal" data-bs-dismiss="modal">
                                <span class="tf-icons bx bxs-file-plus me-1"></span>
                                Tambah Data Video Landing
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
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($landing_video as $l)
                            <tr>
                                <td>
                                    <button type="button" data-item="{{ $l->file }}"
                                        class="btn rounded-pill btn-icon btn-secondary" data-bs-toggle="modal"
                                        data-bs-target="#detailModalLandingHeader--{{ $l->id }}">
                                        <i class='bx bx-info-circle' style='color:#8f0d04'></i>
                                    </button>
                                    {{ $l->id }}
                                </td>
                                <td>
                                    {{ $l->file }}
                                </td>
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
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        @foreach ($landing_video as $l)
            <!-- modal detail -->
            <div class="modal fade" id="detailModalLandingHeader--{{ $l->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel1">Detail Data Landing Video</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table">
                                <tbody>
                                    @if (strpos($l->file, 'embed'))
                                        <iframe width="100%" height="410px"
                                            src="https://www.youtube.com{{ $l->file }}" title="YouTube video player"
                                            frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                            allowfullscreen></iframe>
                                    @elseif(strpos($l->file, '.mp4'))
                                        <tr data-dt-row="99" data-dt-column="10">
                                            <td>Video:</td>
                                            <td><video width="100%" controls>
                                                    <source src="{{ asset('/sisarpas/assets/landingFile/' . $l->file) }}"
                                                        type="video/mp4" />
                                                    <video></td>
                                        </tr>
                                    @endif

                                    <tr data-dt-row="99" data-dt-column="3">
                                        <td>Tipe:</td>
                                        <td>{{ $l->type }}</td>
                                    </tr>
                                    <tr data-dt-row="99" data-dt-column="3">
                                        <td>Embed Youtube:</td>
                                        <td>{{ strpos($l->file, 'embed') ? $l->file : 'belum ada' }}</td>
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
                                            <form action="{{ route('admin.dashboard_delete_landing_video', $l->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="bx bx-trash" style="color: #ffffff; margin-right: 5px"></i>
                                                    Hapus
                                                </button>
                                                |
                                                <button type="button" class="btn btn-warning"
                                                    data-bs-target="#modalEditLandingVideo--{{ $l->id }}"
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

        @foreach ($landing_video as $l)
            <!-- modal edit -->
            <div class="modal fade" id="modalEditLandingVideo--{{ $l->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalToggleLabel2">Edit Data Landing Video</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.dashboard_update_landing_video') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="modal-body table-responsive">
                                <table class="table">
                                    <tbody>
                                        <input type="number" name="id" value="{{ $l->id }}" hidden>
                                        @if (strpos($l->file, 'embed'))
                                            <iframe width="100%" height="410px"
                                                src="https://www.youtube.com{{ $l->file }}"
                                                title="YouTube video player" frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                allowfullscreen></iframe>
                                        @elseif(strpos($l->file, '.mp4'))
                                            <tr data-dt-row="99" data-dt-column="10">
                                                <td>Video:</td>
                                                <td><video width="100%" controls>
                                                        <source
                                                            src="{{ asset('/sisarpas/assets/landingFile/' . $l->file) }}"
                                                            type="video/mp4" />
                                                        <video></td>
                                            </tr>
                                        @endif

                                        <tr data-dt-row="99" data-dt-column="9">
                                            <td>Video From Your Computer:</td>
                                            <td>
                                                <input type="file" id="selectImage"
                                                    class="form-control @error('file') is-invalid @enderror"
                                                    placeholder="Please Drop File Here" name="file"
                                                    aria-describedby="defaultFormControlHelp" />
                                                @error('file')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr data-dt-row="99" data-dt-column="9">

                                            <td>Video From Youtube:</td>
                                            <td>
                                                <input type="text" id="selectImage"
                                                    class="form-control @error('embed_yt') is-invalid @enderror"
                                                    placeholder="Masukan youtube embed" name="embed_yt"
                                                    aria-describedby="defaultFormControlHelp" />
                                                @error('embed_yt')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <input type="text" name="type" value="{{ $l->type }}" hidden>
                                        <tr data-dt-row="99" data-dt-column="8">
                                            <td>Status:</td>
                                            <td>
                                                <div class="form-check form-check-inline mt-3">
                                                    <input class="form-check-input @error('status') is-invalid @enderror"
                                                        type="radio" name="status" id="inlineRadio1"
                                                        value="hide" />
                                                    <label class="form-check-label" for="inlineRadio1">hide</label>
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
        <div class="modal fade" id="createDataLandingVideo" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalToggleLabel2">Create Data Landing Video</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('admin.dashboard_create_landing_video') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body table-responsive">
                            <table class="table">
                                <tbody>
                                    {{-- <tr data-dt-row="99" data-dt-column="10">
                                        <td>Preview Image:</td>
                                        <td><img id="preview" src="#" width="50%" style="display: none" />
                                        </td>
                                    </tr> --}}
                                    <tr data-dt-row="99" data-dt-column="2">
                                        <td>Video From Your Computer:</td>
                                        <td>
                                            <input type="file" id="selectImage"
                                                class="form-control @error('file') is-invalid @enderror"
                                                placeholder="Please Drop File Here" name="file"
                                                aria-describedby="defaultFormControlHelp" />
                                            @error('file')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </td>

                                    </tr>
                                    <input type="text" name="type" value="{{ 'video' }}" hidden>
                                    <tr data-dt-row="99" data-dt-column="2">
                                        <td>Video From Youtube:</td>
                                        <td>
                                            <input type="text"
                                                class="form-control @error('embed_yt') is-invalid @enderror"
                                                name="embed_yt" placeholder="Masukan Embed Youtube">
                                            @error('embed_yt')
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

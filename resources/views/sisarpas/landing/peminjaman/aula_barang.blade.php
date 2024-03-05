@extends('sisarpas.landing.layouts.app')

@section('title', 'Peminjaman Aula')

@section('content-landing')

    <!-- End Header -->
    <main id="main" data-aos="fade-up">
        <section id="cover" class="inner-page">
            <div class="pencarian-data">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <h2>Sarana dan Prasarana ITERA</h2>
                            <p>Daftar alat dan barang, ruangan aula, serta pelayanan SARPRAS ITERA</p>

                            <button class="btn-cari" onclick="toggleActive(this)">Alat & Barang</button>
                            <button class="btn-aula" onclick="toggleActive(this)">Aula</button>

                            <div class="input-box">
                                <input type="text" placeholder="Search here..." />
                                <button class="button">
                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor"
                                        stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                        class="css-i6dzq1">
                                        <circle cx="11" cy="11" r="8"></circle>
                                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                    </svg>
                                    Cari
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="pricing" class="pricing">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 mt-4 mt-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="box featured">
                            <h3>Microphone</h3>
                            <img src="{{ asset('sisarpas/assets/img/microphone.png') }}" alt="microphone" />
                            <ul>
                                <li>
                                    <p>SARPRAS menyediakan layanan peminjaman peralatan yang efisien untuk mendukung
                                        kegiatan dengan kualitas terbaik.</p>
                                </li>
                            </ul>
                            <div class="btn-wrap">
                                <a type="button" data-toggle="modal" data-target="#exampleModal" class="btn-buy">Detail</a>
                                <a href="form_peminjam.html" class="btn-buy">Pinjam</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mt-4 mt-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="box featured">
                            <h3>Speaker</h3>
                            <img src="{{ asset('sisarpas/assets/img/speeker.png') }}" alt="speeker" />
                            <ul>
                                <li>
                                    <p>SARPRAS menyediakan layanan peminjaman peralatan yang efisien untuk mendukung
                                        kegiatan dengan kualitas terbaik.</p>
                                </li>
                            </ul>
                            <div class="btn-wrap">
                                <a type="button" data-toggle="modal" data-target="#exampleModal" class="btn-buy">Detail</a>
                                <a href="form_peminjam.html" class="btn-buy">Pinjam</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mt-4 mt-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="box featured">
                            <h3>Converter HDMI</h3>
                            <img src="{{ asset('sisarpas/assets/img/hdmi.png') }}" alt="hdmi" />
                            <ul>
                                <li>
                                    <p>SARPRAS menyediakan layanan peminjaman peralatan yang efisien untuk mendukung
                                        kegiatan dengan kualitas terbaik.</p>
                                </li>
                            </ul>
                            <div class="btn-wrap">
                                <a type="button" data-toggle="modal" data-target="#exampleModal" class="btn-buy">Detail</a>
                                <a href="form_peminjam.html" class="btn-buy">Pinjam</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mt-4 mt-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="box featured">
                            <h3>Converter VGA</h3>
                            <img src="{{ asset('sisarpas/assets/img/vga.png') }}" alt="vga" />
                            <ul>
                                <li>
                                    <p>SARPRAS menyediakan layanan peminjaman peralatan yang efisien untuk mendukung
                                        kegiatan dengan kualitas terbaik.</p>
                                </li>
                            </ul>
                            <div class="btn-wrap">
                                <a type="button" data-toggle="modal" data-target="#exampleModal" class="btn-buy">Detail</a>
                                <a href="form_peminjam.html" class="btn-buy">Pinjam</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mt-4 mt-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="box featured">
                            <h3>Microphone</h3>
                            <img src="{{ asset('sisarpas/assets/img/microphone.png') }}" alt="microphone" />
                            <ul>
                                <li>
                                    <p>SARPRAS menyediakan layanan peminjaman peralatan yang efisien untuk mendukung
                                        kegiatan dengan kualitas terbaik.</p>
                                </li>
                            </ul>
                            <div class="btn-wrap">
                                <a type="button" data-toggle="modal" data-target="#exampleModal" class="btn-buy">Detail</a>
                                <a href="form_peminjam.html" class="btn-buy">Pinjam</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 mt-4 mt-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="box featured">
                            <h3>Speaker</h3>
                            <img src="{{ asset('sisarpas/assets/img/speeker.png') }}" alt="speeker" />
                            <ul>
                                <li>
                                    <p>SARPRAS menyediakan layanan peminjaman peralatan yang efisien untuk mendukung
                                        kegiatan dengan kualitas terbaik.</p>
                                </li>
                            </ul>
                            <div class="btn-wrap">
                                <a type="button" data-toggle="modal" data-target="#exampleModal"
                                    class="btn-buy">Detail</a>
                                <a href="form_peminjam.html" class="btn-buy">Pinjam</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mt-4 mt-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="box featured">
                            <h3>Converter HDMI</h3>
                            <img src="{{ asset('sisarpas/assets/img/hdmi.png') }}" alt="hdmi" />
                            <ul>
                                <li>
                                    <p>SARPRAS menyediakan layanan peminjaman peralatan yang efisien untuk mendukung
                                        kegiatan dengan kualitas terbaik.</p>
                                </li>
                            </ul>
                            <div class="btn-wrap">
                                <a type="button" data-toggle="modal" data-target="#exampleModal"
                                    class="btn-buy">Detail</a>
                                <a href="form_peminjam.html" class="btn-buy">Pinjam</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mt-4 mt-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="box featured">
                            <h3>Converter VGA</h3>
                            <img src="{{ asset('sisarpas/assets/img/vga.png') }}" alt="vga" />
                            <ul>
                                <li>
                                    <p>SARPRAS menyediakan layanan peminjaman peralatan yang efisien untuk mendukung
                                        kegiatan dengan kualitas terbaik.</p>
                                </li>
                            </ul>
                            <div class="btn-wrap">
                                <a type="button" data-toggle="modal" data-target="#exampleModal"
                                    class="btn-buy">Detail</a>
                                <a href="form_peminjam.html" class="btn-buy">Pinjam</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Alat & Barang</h5>
                    </div>
                    <div class="modal-body">
                        <table>
                            <tr>
                                <th><img src="{{ asset('sisarpas/assets/img/microphone.png') }}" width="152"
                                        height="200" /></th>
                                <th>
                                    <div class="mb-3">
                                        <p style="font-size: small">ID Barang Persediaan : 123</p>
                                        <hr style="color: #8f0d04" />
                                    </div>
                                    <div class="mb-3">
                                        <p style="font-size: small">Nama Barang : Microphone</p>
                                        <hr style="color: #8f0d04" />
                                    </div>
                                    <div class="mb-3">
                                        <p style="font-size: small">Kondisi Barang : Baik</p>
                                        <hr style="color: #8f0d04" />
                                    </div>
                                    <div class="mb-3">
                                        <p style="font-size: small">Status Barang : Bisa Dipinjam</p>
                                        <hr style="color: #8f0d04" />
                                    </div>
                                    <div class="mb-3">
                                        <p style="font-size: small">Spesifikasi Barang : Microphone paket isi 2</p>
                                        <hr style="color: #8f0d04" />
                                    </div>
                                    <div class="mb-3">
                                        <p style="font-size: small">Stok Barang : 20</p>
                                        <hr style="color: #8f0d04" />
                                    </div>
                                </th>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- End #main -->
@endsection

@extends('sisarpas.landing.layouts.app')

@section('title', 'Peminjaman Barang Dan Aula')

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

                            <a href="{{ route('peminjaman.barang', ['kategori' => 'barang']) }}"
                                class="btn-cari {{ request()->is('peminjaman/alat/barang') ? 'active' : '' }}">Alat &
                                Barang</a>
                            <a href="{{ route('peminjaman.ruangan', ['kategori' => 'ruangan']) }}"
                                class="btn-cari {{ request()->is('peminjaman/ruangan/aula') ? 'active' : '' }}">
                                Aula</a>

                            <form action="{{ route('peminjaman.cari.barang') }}" method="POST">
                                <div class="input-box">
                                    @csrf
                                    <input type="text" name="cari" placeholder="Search here..." />
                                    <button class="button" type="submit">
                                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor"
                                            stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                            class="css-i6dzq1">
                                            <circle cx="11" cy="11" r="8"></circle>
                                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                        </svg>
                                        Cari
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="pricing" class="pricing">
            <div class="container">
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
                <div class="row">
                    @foreach ($barang as $b)
                        <div class="col-lg-3 col-md-6 mt-4 mt-md-6" data-aos="fade-up" data-aos-delay="200">
                            <div class="box featured">
                                <h3>{{ $b->nama_barang }}</h3>
                                <img src="{{ asset('sisarpas/assets/inventoriFile/' . $b->gambar_barang) }}"
                                    alt="microphone" width="100" />
                                <ul>
                                    <li>
                                        <p>{{ $b->detail_barang }}.</p>
                                    </li>
                                </ul>
                                <div class="btn-wrap">
                                    <a type="button" data-toggle="modal"
                                        data-target="#modalDetailbarang--{{ $b->id }}" class="btn-buy">Detail</a>
                                    <a href="{{ route('transaction.pinjam.barang', $b->id) }}" class="btn-buy">Pinjam</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>


        <!-- Modal -->
        @foreach ($barang as $b)
            <div class="modal fade" id="modalDetailbarang--{{ $b->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Detail Alat & Barang</h5>
                        </div>
                        <div class="modal-body">
                            <table>
                                <tr>
                                    <th><img src="{{ asset('sisarpas/assets/inventoriFile/' . $b->gambar_barang) }}"
                                            width="152" height="200" /></th>
                                    <th>
                                        <div class="mb-3">
                                            <p style="font-size: small">ID Barang Persediaan : {{ $b->id }}</p>
                                            <hr style="color: #8f0d04" />
                                        </div>
                                        <div class="mb-3">
                                            <p style="font-size: small">Nama Barang : {{ $b->nama_barang }}</p>
                                            <hr style="color: #8f0d04" />
                                        </div>
                                        <div class="mb-3">
                                            <p style="font-size: small">Kondisi Barang : {{ $b->kondisi_barang }}</p>
                                            <hr style="color: #8f0d04" />
                                        </div>
                                        <div class="mb-3">
                                            <p style="font-size: small">Status Barang : @if ($b->status_barang == 'ready')
                                                    <span class="badge text-bg-success"> {{ $b->status_barang }}
                                                    @elseif($b->status_barang == 'not-ready')
                                                        <span class="badge text-bg-warning"> {{ $b->status_barang }}
                                                        @elseif($b->status_barang == 'maintenance')
                                                            <span class="badge text-bg-danger">
                                                                {{ $b->status_barang }}
                                                @endif
                                                </span></p>
                                            <hr style="color: #8f0d04" />
                                        </div>
                                        <div class="mb-3">
                                            <p style="font-size: small">Spesifikasi Barang : {{ $b->spesifikasi_barang }}
                                            </p>
                                            <hr style="color: #8f0d04" />
                                        </div>
                                        <div class="mb-3">
                                            <p style="font-size: small">Stok Barang : {{ $b->jumlah_barang }}</p>
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
        @endforeach
    </main>
    <!-- End #main -->
@endsection

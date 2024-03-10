<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Repositories\LandingRepositories;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class LandingControllers extends Controller
{
    public function index(LandingRepositories $landingRepositories)
    {
        return $landingRepositories->indexRepositories();
    }

    public function alat_barang(): View
    {
        return view('sisarpas.landing.peminjaman.alat_barang');
    }

    public function aula_barang(): View
    {
        return view('sisarpas.landing.peminjaman.aula_barang');
    }

    public function contact(LandingRepositories $landingRepositories): RedirectResponse
    {
        $landingRepositories->contactRepositories();
        Session::flash('success', 'Berhasil Kirim Kontak');
        return Redirect::route('sisarpas.landing');
    }
}

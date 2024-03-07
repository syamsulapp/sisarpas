<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Repositories\LandingRepositories;
use Illuminate\Contracts\View\View;

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
}

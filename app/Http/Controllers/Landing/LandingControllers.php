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
}

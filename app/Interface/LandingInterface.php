<?php

namespace App\Interface;

use Illuminate\Contracts\View\View;

interface LandingInterface
{
    public function indexRepositories(): View;
    public function contactRepositories(): void;
}

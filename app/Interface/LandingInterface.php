<?php

namespace App\Interface;

use Illuminate\Contracts\View\View;

interface LandingInterface
{
    public function indexRepositories($data): View;
    public function contactRepositories(): void;
}

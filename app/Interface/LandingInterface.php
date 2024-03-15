<?php

namespace App\Interface;

use Illuminate\Contracts\View\View;

interface LandingInterface
{
    public function contactRepositories($request): void;
    public function doPinjamRepositories(): void;
}
